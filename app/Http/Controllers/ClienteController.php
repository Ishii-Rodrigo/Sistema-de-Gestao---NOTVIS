<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente; 
use Carbon\Carbon; 

class ClienteController extends Controller
{
    /**
     * Exibe a lista de recursos (Clientes) com funcionalidade de busca.
     */
    public function index(Request $request)
    {
        // 1. Obtém o termo de busca da requisição (campo 'search')
        $termo = $request->input('search');

        // 2. Inicializa a query no modelo Cliente
        $query = Cliente::query();
        
        // 3. Aplica o filtro de busca se houver um termo
        if ($termo) {
            $query->where(function ($q) use ($termo) {
                // Filtra nos campos 'nome', 'email', 'cpf_cnpj' ou 'telefone'
                $q->where('nome', 'like', '%' . $termo . '%')
                  ->orWhere('email', 'like', '%' . $termo . '%')
                  ->orWhere('cpf_cnpj', 'like', '%' . $termo . '%')
                  ->orWhere('telefone', 'like', '%' . $termo . '%');
            });
        }
        
        // 4. Busca os clientes (ordenando por nome)
        $clientes = $query->orderBy('nome')->get(); 

        // 5. Retorna a view, passando os clientes E O TERMO DE BUSCA
        return view('clientes.index', compact('clientes', 'termo')); 
    }
    
    /**
     * Mostra o formulário para criar um novo recurso.
     */
    public function create()
    {
        return view('clientes.create');
    }
    
    /**
     * Armazena um recurso recém-criado no storage.
     */
    public function store(Request $request)
    {
        // 1. Validação
        $request->validate([
            'nome' => 'required|max:255',
            'cpf_cnpj' => 'nullable|max:20|unique:clientes',
            'email' => 'nullable|email|max:255|unique:clientes',
            'telefone' => 'nullable|max:20',
            'telefone_celular' => 'nullable|max:20',
            'data_nascimento' => 'nullable|date', 
            
            // Endereço
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
            'data_nascimento.date' => 'O campo Data de Nascimento deve ser uma data válida.',
        ]);

        // 2. TRATAMENTO DA DATA
        $data = $request->all();

        try {
            if (!empty($data['data_nascimento'])) {
                $data['data_nascimento'] = Carbon::createFromFormat('Y-m-d', $data['data_nascimento'])->format('Y-m-d');
            } else {
                $data['data_nascimento'] = null;
            }
        } catch (\Exception $e) {
            $data['data_nascimento'] = null;
        }

        // 3. Cria o cliente
        Cliente::create($data); 

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Exibe o recurso especificado.
     */
    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Mostra o formulário para editar o recurso especificado.
     */
    public function edit(Cliente $cliente)
    {
        // Garante que a data é convertida para o formato de input (YYYY-MM-DD)
        if ($cliente->data_nascimento) {
            $cliente->data_nascimento = Carbon::parse($cliente->data_nascimento)->format('Y-m-d');
        }
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Atualiza o recurso especificado no storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        // 1. Validação com regra 'unique' para ignorar o cliente atual.
        $request->validate([
            'nome' => 'required|max:255',
            // Corrigido: Ignora o ID do cliente atual na verificação de unicidade
            'cpf_cnpj' => 'nullable|max:20|unique:clientes,cpf_cnpj,' . $cliente->id, 
            'email' => 'nullable|email|max:255|unique:clientes,email,' . $cliente->id, 
            'telefone' => 'nullable|max:20',
            'telefone_celular' => 'nullable|max:20',
            'data_nascimento' => 'nullable|date',
            
            // Endereço
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
            'data_nascimento.date' => 'O campo Data de Nascimento deve ser uma data válida.',
        ]);

        // 2. TRATAMENTO DA DATA
        $data = $request->all();

        try {
            if (!empty($data['data_nascimento'])) {
                $data['data_nascimento'] = Carbon::createFromFormat('Y-m-d', $data['data_nascimento'])->format('Y-m-d');
            } else {
                $data['data_nascimento'] = null;
            }
        } catch (\Exception $e) {
            $data['data_nascimento'] = null;
        }

        // 3. Atualiza os dados do cliente
        $cliente->update($data); 

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }
    
    /**
     * Remove o recurso especificado do storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        
        return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
    }
}