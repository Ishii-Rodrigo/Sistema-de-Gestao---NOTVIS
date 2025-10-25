<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

// O nome da classe deve ser ProdutoController, não ProdutoContoller
class ProdutoController extends Controller 
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Certifique-se de que o Model é Produto e está buscando corretamente
        $produtos = Produto::all(); 
        return view('produtos.index', compact('produtos'));
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
        ],
        [
            'nome.required' => 'O campo nome está vazio',
            'descricao.required' => 'O campo descrição está vazio',
            'unidade_medida.required' => 'O campo unidade de medida está vazio',
            'preco_custo.required' => 'O campo preço de custo está vazio',
            'preco_custo.numeric' => 'O campo preço de custo precisa ser um número',
            'preco_venda.required' => 'O campo preço de venda está vazio',
            'preco_venda.numeric' => 'O campo preço de venda precisa ser um número',
            'estoque_minimo.required' => 'O campo estoque mínimo está vazio',
            'estoque_minimo.integer' => 'O campo estoque mínimo precisa ser um número inteiro',
        ]
        );

        // Note: Se o campo 'codigo' for gerado automaticamente (como indicado na sua view),
        // ele deve ser gerado antes ou no evento 'creating' do Model.
        // Aqui, assumimos que os campos passados via $request->all() são preenchíveis (fillable).
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
     * O Route Model Binding injeta automaticamente o objeto Produto.
     */
    public function edit(Produto $produto)
    {
        // **Esta linha agora deve funcionar, pois o arquivo edit.blade.php está no Canvas**
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
