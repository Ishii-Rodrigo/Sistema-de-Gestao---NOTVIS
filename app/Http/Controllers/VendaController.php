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

    public function create()
    {
        $clientes = Cliente::orderBy('nome')->get(['id', 'nome']);
        $produtos = Produto::orderBy('nome')->get(['id', 'nome', 'preco_venda', 'estoque_atual']);
        return view('vendas.create', compact('clientes', 'produtos'));
    }

    public function store(Request $request)
    {
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

        if ($data['status'] === 'Finalizada') {
            try {
                $this->validarEstoque($data['itens']);
            } catch (ValidationException $e) {
                return back()->withInput()->withErrors($e->errors());
            }
        }

        DB::beginTransaction();

        try {
      
            $venda = Venda::create($request->except(['itens']));

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

    public function show(Venda $venda)
    {
        $venda->load(['cliente', 'veiculo', 'itens.produto']);

        return view('vendas.show', compact('venda'));
    }

    public function edit(Venda $venda)
    {
        $clientes = Cliente::orderBy('nome')->get(['id', 'nome']);
        $produtos = Produto::orderBy('nome')->get(['id', 'nome', 'preco_venda', 'estoque_atual']);
        $venda->load('itens');

        return view('vendas.edit', compact('venda', 'clientes', 'produtos'));
    }

    public function update(Request $request, Venda $venda)
    {
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
            $oldItens = $venda->itens->all();

            if ($oldStatus === 'Finalizada') {
                $this->reverterEstoque($oldItens);
            }

            $itensAtuais = collect($data['itens'])->filter(fn($item) => empty($item['delete']))->all();

            if ($data['status'] === 'Finalizada') {
                try {
                    $this->validarEstoque($itensAtuais);
                } catch (ValidationException $e) {
                    
                    if ($oldStatus === 'Finalizada') {
                        $this->baixarEstoque($oldItens);
                    }
                    DB::rollBack();
                    return back()->withInput()->withErrors($e->errors());
                }
            }

            $venda->update($request->except(['itens']));
            $venda->itens()->delete(); 
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

            if ($venda->status === 'Finalizada') {
                $this->baixarEstoque($itensParaSalvar);
            }

            DB::commit();

            return redirect()->route('vendas.show', $venda->id)
                ->with('success', 'Venda/Orçamento atualizado com sucesso!');

        } catch (Exception $e) {
            DB::rollBack();
        
             if ($oldStatus === 'Finalizada') {
                $this->baixarEstoque($oldItens);
            }
            return back()->withInput()->with('error', 'Erro ao atualizar a Venda/Orçamento: ' . $e->getMessage());
        }
    }

    public function destroy(Venda $venda)
    {
        DB::beginTransaction();
        try {
            
            if ($venda->status === 'Finalizada') {
                
                $this->reverterEstoque($venda->itens->all());
            }

            $venda->delete();

            DB::commit();

            return redirect()->route('vendas.index')->with('success', 'Venda/Orçamento excluído(a) com sucesso! Estoque revertido.');
        } catch (Exception $e) {
             DB::rollBack();
             return back()->with('error', 'Erro ao excluir a Venda/Orçamento: ' . $e->getMessage());
        }
    }

    /**
     * @throws ValidationException
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

    protected function baixarEstoque($itens)
    {
        foreach ($itens as $item) {
            $produtoId = $item instanceof VendaItem ? $item->produto_id : $item['produto_id'];
            
            $quantidade = (float) ($item instanceof VendaItem ? $item->quantidade : $item['quantidade']);

            Produto::where('id', $produtoId)->decrement('estoque_atual', $quantidade);
        }
    }

    protected function reverterEstoque($itens)
    {
        foreach ($itens as $item) {
            $produtoId = $item instanceof VendaItem ? $item->produto_id : $item['produto_id'];
            
            $quantidade = (float) ($item instanceof VendaItem ? $item->quantidade : $item['quantidade']);

            Produto::where('id', $produtoId)->increment('estoque_atual', $quantidade);
        }
    }

    public function getVeiculosDoCliente($clienteId)
    {
        $veiculos = Veiculo::where('cliente_id', $clienteId)->get(['id', 'modelo', 'placa']);
        return response()->json($veiculos);
    }

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

    public function getProdutoDetails(Produto $produto)
    {
        return response()->json([
            'id' => $produto->id,
            'preco_venda' => $produto->preco_venda,
        ]);
    }
}