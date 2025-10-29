<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente; 
use Carbon\Carbon; // Necessário para o tratamento da data

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource. (Com Pesquisa)
     */
    public function index(Request $request)
    {
        $query = Cliente::query();
        $termo = $request->input('search'); // Pega o termo de busca

        // LÓGICA DE PESQUISA
        if ($termo) {
            $query->where('nome', 'LIKE', "%{$termo}%")
                  ->orWhere('email', 'LIKE', "%{$termo}%")
                  ->orWhere('cpf_cnpj', 'LIKE', "%{$termo}%")
                  ->orWhere('telefone_celular', 'LIKE', "%{$termo}%")
                  ->orWhere('cidade', 'LIKE', "%{$termo}%");
        }

        // Executa a query
        $clientes = $query->orderBy('nome')->get();

        // Passa os clientes e o termo de volta para a view
        return view('clientes.index', compact('clientes', 'termo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage. (Com Tratamento de Data)
     */
    public function store(Request $request)
    {
        // 1. Validação
        $request->validate([
            'nome' => 'required|max:255',
            'cpf_cnpj' => 'nullable|max:20|unique:clientes,cpf_cnpj',
            'telefone' => 'nullable|max:20',
            'telefone_celular' => 'nullable|max:20', 
            'email' => 'nullable|email|unique:clientes,email',
            'data_nascimento' => 'nullable|date', 
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

        // 2. TRATAMENTO DA DATA (Previne o erro 31975-02-02)
        $data = $request->all();

        try {
            if (!empty($data['data_nascimento'])) {
                // Formata a data para Y-m-d. Se for um ano inválido, o Carbon lança exceção.
                $data['data_nascimento'] = Carbon::parse($data['data_nascimento'])->format('Y-m-d');
            } else {
                $data['data_nascimento'] = null;
            }
        } catch (\Exception $e) {
            $data['data_nascimento'] = null; // Se a data for inválida para o MySQL, define como nulo
        }

        Cliente::create($data); 

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage. (Com Lógica de Edição e Tratamento de Data)
     */
    public function update(Request $request, string $id)
    {
        $cliente = Cliente::findOrFail($id);

        // 1. Validação (com unique do CPF/CNPJ e Email ignorando o cliente atual)
        $request->validate([
            'nome' => 'required|max:255',
            'cpf_cnpj' => 'nullable|max:20|unique:clientes,cpf_cnpj,' . $id,
            'telefone' => 'nullable|max:20',
            'telefone_celular' => 'nullable|max:20',
            'email' => 'nullable|email|unique:clientes,email,' . $id,
            'data_nascimento' => 'nullable|date',
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
                $data['data_nascimento'] = Carbon::parse($data['data_nascimento'])->format('Y-m-d');
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Cliente::destroy($id);
        return redirect()->route('clientes.index')->with('success', 'Cliente removido com sucesso!');
    }
}