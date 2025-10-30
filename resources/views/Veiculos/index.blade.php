@extends('layouts.app')

@section('title', 'Lista de Veículos')
@section('header', 'Veículos Cadastrados')

@section('content')

<div class="container mt-4">
    
    <h2 class="text-primary mb-3">Lista de Veículos</h2>

    <div class="d-flex justify-content-between align-items-center mb-4">
        
        <div class="d-flex align-items-center">
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary" title="Voltar ao Menu Principal">
                <i class="bi bi-arrow-left-circle-fill"></i> Voltar
            </a>
        </div>
        
        {{-- CAMPO DE PESQUISA COM BOTÃO E NOVO VEÍCULO --}}
        <div class="d-flex">
            <form action="{{ route('veiculos.index') }}" method="GET" class="d-flex me-3">
                <input type="text" 
                       name="search" 
                       class="form-control form-control-sm" 
                       placeholder="Buscar por Placa, Marca, Modelo ou Cliente..."
                       value="{{ $termo ?? '' }}"
                       style="width: 300px;">
                       
                <button type="submit" class="btn btn-sm btn-secondary ms-2" title="Pesquisar Veículos">
                    <i class="bi bi-search"></i> Pesquisar
                </button>
            </form>

            <a href="{{ route('veiculos.create') }}" class="btn btn-sm btn-success" title="Cadastrar Novo Veículo">
                <i class="bi bi-plus-circle-fill"></i> Novo Veículo
            </a>
        </div>
    </div>

    {{-- NOVO: Exibe o termo de pesquisa atual --}}
    @isset($termo)
        @if($termo)
            <div class="alert alert-info d-flex justify-content-between align-items-center">
                <span>Resultados para o termo: <strong>"{{ $termo }}"</strong></span>
                <a href="{{ route('veiculos.index') }}" class="btn btn-sm btn-info text-white">Limpar Pesquisa</a>
            </div>
        @endif
    @endisset

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($veiculos->isEmpty())
        <div class="alert alert-info">Nenhum veículo encontrado @isset($termo) para o termo "{{ $termo }}" @endisset.</div>
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
                            <td>{{ $veiculo->cliente->nome ?? 'Cliente Desconhecido' }}</td>
                            <td>
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