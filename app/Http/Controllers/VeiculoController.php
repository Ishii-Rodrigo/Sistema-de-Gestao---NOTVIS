<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\Cliente; // Importar o Model Cliente para usar na criação/edição

class VeiculoController extends Controller
{
    /**
     * Exibe a lista de todos os veículos.
     */
    public function index()
    {
        // Carrega os veículos com o nome do cliente (eager loading)
        $veiculos = Veiculo::with('cliente')->latest()->get();
        return view('veiculos.index', compact('veiculos'));
    }

    /**
     * Mostra o formulário para criar um novo veículo.
     */
    public function create()
    {
        // Precisamos dos clientes para o dropdown de seleção no formulário
        $clientes = Cliente::orderBy('nome')->get(['id', 'nome']);
        return view('veiculos.create', compact('clientes'));
    }

    /**
     * Armazena um novo veículo no banco de dados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required|string|max:7|unique:veiculos,placa',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'ano' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'cor' => 'required|string|max:50',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        Veiculo::create($request->all());

        return redirect()->route('veiculos.index')
                         ->with('success', 'Veículo cadastrado com sucesso!');
    }

    /**
     * Exibe os detalhes de um veículo específico.
     */
    public function show(Veiculo $veiculo)
    {
        // Carrega o veículo com as informações do cliente
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
        $request->validate([
            // 'placa' deve ser único, exceto para o veículo atual
            'placa' => 'required|string|max:7|unique:veiculos,placa,' . $veiculo->id,
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'ano' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'cor' => 'required|string|max:50',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        $veiculo->update($request->all());

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
}
