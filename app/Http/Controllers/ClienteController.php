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

        // 2. TRATAMENTO E FORMATAÇÃO DOS DADOS
        $data = $request->all();

        // **APLICAÇÃO DAS REGRAS DE FORMATAÇÃO**

        // Nome/Razão Social (Title Case)
        if (isset($data['nome'])) {
            $data['nome'] = $this->formatarNome($data['nome']);
        }
        
        // CPF/CNPJ (Máscara)
        if (isset($data['cpf_cnpj'])) {
            $data['cpf_cnpj'] = $this->formatarCpfCnpj($data['cpf_cnpj']);
        }
        
        // Telefones (Máscara)
        if (isset($data['telefone'])) {
            $data['telefone'] = $this->formatarTelefone($data['telefone']);
        }
        
        if (isset($data['telefone_celular'])) {
            $data['telefone_celular'] = $this->formatarTelefone($data['telefone_celular']);
        }

        // CEP (Máscara: XXXXX-XXX)
        if (isset($data['cep'])) {
            $data['cep'] = $this->formatarCep($data['cep']);
        }

        // Endereço (Title Case: Rua, Bairro, Cidade)
        if (isset($data['rua'])) {
            $data['rua'] = $this->formatarNome($data['rua']);
        }
        if (isset($data['bairro'])) {
            $data['bairro'] = $this->formatarNome($data['bairro']);
        }
        if (isset($data['cidade'])) {
            $data['cidade'] = $this->formatarNome($data['cidade']);
        }

        // Estado/UF (Uppercase: PR, SP)
        if (isset($data['estado'])) {
            $data['estado'] = $this->formatarEstado($data['estado']);
        }


        // TRATAMENTO DA DATA
        try {
            if (!empty($data['data_nascimento'])) {
                // Carbon já lida com o formato Y-m-d do input type="date"
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

        // 2. TRATAMENTO E FORMATAÇÃO DOS DADOS
        $data = $request->all();

        // **APLICAÇÃO DAS REGRAS DE FORMATAÇÃO**

        // Nome/Razão Social (Title Case)
        if (isset($data['nome'])) {
            $data['nome'] = $this->formatarNome($data['nome']);
        }
        
        // CPF/CNPJ (Máscara)
        if (isset($data['cpf_cnpj'])) {
            $data['cpf_cnpj'] = $this->formatarCpfCnpj($data['cpf_cnpj']);
        }
        
        // Telefones (Máscara)
        if (isset($data['telefone'])) {
            $data['telefone'] = $this->formatarTelefone($data['telefone']);
        }
        
        if (isset($data['telefone_celular'])) {
            $data['telefone_celular'] = $this->formatarTelefone($data['telefone_celular']);
        }

        // CEP (Máscara: XXXXX-XXX)
        if (isset($data['cep'])) {
            $data['cep'] = $this->formatarCep($data['cep']);
        }

        // Endereço (Title Case: Rua, Bairro, Cidade)
        if (isset($data['rua'])) {
            $data['rua'] = $this->formatarNome($data['rua']);
        }
        if (isset($data['bairro'])) {
            $data['bairro'] = $this->formatarNome($data['bairro']);
        }
        if (isset($data['cidade'])) {
            $data['cidade'] = $this->formatarNome($data['cidade']);
        }

        // Estado/UF (Uppercase: PR, SP)
        if (isset($data['estado'])) {
            $data['estado'] = $this->formatarEstado($data['estado']);
        }

        // TRATAMENTO DA DATA
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

    // =================================================================
    // MÉTODOS AUXILIARES DE FORMATAÇÃO
    // =================================================================

    /**
     * Converte uma string para formato de título (Title Case).
     * Regra: Independentemente de como o usuário digitar, cada palavra deve ter a primeira letra maiúscula e o restante minúsculo.
     * Aplicável a Nome/Razão Social, Rua, Bairro e Cidade.
     * Ex: "joão da silva" -> "João Da Silva"
     */
    protected function formatarNome($nome)
    {
        if (empty($nome)) {
            return null;
        }
        // Converte toda a string para minúsculo, e depois aplica mb_convert_case (título)
        return mb_convert_case(mb_strtolower($nome, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
    }

    /**
     * Remove a máscara de um documento e aplica a máscara correta (CPF ou CNPJ).
     * Regra: CPF (11 dígitos): XXX.XXX.XXX-XX | CNPJ (14 dígitos): XX.XXX.XXX/XXXX-XX
     * Ex: 12345678901 -> 123.456.789-01
     */
    protected function formatarCpfCnpj($documento)
    {
        if (empty($documento)) {
            return null;
        }
        // Remove todos os caracteres que não são números
        $limpo = preg_replace('/[^0-9]/', '', $documento);

        if (strlen($limpo) === 11) {
            // CPF: XXX.XXX.XXX-XX
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $limpo);
        } elseif (strlen($limpo) === 14) {
            // CNPJ: XX.XXX.XXX/XXXX-XX
            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $limpo);
        }

        return $documento; // Retorna o valor original se não tiver 11 ou 14 dígitos (mantendo a validação)
    }

    /**
     * Remove a máscara do telefone e aplica a máscara nacional correta.
     * Regra: Fixo (10 dígitos): (XX) XXXX-XXXX | Celular (11 dígitos): (XX) 9XXXX-XXXX
     * Ex: 44998765432 -> (44) 99876-5432
     */
    protected function formatarTelefone($telefone)
    {
        if (empty($telefone)) {
            return null;
        }
        // Remove todos os caracteres que não são números
        $limpo = preg_replace('/[^0-9]/', '', $telefone);

        $length = strlen($limpo);

        if ($length === 11) {
            // Celular (XX) 9XXXX-XXXX
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $limpo);
        } elseif ($length === 10) {
            // Fixo (XX) XXXX-XXXX
            return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $limpo);
        }

        return $telefone; // Retorna o valor original se não for 10 ou 11 dígitos
    }

    /**
     * Remove a máscara do CEP e aplica o formato XXXXX-XXX.
     * Regra: Deve conter 8 dígitos numéricos e ser formatado como XXXXX-XXX.
     * Ex: 87200000 -> 87200-000
     */
    protected function formatarCep($cep)
    {
        if (empty($cep)) {
            return null;
        }
        // Remove todos os caracteres que não são números
        $limpo = preg_replace('/[^0-9]/', '', $cep);

        if (strlen($limpo) === 8) {
            // CEP: XXXXX-XXX
            return preg_replace('/(\d{5})(\d{3})/', '$1-$2', $limpo);
        }
        return $cep; // Retorna o valor original se não tiver 8 dígitos
    }

    /**
     * Converte a sigla do estado para duas letras maiúsculas.
     * Regra: Deve ser salvo com duas letras maiúsculas (padrão oficial do IBGE).
     * Ex: pr -> PR
     */
    protected function formatarEstado($estado)
    {
        if (empty($estado)) {
            return null;
        }
        // Converte para maiúsculas
        return strtoupper($estado);
    }
}