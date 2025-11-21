<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\Cliente; 

class VeiculoController extends Controller
{
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

    public function create()
    {
        $clientes = Cliente::orderBy('nome')->get(['id', 'nome']);
        return view('veiculos.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $placa_limpa = preg_replace('/[^a-zA-Z0-9]/', '', $request->input('placa'));
        
        $request->merge(['placa' => $placa_limpa]); 
        
        $request->validate([
            'placa' => 'required|string|max:7|unique:veiculos,placa',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'ano' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'cor' => 'required|string|max:50',
            'cliente_id' => 'required|exists:clientes,id',
        ]);
        
        $data = $request->all();

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

        Veiculo::create($data); 

        return redirect()->route('veiculos.index')
                         ->with('success', 'Veículo cadastrado com sucesso!');
    }

    public function show(Veiculo $veiculo)
    {
        return view('veiculos.show', compact('veiculo'));
    }

    public function edit(Veiculo $veiculo)
    {
        $clientes = Cliente::orderBy('nome')->get(['id', 'nome']);
        return view('veiculos.edit', compact('veiculo', 'clientes'));
    }

    public function update(Request $request, Veiculo $veiculo)
    {
        $placa_limpa = preg_replace('/[^a-zA-Z0-9]/', '', $request->input('placa'));
        $request->merge(['placa' => $placa_limpa]);

        $request->validate([
            'placa' => 'required|string|max:7|unique:veiculos,placa,' . $veiculo->id,
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'ano' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'cor' => 'required|string|max:50',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        $data = $request->all();

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

    public function destroy(Veiculo $veiculo)
    {
        $veiculo->delete();

        return redirect()->route('veiculos.index')
                         ->with('success', 'Veículo excluído com sucesso!');
    }

    protected function formatarMaiusculas($string)
    {
        if (empty($string)) {
            return null;
        }
        return mb_strtoupper($string, 'UTF-8');
    }

    protected function formatarPlaca($placa)
    {
        if (empty($placa)) {
            return null;
        }

        $limpa = preg_replace('/[^a-zA-Z0-9]/', '', $placa);

        $limpa = mb_strtoupper($limpa, 'UTF-8');
        
        if (mb_strlen($limpa, 'UTF-8') === 7) {
            return mb_substr($limpa, 0, 3, 'UTF-8') . '-' . mb_substr($limpa, 3, 4, 'UTF-8');
        } 
        
        return $placa; 
    }
}