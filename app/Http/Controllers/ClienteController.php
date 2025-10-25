<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente; 

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Método para listar todos os clientes
        $clientes = Cliente::all();
        // Você precisará criar a view 'clientes.index' para listar os clientes
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação (deve estar em sincronia com o que foi definido na migração)
        $request->validate([
            'nome' => 'required|max:255',
            'cpf_cnpj' => 'nullable|max:20|unique:clientes,cpf_cnpj',
            'telefone' => 'nullable|max:20',
            'email' => 'nullable|email|unique:clientes,email',
            'cep' => 'nullable|max:10',
            'rua' => 'nullable|max:255',
            'numero' => 'nullable|max:20',
            'bairro' => 'nullable|max:255',
            'cidade' => 'nullable|max:255',
            'estado' => 'nullable|max:2',
            'complemento' => 'nullable|max:255',
        ],
        [
            'nome.required' => 'O campo Nome/Razão Social é obrigatório.',
            'cpf_cnpj.unique' => 'O CPF/CNPJ informado já está cadastrado.',
            'email.unique' => 'O e-mail informado já está cadastrado.',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Display the specified resource (IMPLEMENTADO).
     */
    public function show(string $id)
    {
        // Busca o cliente pelo ID e lança 404 se não encontrar
        $cliente = Cliente::findOrFail($id);
        
        // Passa o cliente para a view 'clientes.show'
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Placeholder
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Placeholder
        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Placeholder
        Cliente::destroy($id);
        return redirect()->route('clientes.index')->with('success', 'Cliente removido com sucesso!');
    }
}
