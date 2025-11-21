@extends('layouts.app')

@section('title', 'Detalhes do Veículo: ' . $veiculo->placa)
@section('header', 'Detalhes do Veículo')

@section('content')

<div class="container mt-4">
    <div class="card p-4 shadow-sm">

        <h2 class="text-primary mb-4">Detalhes do Veículo (Placa: {{ $veiculo->placa }})</h2>

        <div class="mb-4 d-flex justify-content-between">

            <a href="{{ route('veiculos.index') }}" class="btn btn-sm btn-outline-primary" title="Voltar para a Lista">
                <i class="bi bi-arrow-left-circle-fill"></i> Voltar para a Lista
            </a>
            <div>
                <a href="{{ route('veiculos.edit', $veiculo->id) }}" class="btn btn-warning me-2">
                    <i class="bi bi-pencil-square"></i> Editar
                </a>
                
                <form action="{{ route('veiculos.destroy', $veiculo->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" 
                            onclick="return confirm('Confirmar exclusão do veículo de placa {{ $veiculo->placa }}?')">
                        <i class="bi bi-trash-fill"></i> Excluir
                    </button>
                </form>
            </div>
        </div>
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row mt-4">
            {{-- Coluna de Detalhes do Veículo --}}
            <div class="col-md-6 mb-4">
                <h4 class="text-info mb-3">Informações do Veículo</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Placa:</strong> <span class="fw-bold">{{ $veiculo->placa }}</span></li>
                    <li class="list-group-item"><strong>Marca:</strong> {{ $veiculo->marca }}</li>
                    <li class="list-group-item"><strong>Modelo:</strong> {{ $veiculo->modelo }}</li>
                    <li class="list-group-item"><strong>Ano:</strong> {{ $veiculo->ano }}</li>
                    <li class="list-group-item"><strong>Cor:</strong> {{ $veiculo->cor }}</li>
                </ul>
            </div>

            <div class="col-md-6 mb-4">
                <h4 class="text-info mb-3">Informações do Proprietário</h4>
                @if ($veiculo->cliente)
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Nome:</strong> 
                            <a href="{{ route('clientes.show', $veiculo->cliente->id) }}" class="text-primary fw-bold">{{ $veiculo->cliente->nome }}</a>
                        </li>
                        <li class="list-group-item"><strong>CPF/CNPJ:</strong> {{ $veiculo->cliente->cpf_cnpj ?? 'Não informado' }}</li>
                        <li class="list-group-item"><strong>Telefone:</strong> {{ $veiculo->cliente->telefone ?? 'Não informado' }}</li>
                        <li class="list-group-item"><strong>E-mail:</strong> {{ $veiculo->cliente->email ?? 'Não informado' }}</li>
                        <li class="list-group-item">
                            <strong>Endereço:</strong> 
                            {{ $veiculo->cliente->rua ?? 'Rua não informada' }}, {{ $veiculo->cliente->numero ?? 'S/N' }} 
                            - {{ $veiculo->cliente->bairro ?? 'Bairro não informado' }}, 
                            {{ $veiculo->cliente->cidade ?? 'Cidade não informada' }}/{{ $veiculo->cliente->estado ?? 'UF' }}
                            @if($veiculo->cliente->complemento) ({{ $veiculo->cliente->complemento }}) @endif
                        </li>
                    </ul>
                @else
                    <div class="alert alert-warning">Proprietário não encontrado ou removido.</div>
                @endif
            </div>
        </div>

        <hr class="my-4">

        <div class="row text-muted small">
            <div class="col-md-6">
                <strong>Criado em:</strong> {{ $veiculo->created_at->format('d/m/Y H:i:s') }}
            </div>
            <div class="col-md-6">
                <strong>Última Atualização:</strong> {{ $veiculo->updated_at->format('d/m/Y H:i:s') }}
            </div>
        </div>

    </div>
</div>

@endsection