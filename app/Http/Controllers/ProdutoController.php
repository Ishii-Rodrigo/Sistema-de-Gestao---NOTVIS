<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller 
{
    public function index(Request $request)
    {
        $termo = $request->input('search');
        $query = Produto::query();

        if ($termo) {
            $query->where('nome', 'like', "%{$termo}%");
        }

        $produtos = $query->latest()->get(); 
        
        $unidadesMap = $this->getUnidadesMedida();
        
        return view('produtos.index', compact('produtos', 'termo', 'unidadesMap'));
    }

    public function create()
    {
        $unidades = $this->getUnidadesMedida();
        return view('produtos.create', compact('unidades'));
    }

    public function store(Request $request)
    {   
        $request->validate([
            'nome' => 'required|max:255',
            'descricao' => 'required',
            'unidade_medida' => 'required|max:10|in:UN,LT,M,KG,CX', 
            'preco_custo' => 'required|numeric|min:0',
            'preco_venda' => 'required|numeric|min:0.01', 
            'estoque_atual' => 'required|numeric|min:0', 
            'estoque_minimo' => 'required|numeric|min:0', 
        ]);
        
        $dados = $request->all();
    
        $dados['nome'] = mb_strtoupper($dados['nome'], 'UTF-8');
        
        Produto::create($dados);

        return redirect()->route('produtos.index')
            ->with('success', 'Produto criado com sucesso!');
    }

    public function show(Produto $produto)
    {
        
        $unidadesMap = $this->getUnidadesMedida();
        return view('produtos.show', compact('produto', 'unidadesMap'));
    }

    public function edit(Produto $produto)
    {
        $unidades = $this->getUnidadesMedida();
        return view('produtos.edit', compact('produto', 'unidades'));
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'descricao' => 'required',
            'unidade_medida' => 'required|max:10|in:UN,LT,M,KG,CX',
            'preco_custo' => 'required|numeric',
            'preco_venda' => 'required|numeric', 
            'estoque_atual' => 'required|numeric|min:0',
            'estoque_minimo' => 'required|numeric|min:0',
            'codigo' => 'nullable|max:50|unique:produtos,codigo,' . $produto->id,
        ]);
        
        $dados = $request->all();
       
        $dados['nome'] = mb_strtoupper($dados['nome'], 'UTF-8');
        
        $produto->update($dados);

        return redirect()->route('produtos.index')
            ->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()->route('produtos.index')
            ->with('success', 'Produto excluído com sucesso!');
    }
    
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