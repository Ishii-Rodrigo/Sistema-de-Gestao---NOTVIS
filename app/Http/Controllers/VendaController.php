<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Veiculo;
use App\Models\VendaItem;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class VendaController extends Controller
{
    /**
     * Exibe a lista de todas as vendas/orçamentos com pesquisa opcional.
     */
    public function index(Request $request)
    {
        $termo = $request->input('search');

        $query = Venda::with(['cliente', 'veiculo'])->latest();

        if ($termo) {
            $query->where('id', 'like', "%{$termo}%")
                  ->orWhereHas('cliente', function ($q) use ($termo) {
                      $q->where('nome', 'like', "%{$termo}%");
                  });
        }

        $vendas = $query->get();

        return view('vendas.index', compact('vendas', 'termo'));
    }

    /**
     * Mostra o formulário de criação de nova venda.
     */
    public function create()
    {
        $clientes = Cliente::orderBy('nome')->get(['id', 'nome']);
        // Inclui estoque_atual para uso no JavaScript
        $produtos = Produto::orderBy('nome')->get(['id', 'nome', 'preco_venda', 'estoque_atual']);
        return view('vendas.create', compact('clientes', 'produtos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validação
        $data = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'veiculo_id' => 'nullable|exists:veiculos,id',
            'data_venda' => 'required|date',
            'status' => ['required', Rule::in(['Orcamento', 'Finalizada'])],
            'forma_pagamento' => 'required|string|max:50',
            'desconto' => 'nullable|numeric|min:0',
            'observacoes' => 'nullable|string',
            'subtotal' => 'required|numeric|min:0',
            'total_final' => 'required|numeric|min:0',

            'itens' => 'required|array|min:1',
            'itens.*.produto_id' => 'required|exists:produtos,id',
            'itens.*.quantidade' => 'required|numeric|min:0.01',
            'itens.*.preco_unitario' => 'required|numeric|min:0',
            'itens.*.total_item' => 'required|numeric|min:0',
        ]);

        // 2. Validação de Estoque SÓ se o status for 'Finalizada'
        if ($data['status'] === 'Finalizada') {
            try {
                $this->validarEstoque($data['itens']);
            } catch (ValidationException $e) {
                return back()->withInput()->withErrors($e->errors());
            }
        }

        DB::beginTransaction();

        try {
            // 3. Cria a Venda
            $venda = Venda::create($request->except(['itens']));

            // 4. Prepara e salva os Itens
            $itensParaCriar = [];
            foreach ($data['itens'] as $item) {
                $itensParaCriar[] = new VendaItem([
                    'produto_id' => $item['produto_id'],
                    'quantidade' => $item['quantidade'],
                    'preco_unitario' => $item['preco_unitario'],
                    'total_item' => $item['total_item'],
                ]);
            }

            $venda->itens()->saveMany($itensParaCriar);

            // 5. Baixa o Estoque SÓ se o status for 'Finalizada'
            if ($venda->status === 'Finalizada') {
                $this->baixarEstoque($itensParaCriar);
            }

            DB::commit();

            return redirect()->route('vendas.show', $venda->id)
                ->with('success', 'Venda/Orçamento criado com sucesso!');

        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Erro ao salvar a Venda/Orçamento: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource. (CORREÇÃO DO ERRO 500)
     */
    public function show(Venda $venda)
    {
        // Carrega os relacionamentos necessários para exibir os detalhes na view
        $venda->load(['cliente', 'veiculo', 'itens.produto']);

        return view('vendas.show', compact('venda'));
    }

    /**
     * Mostra o formulário para editar a venda especificada.
     */
    public function edit(Venda $venda)
    {
        $clientes = Cliente::orderBy('nome')->get(['id', 'nome']);
        // Carrega os produtos incluindo o estoque atual para o JS
        $produtos = Produto::orderBy('nome')->get(['id', 'nome', 'preco_venda', 'estoque_atual']);

        // Inclui os itens carregados para a view de edição
        $venda->load('itens');

        return view('vendas.edit', compact('venda', 'clientes', 'produtos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venda $venda)
    {
        // 1. Validação (a mesma do store)
        $data = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'veiculo_id' => 'nullable|exists:veiculos,id',
            'data_venda' => 'required|date',
            'status' => ['required', Rule::in(['Orcamento', 'Finalizada'])],
            'forma_pagamento' => 'required|string|max:50',
            'desconto' => 'nullable|numeric|min:0',
            'observacoes' => 'nullable|string',
            'subtotal' => 'required|numeric|min:0',
            'total_final' => 'required|numeric|min:0',

            // Validação dos Itens da Venda
            'itens' => 'required|array|min:1',
            'itens.*.id' => 'nullable|sometimes|exists:venda_items,id',
            'itens.*.delete' => 'nullable|sometimes|in:1',
            'itens.*.produto_id' => 'required|exists:produtos,id',
            'itens.*.quantidade' => 'required|numeric|min:0.01',
            'itens.*.preco_unitario' => 'required|numeric|min:0',
            'itens.*.total_item' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $oldStatus = $venda->status;
            // Carrega os itens antes da atualização
            $oldItens = $venda->itens->all();

            // 2. Reverte o Estoque ANTES da atualização, SÓ se estava 'Finalizada'
            if ($oldStatus === 'Finalizada') {
                $this->reverterEstoque($oldItens);
            }

            // 3. Verifica o estoque para os NOVOS itens/quantidades SÓ se o novo status for 'Finalizada'
            // Filtra os itens que NÃO foram marcados para exclusão
            $itensAtuais = collect($data['itens'])->filter(fn($item) => empty($item['delete']))->all();

            if ($data['status'] === 'Finalizada') {
                try {
                    $this->validarEstoque($itensAtuais);
                } catch (ValidationException $e) {
                    // Se falhar, reverte o estoque original (que já foi revertido no passo 2)
                    if ($oldStatus === 'Finalizada') {
                        $this->baixarEstoque($oldItens);
                    }
                    DB::rollBack();
                    return back()->withInput()->withErrors($e->errors());
                }
            }

            // 4. Atualiza a Venda
            $venda->update($request->except(['itens']));

            // 5. Sincroniza os Itens da Venda
            $venda->itens()->delete(); // Remove todos os itens antigos
            $itensParaSalvar = [];
            foreach ($itensAtuais as $item) {
                $itensParaSalvar[] = new VendaItem([
                    'produto_id' => $item['produto_id'],
                    'quantidade' => $item['quantidade'],
                    'preco_unitario' => $item['preco_unitario'],
                    'total_item' => $item['total_item'],
                ]);
            }
            $venda->itens()->saveMany($itensParaSalvar);

            // 6. Baixa o Estoque AGORA, SÓ se o novo status for 'Finalizada'
            if ($venda->status === 'Finalizada') {
                $this->baixarEstoque($itensParaSalvar);
            }

            DB::commit();

            return redirect()->route('vendas.show', $venda->id)
                ->with('success', 'Venda/Orçamento atualizado com sucesso!');

        } catch (Exception $e) {
            DB::rollBack();
            // Tenta reverter o estoque original se algo deu errado no meio
             if ($oldStatus === 'Finalizada') {
                $this->baixarEstoque($oldItens);
            }
            return back()->withInput()->with('error', 'Erro ao atualizar a Venda/Orçamento: ' . $e->getMessage());
        }
    }

    /**
     * Remove a venda especificada do storage.
     */
    public function destroy(Venda $venda)
    {
        DB::beginTransaction();
        try {
            // Reverte o estoque SÓ se o status era 'Finalizada'
            if ($venda->status === 'Finalizada') {
                // Certifique-se de carregar os itens antes de deletar a venda
                $this->reverterEstoque($venda->itens->all());
            }

            // Deleta a venda (e os itens por causa do onDelete('cascade'))
            $venda->delete();

            DB::commit();

            return redirect()->route('vendas.index')->with('success', 'Venda/Orçamento excluído(a) com sucesso! Estoque revertido.');
        } catch (Exception $e) {
             DB::rollBack();
             return back()->with('error', 'Erro ao excluir a Venda/Orçamento: ' . $e->getMessage());
        }
    }

    // ----------------------------------------------------------------------
    // MÉTODOS DE SUPORTE - LÓGICA DE ESTOQUE
    // ----------------------------------------------------------------------

    /**
     * Verifica se há estoque suficiente para todos os itens.
     * @throws ValidationException se o estoque for insuficiente.
     */
    protected function validarEstoque(array $itens)
    {
        $erros = [];
        $produtosIds = array_unique(array_column($itens, 'produto_id'));
        $produtos = Produto::whereIn('id', $produtosIds)->pluck('estoque_atual', 'id');

        foreach ($itens as $item) {
            $produtoId = $item['produto_id'];
            $quantidadeDesejada = (float) $item['quantidade'];
            $estoqueAtual = (float) ($produtos[$produtoId] ?? 0);

            if ($quantidadeDesejada > $estoqueAtual) {
                $produto = Produto::find($produtoId, ['nome']);
                $nomeProduto = $produto ? $produto->nome : 'ID: ' . $produtoId;

                $erros["itens.{$produtoId}"] = "Estoque insuficiente para **{$nomeProduto}**. Disponível: **{$estoqueAtual}**. Necessário: **{$quantidadeDesejada}**.";
            }
        }

        if (!empty($erros)) {
            throw ValidationException::withMessages(['itens' => $erros]);
        }
    }

    /**
     * Baixa o estoque para cada item da venda.
     */
    protected function baixarEstoque($itens)
    {
        foreach ($itens as $item) {
            $produtoId = $item instanceof VendaItem ? $item->produto_id : $item['produto_id'];
            // Garante que a quantidade é um float para o decremento
            $quantidade = (float) ($item instanceof VendaItem ? $item->quantidade : $item['quantidade']);

            Produto::where('id', $produtoId)->decrement('estoque_atual', $quantidade);
        }
    }

    /**
     * Devolve o estoque para cada item da venda.
     */
    protected function reverterEstoque($itens)
    {
        foreach ($itens as $item) {
            $produtoId = $item instanceof VendaItem ? $item->produto_id : $item['produto_id'];
            // Garante que a quantidade é um float para o incremento
            $quantidade = (float) ($item instanceof VendaItem ? $item->quantidade : $item['quantidade']);

            Produto::where('id', $produtoId)->increment('estoque_atual', $quantidade);
        }
    }

    /**
     * Retorna uma lista de veículos vinculados a um cliente específico em formato JSON.
     */
    public function getVeiculosDoCliente($clienteId)
    {
        $veiculos = Veiculo::where('cliente_id', $clienteId)->get(['id', 'modelo', 'placa']);
        return response()->json($veiculos);
    }

    /**
     * Retorna a venda para impressão.
     */
    public function printVenda(Venda $venda)
    {
        $venda->load('itens.produto', 'cliente', 'veiculo');

        $empresa = [
            'nome' => 'Sua Empresa Manutenção Automotiva',
            'cnpj' => '00.000.000/0001-00',
            'endereco' => 'Rua Exemplo, 123 - Centro, Cidade - UF',
            'telefone' => '(99) 99999-9999',
            'email' => 'contato@suaempresa.com.br'
        ];

        return view('vendas.print', compact('venda', 'empresa'));
    }

    /**
     * Retorna detalhes do produto (incluindo preço de venda) para a API.
     */
    public function getProdutoDetails(Produto $produto)
    {
        return response()->json([
            'id' => $produto->id,
            'preco_venda' => $produto->preco_venda,
        ]);
    }
}