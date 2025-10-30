<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Veiculo; // Importação necessária para o Veículo
use App\Models\VendaItem; // Assumindo que este é o Model para os itens da Venda
use Illuminate\Support\Facades\DB; // Necessário para gerenciar transações

class VendaController extends Controller
{
    /**
     * Exibe a lista de todas as vendas/orçamentos com pesquisa opcional.
     */
    public function index(Request $request)
    {
        $termo = $request->input('search');
        
        // Usamos with(['cliente', 'veiculo']) para evitar N+1 e carregar dados relacionados
        $query = Venda::with(['cliente', 'veiculo'])->latest(); 

        if ($termo) {
            // Permite buscar por ID da Venda ou nome do Cliente
            $query->where('id', 'like', "%{$termo}%")
                  ->orWhereHas('cliente', function ($q) use ($termo) {
                      $q->where('nome', 'like', "%{$termo}%");
                  });
        }
        
        // Busca os resultados (adicione paginate(15) aqui se precisar de paginação)
        $vendas = $query->get();

        return view('vendas.index', compact('vendas', 'termo'));
    }

    /**
     * Mostra o formulário de criação de nova venda.
     */
    public function create()
    {
        // Carrega dados necessários para os campos de seleção da view
        $clientes = Cliente::orderBy('nome')->get(['id', 'nome']);
        // Se houver lógica de Veículos por Cliente, ela deve ser implementada via AJAX/JavaScript na view
        $produtos = Produto::orderBy('nome')->get(['id', 'nome', 'preco_venda']); 

        return view('vendas.create', compact('clientes', 'produtos'));
    }

    /**
     * Armazena uma nova venda e seus itens no banco de dados.
     */
    public function store(Request $request)
    {
        // 1. Validação dos dados
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'veiculo_id' => 'nullable|exists:veiculos,id', // Opcional
            'data_venda' => 'required|date',
            'status' => 'required|in:Orcamento,Aberta,Finalizada,Cancelada',
            'forma_pagamento' => 'required|string|max:50',
            'total_final' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
            'itens' => 'required|array|min:1', // Deve ter pelo menos um item
            'itens.*.produto_id' => 'required|exists:produtos,id',
            'itens.*.quantidade' => 'required|numeric|min:1',
            'itens.*.preco_unitario' => 'required|numeric|min:0',
        ]);

        try {
            // 2. Transação: Garante que a venda e os itens sejam salvos ou nada seja salvo
            DB::transaction(function () use ($request) {
                
                // Cria a Venda Principal
                $venda = Venda::create([
                    'cliente_id' => $request->cliente_id,
                    'veiculo_id' => $request->veiculo_id,
                    'data_venda' => $request->data_venda,
                    'status' => $request->status,
                    'forma_pagamento' => $request->forma_pagamento,
                    'desconto' => $request->desconto ?? 0,
                    'observacoes' => $request->observacoes,
                    'subtotal' => $request->subtotal,
                    'total_final' => $request->total_final,
                ]);

                // Adiciona os Itens usando o relacionamento 'itens()'
                foreach ($request->itens as $itemData) {
                    $venda->itens()->create([
                        'produto_id' => $itemData['produto_id'],
                        'quantidade' => $itemData['quantidade'],
                        'preco_unitario' => $itemData['preco_unitario'],
                    ]);
                }
            });

            return redirect()->route('vendas.index')
                             ->with('success', 'Venda/Orçamento criado com sucesso!');
        } catch (\Exception $e) {
            // Se houver qualquer erro na transação, retorna com a mensagem
            return back()->withInput()->withErrors(['store' => 'Erro ao salvar a venda: ' . $e->getMessage()]);
        }
    }

    /**
     * Exibe os detalhes de uma venda específica.
     */
    public function show(Venda $venda)
    {
        // O Laravel já injeta a Venda pelo ID (Route Model Binding)
        // Carrega os relacionamentos para a view (itens, cliente, veiculo, e produto de cada item)
        $venda->load('itens.produto', 'cliente', 'veiculo'); 
        
        return view('vendas.show', compact('venda'));
    }

    /**
     * Mostra o formulário de edição da venda.
     */
    public function edit(Venda $venda)
    {
        $clientes = Cliente::orderBy('nome')->get(['id', 'nome']);
        $produtos = Produto::orderBy('nome')->get(['id', 'nome', 'preco_venda']); 
        
        // Carrega os itens da venda para pré-preencher o formulário
        $venda->load('itens.produto'); 
        
        return view('vendas.edit', compact('venda', 'clientes', 'produtos'));
    }

    /**
     * Atualiza os dados de uma venda no banco de dados.
     */
    public function update(Request $request, Venda $venda)
    {
        // 1. Validação dos dados
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'veiculo_id' => 'nullable|exists:veiculos,id',
            'data_venda' => 'required|date',
            'status' => 'required|in:Orcamento,Aberta,Finalizada,Cancelada',
            'forma_pagamento' => 'required|string|max:50',
            'total_final' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
            'itens' => 'nullable|array', 
            'itens.*.produto_id' => 'required_with:itens|exists:produtos,id',
            'itens.*.quantidade' => 'required_with:itens|numeric|min:1',
            'itens.*.preco_unitario' => 'required_with:itens|numeric|min:0',
        ]);

        try {
            // 2. Transação
            DB::transaction(function () use ($request, $venda) {
                
                // Atualiza a Venda Principal
                $venda->update([
                    'cliente_id' => $request->cliente_id,
                    'veiculo_id' => $request->veiculo_id,
                    'data_venda' => $request->data_venda,
                    'status' => $request->status,
                    'forma_pagamento' => $request->forma_pagamento,
                    'desconto' => $request->desconto ?? 0,
                    'observacoes' => $request->observacoes,
                    'subtotal' => $request->subtotal,
                    'total_final' => $request->total_final,
                ]);

                // Sincroniza/Atualiza os Itens: Remove todos os antigos e adiciona os novos
                $venda->itens()->delete(); // Exclui todos os itens existentes da venda

                if ($request->has('itens')) {
                    foreach ($request->itens as $itemData) {
                        $venda->itens()->create([
                            'produto_id' => $itemData['produto_id'],
                            'quantidade' => $itemData['quantidade'],
                            'preco_unitario' => $itemData['preco_unitario'],
                        ]);
                    }
                }
            });

            return redirect()->route('vendas.show', $venda->id)
                             ->with('success', 'Venda/Orçamento atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['update' => 'Erro ao atualizar a venda: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove uma venda específica do banco de dados.
     */
    public function destroy(Venda $venda)
    {
        // Usamos transação para garantir que os itens sejam removidos antes da venda
        DB::transaction(function () use ($venda) {
            $venda->itens()->delete(); // Remove os itens relacionados
            $venda->delete(); // Remove a venda principal
        });

        return redirect()->route('vendas.index')
                         ->with('success', 'Venda/Orçamento excluído com sucesso!');
    }
}