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
        // 1. Obtém o termo de busca da requisição
        $termo = $request->input('search');
        $query = Produto::query();

        // 2. Lógica de pesquisa: Filtra APENAS por nome
        if ($termo) {
            // CORREÇÃO: Pesquisa apenas pela coluna 'nome', removendo 'codigo'
            $query->where('nome', 'like', "%{$termo}%");
            
            /*
             * NOTA: Se você realmente deseja pesquisar por "código", você deve
             * primeiro garantir que a coluna 'codigo' exista na tabela 'produtos' 
             * no seu banco de dados (via migração).
             */
        }

        // 3. Busca e ordena os produtos
        $produtos = $query->latest()->get(); 
        
        // 4. Passa os produtos E o termo de pesquisa para a view
        return view('produtos.index', compact('produtos', 'termo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produtos.create');
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
            'unidade_medida' => 'required|max:10',
            'preco_custo' => 'required|numeric',
            'preco_venda' => 'required|numeric', 
            'estoque_minimo' => 'required|integer|min:0',
            // O campo 'codigo' foi removido da busca, mas se for usado no formulário, a validação fica aqui:
            'codigo' => 'nullable|max:50|unique:produtos', 
        ]);
        
        // Cria o produto com os dados validados.
        Produto::create($request->all());

        return redirect()->route('produtos.index')
            ->with('success', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        return view('produtos.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource. (UPDATE - Form)
     */
    public function edit(Produto $produto)
    {
        return view('produtos.edit', compact('produto'));
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
            'unidade_medida' => 'required|max:10',
            'preco_custo' => 'required|numeric',
            'preco_venda' => 'required|numeric', 
            'estoque_minimo' => 'required|integer|min:0',
            // Validação para 'codigo'
            'codigo' => 'nullable|max:50|unique:produtos,codigo,' . $produto->id,
        ]);
        
        // Atualiza o produto com os dados validados.
        $produto->update($request->all());

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
}