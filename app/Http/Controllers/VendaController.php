<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Veiculo; // OBRIGATÓRIO: Certifique-se que o Model Veiculo está importado!
use App\Models\VendaItem; 
use Illuminate\Support\Facades\DB;
use Exception;

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
        $produtos = Produto::orderBy('nome')->get(['id', 'nome', 'preco_venda']);
        
        return view('vendas.create', compact('clientes', 'produtos'));
    }

    /**
     * Armazena uma nova venda no storage.
     */
    public function store(Request $request)
    {   
        // 1. Validação
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'veiculo_id' => 'nullable|exists:veiculos,id',
            'data_venda' => 'required|date',
            'status' => 'required|in:Orcamento,Finalizada',
            'forma_pagamento' => 'required|max:50',
            'desconto' => 'nullable|numeric|min:0',
            'observacoes' => 'nullable|max:1000',
            'subtotal' => 'required|numeric|min:0',
            'total_final' => 'required|numeric|min:0',
            'itens.*.produto_id' => 'required|exists:produtos,id',
            'itens.*.quantidade' => 'required|numeric|min:0.01',
            'itens.*.preco_unitario' => 'required|numeric|min:0.01',
        ]);

        // 2. Inicia uma transação de banco de dados
        DB::beginTransaction();

        try {
            // 3. Cria a Venda
            $venda = Venda::create($request->only([
                'cliente_id', 'veiculo_id', 'data_venda', 'status', 
                'forma_pagamento', 'desconto', 'observacoes', 'subtotal', 'total_final'
            ]));

            // 4. Salva os Itens da Venda
            $itens = collect($request->input('itens', []))->map(function($item) use ($venda) {
                return new Venda([
                    'venda_id' => $venda->id,
                    'produto_id' => $item['produto_id'],
                    'quantidade' => $item['quantidade'],
                    'preco_unitario' => $item['preco_unitario'],
                ]);
            });

            $venda->itens()->saveMany($itens);

            // 5. Baixa o Estoque (se for venda finalizada)
            if ($venda->status === 'Finalizada') {
                $this->baixarEstoque($venda->itens);
            }

            DB::commit();

            return redirect()->route('vendas.index')
                ->with('success', 'Venda/Orçamento criado com sucesso!');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ocorreu um erro ao salvar a venda. Tente novamente.');
        }
    }

    /**
     * Exibe a venda especificada.
     */
    public function show(Venda $venda)
    {
        $venda->load('cliente', 'veiculo', 'itens.produto');
        return view('vendas.show', compact('venda'));
    }

    /**
     * Mostra o formulário para edição da venda especificada.
     */
    public function edit(Venda $venda)
    {
        $clientes = Cliente::orderBy('nome')->get(['id', 'nome']);
        $produtos = Produto::orderBy('nome')->get(['id', 'nome', 'preco_venda']);
        
        $venda->load('itens'); 

        return view('vendas.edit', compact('venda', 'clientes', 'produtos'));
    }

    /**
     * Atualiza a venda especificada no storage.
     */
    public function update(Request $request, Venda $venda)
    {
        // ... (Lógica de Validação e Update) ...
        
        // CÓDIGO OMITIDO POR SER EXTENSO, MANTENDO APENAS O MÉTODO NOVO

    }


    /**
     * Remove a venda especificada do storage.
     */
    public function destroy(Venda $venda)
    {
        // ... (Lógica de Exclusão) ...

        // CÓDIGO OMITIDO POR SER EXTENSO, MANTENDO APENAS O MÉTODO NOVO
    }
    
    // ----------------------------------------------------------------------
    // MÉTODOS DE SUPORTE (GERENCIAMENTO DE ESTOQUE E NOVA FUNÇÃO AJAX)
    // ----------------------------------------------------------------------
    
    /**
     * Baixa o estoque para cada item da venda.
     * @param \Illuminate\Support\Collection|array $itens
     */
    protected function baixarEstoque($itens)
    {
        // ... (Lógica de Baixa de Estoque) ...
    }

    /**
     * Devolve o estoque para cada item da venda.
     * @param \Illuminate\Support\Collection|array $itens
     */
    protected function reverterEstoque($itens)
    {
        // ... (Lógica de Reversão de Estoque) ...
    }

    /**
     * Retorna uma lista de veículos vinculados a um cliente específico em formato JSON.
     *
     * @param int $clienteId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVeiculosPorCliente(int $clienteId)
    {
        $veiculos = Veiculo::where('cliente_id', $clienteId)
                            ->orderBy('placa')
                            // Colunas que serão retornadas para o <select>
                            ->get(['id', 'placa', 'modelo']);

        return response()->json($veiculos);
    }
}