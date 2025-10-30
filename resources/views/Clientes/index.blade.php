@extends('layouts.app')

@section('title', 'Lista de Clientes')
@section('header', 'Clientes Cadastrados')

@section('content')

<div class="container mt-4">
    
    {{-- AQUI ESTÁ O TÍTULO EM LINHA PRÓPRIA, ACIMA DOS BOTÕES --}}
    <h2 class="text-primary mb-3">Lista de Clientes</h2>

    <div class="d-flex justify-content-between align-items-center mb-4">
        
        <div class="d-flex align-items-center">
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary" title="Voltar ao Menu Principal">
                <i class="bi bi-arrow-left-circle-fill"></i> Voltar
            </a>
            
            {{-- REMOVIDO: <h2 class="text-primary mb-0">Lista de Clientes</h2> --}}
        </div>
        
        {{-- CAMPO DE PESQUISA COM BOTÃO E NOVO CLIENTE --}}
        <div class="d-flex">
            <form action="{{ route('clientes.index') }}" method="GET" class="d-flex me-3">
                <input type="text" 
                       name="search" 
                       class="form-control form-control-sm" 
                       placeholder="Buscar por Nome, Email, CPF..."
                       value="{{ $termo ?? '' }}"
                       style="width: 250px;">
                       
                <button type="submit" class="btn btn-sm btn-secondary ms-2" title="Pesquisar Clientes">
                    <i class="bi bi-search"></i> Pesquisar
                </button>
            </form>
            
            <a href="{{ route('clientes.create') }}" class="btn btn-sm btn-success" title="Cadastrar Novo Cliente">
                <i class="bi bi-plus-circle-fill"></i> Novo Cliente
            </a>
        </div>
    </div>

    {{-- Exibe o termo de pesquisa atual --}}
    @isset($termo)
        @if($termo)
            <div class="alert alert-info d-flex justify-content-between align-items-center">
                <span>Resultados para o termo: <strong>"{{ $termo }}"</strong></span>
                <a href="{{ route('clientes.index') }}" class="btn btn-sm btn-info text-white">Limpar Pesquisa</a>
            </div>
        @endif
    @endisset

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($clientes->isEmpty())
        <div class="alert alert-warning">Nenhum cliente encontrado. @isset($termo) para o termo "{{ $termo }}" @endisset.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome/Razão Social</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
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
                            <td>{{ $cliente->cep ?? '-' }}</td>
                            <td>{{ $cliente->cidade ?? '-' }}/{{ $cliente->estado ?? '-' }}</td>
                            
                            {{-- BOTÕES DE AÇÃO --}}
                            <td>
                                <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-sm btn-info text-white" title="Ver Detalhes">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-sm btn-warning" title="Editar Cliente">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirmar exclusão de {{ $cliente->nome }}?')" title="Excluir Cliente">
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