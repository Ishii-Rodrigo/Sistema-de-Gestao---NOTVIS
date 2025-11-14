@extends('layouts.app')

@section('title', 'Lista de Clientes')
@section('header', 'Clientes Cadastrados')

@section('content')

<div class="container mt-4">
    
    <h2 class="text-primary mb-3">Lista de Clientes</h2>

    <div class="d-flex justify-content-between align-items-center mb-4">
        
        <div class="d-flex align-items-center">
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary" title="Voltar ao Menu Principal">
                <i class="bi bi-arrow-left-circle-fill"></i> Voltar
            </a>
            
        </div>
        
        <div class="d-flex">
            {{-- FORMULÁRIO DE BUSCA --}}
            <form action="{{ route('clientes.index') }}" method="GET" class="d-flex me-3">
                <input type="text" 
                       name="search" 
                       class="form-control form-control-sm" 
                       placeholder="Buscar por Nome, Email, CPF..."
                       value="{{ $termo ?? '' }}" {{-- Garante que o termo buscado permaneça no input --}}
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
    
    {{-- MENSAGEM DE SUCESSO DO CRUD (se estiver no layout app.blade.php, pode remover daqui) --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    {{-- EXIBIÇÃO DO RESULTADO DA BUSCA E BOTÃO LIMPAR BUSCA --}}
    @if (!empty($termo))
        <div class="alert alert-info d-flex justify-content-between align-items-center">
            <span class="fw-bold">
                Resultado da busca por: "{{ $termo }}" ({{ $clientes->count() }} {{ $clientes->count() === 1 ? 'cliente encontrado' : 'clientes encontrados' }})
            </span>
            <a href="{{ route('clientes.index') }}" class="btn btn-sm btn-primary">
                Limpar Busca
            </a>
        </div>
    @endif


    @if ($clientes->isEmpty() && empty($termo))
        <div class="alert alert-warning" role="alert">
            Nenhum cliente cadastrado. Comece adicionando um novo cliente!
        </div>
    @elseif ($clientes->isEmpty() && !empty($termo))
        <div class="alert alert-warning" role="alert">
            Nenhum cliente encontrado para o termo de busca: **"{{ $termo }}"**.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover table-sm align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome/Razão Social</th>
                        <th>E-mail</th>
                        <th>Telefone/Celular</th>
                        <th>CPF/CNPJ</th>
                        <th>Endereço Principal</th>
                        <th style="width: 150px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->id }}</td>
                            <td>{{ $cliente->nome }}</td>
                            <td>{{ $cliente->email ?? '-' }}</td>
                            <td>{{ $cliente->telefone ?? $cliente->telefone_celular ?? '-' }}</td>
                            <td>{{ $cliente->cpf_cnpj ?? '-' }}</td>
                            <td>{{ $cliente->rua ?? '-' }}, {{ $cliente->numero ?? 'S/N' }} - {{ $cliente->cidade ?? '-' }}/{{ $cliente->estado ?? '-' }}</td>
                            
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