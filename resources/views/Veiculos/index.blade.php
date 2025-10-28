@extends('layouts.app')

@section('title', 'Lista de Veículos')
@section('header', 'Veículos Cadastrados')

@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Lista de Veículos</h2>
        <a href="{{ route('veiculos.create') }}" class="btn btn-success" title="Cadastrar Novo Veículo">
            <i class="bi bi-plus-circle-fill"></i> Novo Veículo
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($veiculos->isEmpty())
        <div class="alert alert-info">Nenhum veículo encontrado.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Placa</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Ano/Cor</th>
                        <th>Proprietário</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($veiculos as $veiculo)
                        <tr>
                            <td>{{ $veiculo->placa }}</td>
                            <td>{{ $veiculo->marca }}</td>
                            <td>{{ $veiculo->modelo }}</td>
                            <td>{{ $veiculo->ano }} / {{ $veiculo->cor }}</td>
                            {{-- Acessa o nome do cliente pelo relacionamento --}}
                            <td>{{ $veiculo->cliente->nome ?? 'Cliente Desconhecido' }}</td>
                            <td>
                                {{-- MODIFICAÇÃO: Botões com Ícones Padronizados --}}
                                <a href="{{ route('veiculos.show', $veiculo->id) }}" class="btn btn-sm btn-info text-white" title="Ver Detalhes">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                
                                <a href="{{ route('veiculos.edit', $veiculo->id) }}" class="btn btn-sm btn-warning" title="Editar Veículo">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                
                                <form action="{{ route('veiculos.destroy', $veiculo->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Confirmar exclusão do veículo de placa {{ $veiculo->placa }}?')" 
                                            title="Excluir Veículo">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@endsection 