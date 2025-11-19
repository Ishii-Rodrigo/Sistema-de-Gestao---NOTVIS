<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller 
{
    /**
     * Display a listing of the resource with optional search functionality.
     */
    public function index(Request $request)
    {
        $termo = $request->input('search');
        $query = Produto::query();

        if ($termo) {
            $query->where('nome', 'like', "%{$termo}%");
        }

        $produtos = $query->latest()->get(); 
        
        // 💡 Adicionado: Mapeamento de unidades para exibição do nome por extenso
        $unidadesMap = $this->getUnidadesMedida();
        
        return view('produtos.index', compact('produtos', 'termo', 'unidadesMap'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 💡 Adicionado: Passa as unidades de medida para a view
        $unidades = $this->getUnidadesMedida();
        return view('produtos.create', compact('unidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        // Validação completa para os campos do produto
        $request->validate([
            'nome' => 'required|max:255',
            'descricao' => 'required',
            // 💡 CORRIGIDO: Validação para aceitar apenas os códigos padronizados
            'unidade_medida' => 'required|max:10|in:UN,LT,M,KG,CX', 
            'preco_custo' => 'required|numeric|min:0',
            'preco_venda' => 'required|numeric|min:0.01', 
            'estoque_atual' => 'required|numeric|min:0', 
            'estoque_minimo' => 'required|numeric|min:0', 
        ]);
        
        $dados = $request->all();
        // 💡 NOVO: Conversão do Nome para Maiúsculo (uso de mb_strtoupper para UTF-8)
        $dados['nome'] = mb_strtoupper($dados['nome'], 'UTF-8');
        
        Produto::create($dados);

        return redirect()->route('produtos.index')
            ->with('success', 'Produto criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        // 💡 Adicionado: Mapeamento de unidades para exibição do nome por extenso
        $unidadesMap = $this->getUnidadesMedida();
        return view('produtos.show', compact('produto', 'unidadesMap'));
    }

    /**
     * Show the form for editing the specified resource. (UPDATE - Form)
     */
    public function edit(Produto $produto)
    {
        // 💡 Adicionado: Passa as unidades de medida para a view
        $unidades = $this->getUnidadesMedida();
        return view('produtos.edit', compact('produto', 'unidades'));
    }

    /**
     * Update the specified resource in storage. (UPDATE - Ação)
     */
    public function update(Request $request, Produto $produto)
    {
        // Validação completa
        $request->validate([
            'nome' => 'required|max:255',
            'descricao' => 'required',
            // 💡 CORRIGIDO: Validação para aceitar apenas os códigos padronizados
            'unidade_medida' => 'required|max:10|in:UN,LT,M,KG,CX',
            'preco_custo' => 'required|numeric',
            'preco_venda' => 'required|numeric', 
            'estoque_atual' => 'required|numeric|min:0',
            'estoque_minimo' => 'required|numeric|min:0',
            'codigo' => 'nullable|max:50|unique:produtos,codigo,' . $produto->id,
        ]);
        
        $dados = $request->all();
        // 💡 NOVO: Conversão do Nome para Maiúsculo (uso de mb_strtoupper para UTF-8)
        $dados['nome'] = mb_strtoupper($dados['nome'], 'UTF-8');
        
        $produto->update($dados);

        return redirect()->route('produtos.index')
            ->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()->route('produtos.index')
            ->with('success', 'Produto excluído com sucesso!');
    }
    
    /**
     * Método auxiliar para fornecer a lista de unidades de medida padronizadas.
     */
    private function getUnidadesMedida()
    {
        return [
            'UN' => 'Unidade', 
            'LT' => 'Litro', 
            'M' => 'Metro', 
            'KG' => 'Quilograma', 
            'CX' => 'Caixa'
        ];
    }
}