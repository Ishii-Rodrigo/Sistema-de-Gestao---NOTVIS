<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\Cliente; 

class VeiculoController extends Controller
{
    /**
     * Exibe a lista de todos os veículos com funcionalidade de pesquisa opcional.
     */
    public function index(Request $request)
    {
        $termo = $request->input('search');

        $query = Veiculo::with('cliente');

        if ($termo) {
            $query->where('placa', 'like', "%{$termo}%")
                  ->orWhere('marca', 'like', "%{$termo}%")
                  ->orWhere('modelo', 'like', "%{$termo}%")
                  ->orWhereHas('cliente', function ($q) use ($termo) {
                      $q->where('nome', 'like', "%{$termo}%");
                  });
        }
        
        $veiculos = $query->latest()->get();

        return view('veiculos.index', compact('veiculos', 'termo'));
    }

    /**
     * Mostra o formulário para criar um novo veículo.
     */
    public function create()
    {
        $clientes = Cliente::orderBy('nome')->get(['id', 'nome']);
        return view('veiculos.create', compact('clientes'));
    }

    /**
     * Armazena um novo veículo no banco de dados.
     */
    public function store(Request $request)
    {
        // 1. Pré-tratamento para validação: Limpa a placa e padroniza para 7 caracteres
        $placa_limpa = preg_replace('/[^a-zA-Z0-9]/', '', $request->input('placa'));
        // ATENÇÃO: A validação 'max:7' abaixo é para a placa LIMPA, sem o hífen.
        $request->merge(['placa' => $placa_limpa]); 
        
        // 2. Validação
        $request->validate([
            'placa' => 'required|string|max:7|unique:veiculos,placa',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'ano' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'cor' => 'required|string|max:50',
            'cliente_id' => 'required|exists:clientes,id',
        ]);
        
        // 3. TRATAMENTO E FORMATAÇÃO DOS DADOS (para persistência)
        $data = $request->all();

        // Aplica as regras de formatação (formato LLL-XXXX, 8 caracteres)
        if (isset($data['placa'])) {
            $data['placa'] = $this->formatarPlaca($data['placa']); 
        }
        if (isset($data['marca'])) {
            $data['marca'] = $this->formatarMaiusculas($data['marca']);
        }
        if (isset($data['modelo'])) {
            $data['modelo'] = $this->formatarMaiusculas($data['modelo']);
        }
        if (isset($data['cor'])) {
            $data['cor'] = $this->formatarMaiusculas($data['cor']);
        }

        Veiculo::create($data); // ESTE PASSO AGORA VAI FUNCIONAR COM A MUDANÇA NO DB

        return redirect()->route('veiculos.index')
                         ->with('success', 'Veículo cadastrado com sucesso!');
    }

    /**
     * Exibe os detalhes de um veículo específico.
     */
    public function show(Veiculo $veiculo)
    {
        return view('veiculos.show', compact('veiculo'));
    }

    /**
     * Mostra o formulário para editar um veículo existente.
     */
    public function edit(Veiculo $veiculo)
    {
        $clientes = Cliente::orderBy('nome')->get(['id', 'nome']);
        return view('veiculos.edit', compact('veiculo', 'clientes'));
    }

    /**
     * Atualiza o veículo especificado no banco de dados.
     */
    public function update(Request $request, Veiculo $veiculo)
    {
        // 1. Pré-tratamento para validação
        $placa_limpa = preg_replace('/[^a-zA-Z0-9]/', '', $request->input('placa'));
        $request->merge(['placa' => $placa_limpa]);

        // 2. Validação
        $request->validate([
            'placa' => 'required|string|max:7|unique:veiculos,placa,' . $veiculo->id,
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'ano' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'cor' => 'required|string|max:50',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        // 3. TRATAMENTO E FORMATAÇÃO DOS DADOS
        $data = $request->all();

        // Aplica as regras de formatação
        if (isset($data['placa'])) {
            $data['placa'] = $this->formatarPlaca($data['placa']); 
        }
        if (isset($data['marca'])) {
            $data['marca'] = $this->formatarMaiusculas($data['marca']);
        }
        if (isset($data['modelo'])) {
            $data['modelo'] = $this->formatarMaiusculas($data['modelo']);
        }
        if (isset($data['cor'])) {
            $data['cor'] = $this->formatarMaiusculas($data['cor']);
        }

        $veiculo->update($data);

        return redirect()->route('veiculos.index')
                         ->with('success', 'Veículo atualizado com sucesso!');
    }

    /**
     * Remove o veículo especificado do banco de dados.
     */
    public function destroy(Veiculo $veiculo)
    {
        $veiculo->delete();

        return redirect()->route('veiculos.index')
                         ->with('success', 'Veículo excluído com sucesso!');
    }

    // =================================================================
    // MÉTODOS AUXILIARES DE FORMATAÇÃO
    // =================================================================

    /**
     * Converte uma string para maiúsculas.
     */
    protected function formatarMaiusculas($string)
    {
        if (empty($string)) {
            return null;
        }
        return mb_strtoupper($string, 'UTF-8');
    }

    /**
     * Padroniza a placa para o formato brasileiro (LLL-XXXX) e maiúsculas.
     */
    protected function formatarPlaca($placa)
    {
        if (empty($placa)) {
            return null;
        }

        // 1. Remove caracteres não-alfanuméricos
        $limpa = preg_replace('/[^a-zA-Z0-9]/', '', $placa);

        // 2. Converte para maiúsculas
        $limpa = mb_strtoupper($limpa, 'UTF-8');
        
        // 3. Aplica a máscara LLL-XXXX, se tiver 7 caracteres limpos
        if (mb_strlen($limpa, 'UTF-8') === 7) {
            return mb_substr($limpa, 0, 3, 'UTF-8') . '-' . mb_substr($limpa, 3, 4, 'UTF-8');
        } 
        
        return $placa; 
    }
}