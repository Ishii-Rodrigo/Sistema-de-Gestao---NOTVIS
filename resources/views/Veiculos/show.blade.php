@extends('layouts.app')

@section('title', 'Detalhes do Veículo: ' . $veiculo->placa)
@section('header', 'Detalhes do Veículo')

@section('content')

<div class="container mt-4">
    <div class="card p-4 shadow-sm">

        <h2 class="text-primary mb-4">Detalhes do Veículo</h2>

        <div class="mb-3">
            <a href="{{ route('veiculos.index') }}" class="btn btn-sm btn-outline-secondary">
                ← Voltar para a Lista
            </a>
            <a href="{{ route('veiculos.edit', $veiculo->id) }}" class="btn btn-sm btn-warning">
                Editar Veículo
            </a>
            <form action="{{ route('veiculos.destroy', $veiculo->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" 
                        onclick="return confirm('Confirmar exclusão do veículo de placa {{ $veiculo->placa }}?')">
                    Excluir
                </button>
            </form>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row mt-4">
            {{-- Coluna de Detalhes do Veículo --}}
            <div class="col-md-6">
                <h4 class="text-info mb-3">Informações do Veículo</h4>
                <p><strong>Placa:</strong> {{ $veiculo->placa }}</p>
                <p><strong>Marca:</strong> {{ $veiculo->marca }}</p>
                <p><strong>Modelo:</strong> {{ $veiculo->modelo }}</p>
                <p><strong>Ano:</strong> {{ $veiculo->ano }}</p>
                <p><strong>Cor:</strong> {{ $veiculo->cor }}</p>
                <hr>
                <p><strong>Criado em:</strong> {{ $veiculo->created_at->format('d/m/Y H:i:s') }}</p>
                <p><strong>Última Atualização:</strong> {{ $veiculo->updated_at->format('d/m/Y H:i:s') }}</p>
            </div>

            {{-- Coluna de Detalhes do Cliente --}}
            <div class="col-md-6">
                <h4 class="text-info mb-3">Informações do Proprietário</h4>
                @if ($veiculo->cliente)
                    <p>
                        <strong>Nome:</strong> 
                        <a href="{{ route('clientes.show', $veiculo->cliente->id) }}">{{ $veiculo->cliente->nome }}</a>
                    </p>
                    <p><strong>CPF/CNPJ:</strong> {{ $veiculo->cliente->cpf_cnpj }}</p>
                    <p><strong>Telefone:</strong> {{ $veiculo->cliente->telefone }}</p>
                    <p><strong>E-mail:</strong> {{ $veiculo->cliente->email }}</p>
                    <p>
                        <strong>Endereço:</strong> 
                        {{ $veiculo->cliente->rua }}, {{ $veiculo->cliente->numero }} 
                        - {{ $veiculo->cliente->bairro }}, 
                        {{ $veiculo->cliente->cidade }}/{{ $veiculo->cliente->estado }}
                        @if($veiculo->cliente->complemento) ({{ $veiculo->cliente->complemento }}) @endif
                    </p>
                @else
                    <div class="alert alert-warning">Proprietário não encontrado ou removido.</div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
