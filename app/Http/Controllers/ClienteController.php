<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente; 
use Carbon\Carbon; 

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $termo = $request->input('search');

        $query = Cliente::query();
        
        if ($termo) {
            $query->where(function ($q) use ($termo) {
                $q->where('nome', 'like', '%' . $termo . '%')
                  ->orWhere('email', 'like', '%' . $termo . '%')
                  ->orWhere('cpf_cnpj', 'like', '%' . $termo . '%')
                  ->orWhere('telefone', 'like', '%' . $termo . '%');
            });
        }
        
        $clientes = $query->orderBy('nome')->get(); 

        return view('clientes.index', compact('clientes', 'termo')); 
    }
    
    public function create()
    {
        return view('clientes.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'cpf_cnpj' => 'nullable|max:20|unique:clientes',
            'email' => 'nullable|email|max:255|unique:clientes',
            'telefone' => 'nullable|max:20',
            'telefone_celular' => 'nullable|max:20',
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

        $data = $request->all();

        if (isset($data['nome'])) {
            $data['nome'] = $this->formatarNome($data['nome']);
        }
        
        if (isset($data['cpf_cnpj'])) {
            $data['cpf_cnpj'] = $this->formatarCpfCnpj($data['cpf_cnpj']);
        }
        
        if (isset($data['telefone'])) {
            $data['telefone'] = $this->formatarTelefone($data['telefone']);
        }
        
        if (isset($data['telefone_celular'])) {
            $data['telefone_celular'] = $this->formatarTelefone($data['telefone_celular']);
        }

        if (isset($data['cep'])) {
            $data['cep'] = $this->formatarCep($data['cep']);
        }

        if (isset($data['rua'])) {
            $data['rua'] = $this->formatarNome($data['rua']);
        }
        if (isset($data['bairro'])) {
            $data['bairro'] = $this->formatarNome($data['bairro']);
        }
        if (isset($data['cidade'])) {
            $data['cidade'] = $this->formatarNome($data['cidade']);
        }

        if (isset($data['estado'])) {
            $data['estado'] = $this->formatarEstado($data['estado']);
        }

        try {
            if (!empty($data['data_nascimento'])) {
                $data['data_nascimento'] = Carbon::createFromFormat('Y-m-d', $data['data_nascimento'])->format('Y-m-d');
            } else {
                $data['data_nascimento'] = null;
            }
        } catch (\Exception $e) {
            $data['data_nascimento'] = null;
        }

        Cliente::create($data); 

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        if ($cliente->data_nascimento) {
            $cliente->data_nascimento = Carbon::parse($cliente->data_nascimento)->format('Y-m-d');
        }
        return view('clientes.edit', compact('cliente'));
    }

    
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'cpf_cnpj' => 'nullable|max:20|unique:clientes,cpf_cnpj,' . $cliente->id, 
            'email' => 'nullable|email|max:255|unique:clientes,email,' . $cliente->id, 
            'telefone' => 'nullable|max:20',
            'telefone_celular' => 'nullable|max:20',
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

        $data = $request->all();

        if (isset($data['nome'])) {
            $data['nome'] = $this->formatarNome($data['nome']);
        }
        
        if (isset($data['cpf_cnpj'])) {
            $data['cpf_cnpj'] = $this->formatarCpfCnpj($data['cpf_cnpj']);
        }
        
        if (isset($data['telefone'])) {
            $data['telefone'] = $this->formatarTelefone($data['telefone']);
        }
        
        if (isset($data['telefone_celular'])) {
            $data['telefone_celular'] = $this->formatarTelefone($data['telefone_celular']);
        }

        if (isset($data['cep'])) {
            $data['cep'] = $this->formatarCep($data['cep']);
        }

        if (isset($data['rua'])) {
            $data['rua'] = $this->formatarNome($data['rua']);
        }
        if (isset($data['bairro'])) {
            $data['bairro'] = $this->formatarNome($data['bairro']);
        }
        if (isset($data['cidade'])) {
            $data['cidade'] = $this->formatarNome($data['cidade']);
        }

        if (isset($data['estado'])) {
            $data['estado'] = $this->formatarEstado($data['estado']);
        }

        try {
            if (!empty($data['data_nascimento'])) {
                $data['data_nascimento'] = Carbon::createFromFormat('Y-m-d', $data['data_nascimento'])->format('Y-m-d');
            } else {
                $data['data_nascimento'] = null;
            }
        } catch (\Exception $e) {
            $data['data_nascimento'] = null;
        }

        $cliente->update($data); 

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }
    
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        
        return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
    }

    protected function formatarNome($nome)
    {
        if (empty($nome)) {
            return null;
        }
        return mb_convert_case(mb_strtolower($nome, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
    }

    protected function formatarCpfCnpj($documento)
    {
        if (empty($documento)) {
            return null;
        }
        $limpo = preg_replace('/[^0-9]/', '', $documento);

        if (strlen($limpo) === 11) {
         
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $limpo);

        } elseif (strlen($limpo) === 14) {
            
            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $limpo);
        }

        return $documento; 
    }

    protected function formatarTelefone($telefone)
    {
        if (empty($telefone)) {
            return null;
        }

        $limpo = preg_replace('/[^0-9]/', '', $telefone);

        $length = strlen($limpo);

        if ($length === 11) {
           
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $limpo);
        } elseif ($length === 10) {
           
            return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $limpo);
        }

        return $telefone; 
    }

    protected function formatarCep($cep)
    {
        if (empty($cep)) {
            return null;
        }
        
        $limpo = preg_replace('/[^0-9]/', '', $cep);

        if (strlen($limpo) === 8) {
           
            return preg_replace('/(\d{5})(\d{3})/', '$1-$2', $limpo);
        }
        return $cep; 
    }

    protected function formatarEstado($estado)
    {
        if (empty($estado)) {
            return null;
        }
       
        return strtoupper($estado);
    }
}