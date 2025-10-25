@extends('layouts.app')

@section('title', 'Lista de Clientes')
@section('header', 'Clientes Cadastrados')

@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Lista de Clientes</h2>
        <a href="{{ route('clientes.create') }}" class="btn btn-success">
            + Novo Cliente
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($clientes->isEmpty())
        <div class="alert alert-info">Nenhum cliente encontrado.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome/Razão Social</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <!-- Campos de endereço na listagem -->
                        <th>CEP</th>
                        <th>Cidade/UF</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->id }}</td>
                            <td>{{ $cliente->nome }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ $cliente->telefone }}</td>
                            <!-- Exibindo os campos de endereço, com fallback para '-' -->
                            <td>{{ $cliente->cep ?? '-' }}</td>
                            <td>{{ $cliente->cidade ?? '-' }}/{{ $cliente->estado ?? '-' }}</td>
                            <td>
                                <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-sm btn-info text-white">Ver</a>
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirmar exclusão de {{ $cliente->nome }}?')">Excluir</button>
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
