@extends('layouts.app')

@section('title', 'Detalhes do Cliente')
@section('header', 'Detalhes do Cliente: ' . $cliente->nome)

@section('content')

<div class="container mt-4">
    <div class="card p-4 shadow-lg">

        <h2 class="text-primary mb-4">Detalhes do Cliente: {{ $cliente->nome }}</h2>

        <div class="mb-4 d-flex justify-content-between">
            <a href="{{ route('clientes.index') }}" class="btn btn-sm btn-outline-primary" title="Voltar para a Lista">
                <i class="bi bi-arrow-left-circle-fill"></i> Voltar para a Lista
            </a>
            
            <div>
                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-sm btn-warning me-2" title="Editar Cliente">
                    <i class="bi bi-pencil-square"></i> Editar
                </a>
                
                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este cliente?')" title="Excluir Cliente">
                        <i class="bi bi-trash-fill"></i> Excluir
                    </button>
                </form>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-6 mb-4">
                <h5 class="mb-3 text-info border-bottom pb-2">Dados Pessoais/Contato</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>ID:</strong> {{ $cliente->id }}</li>
                    <li class="list-group-item"><strong>Nome/Razão Social:</strong> {{ $cliente->nome }}</li>
                    <li class="list-group-item"><strong>CPF/CNPJ:</strong> {{ $cliente->cpf_cnpj ?? 'Não informado' }}</li>
                    <li class="list-group-item"><strong>Telefone Fixo:</strong> {{ $cliente->telefone ?? 'Não informado' }}</li>
                    <li class="list-group-item"><strong>Telefone Celular:</strong> {{ $cliente->telefone_celular ?? 'Não informado' }}</li> {{-- NOVO CAMPO --}}
                    <li class="list-group-item"><strong>E-mail:</strong> {{ $cliente->email ?? 'Não informado' }}</li>
                    <li class="list-group-item"><strong>Data de Nascimento:</strong> {{ $cliente->data_nascimento ? \Carbon\Carbon::parse($cliente->data_nascimento)->format('d/m/Y') : 'Não informado' }}</li> {{-- NOVO CAMPO --}}
                </ul>
            </div>

            <div class="col-md-6 mb-4">
                <h5 class="mb-3 text-info border-bottom pb-2">Endereço Detalhado</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>CEP:</strong> {{ $cliente->cep ?? 'Não informado' }}</li>
                    <li class="list-group-item"><strong>Rua:</strong> {{ $cliente->rua ?? 'Não informado' }}</li>
                    <li class="list-group-item"><strong>Número:</strong> {{ $cliente->numero ?? 'S/N' }}</li>
                    <li class="list-group-item"><strong>Bairro:</strong> {{ $cliente->bairro ?? 'Não informado' }}</li>
                    <li class="list-group-item"><strong>Cidade:</strong> {{ $cliente->cidade ?? 'Não informado' }}</li>
                    <li class="list-group-item"><strong>Estado (UF):</strong> {{ $cliente->estado ?? 'Não informado' }}</li>
                    <li class="list-group-item"><strong>Complemento:</strong> {{ $cliente->complemento ?? 'Nenhum' }}</li>
                </ul>
            </div>
        </div>

        <hr class="my-4">

        <div class="row text-muted small">
            <div class="col-md-6">
                <strong>Criado em:</strong> {{ $cliente->created_at->format('d/m/Y H:i:s') }}
            </div>
            <div class="col-md-6">
                <strong>Última Atualização:</strong> {{ $cliente->updated_at->format('d/m/Y H:i:s') }}
            </div>
        </div>

    </div>
</div>

@endsection