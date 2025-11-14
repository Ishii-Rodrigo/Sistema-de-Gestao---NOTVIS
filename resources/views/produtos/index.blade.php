@extends('layouts.app')

@section('title', 'Lista de Produtos')
@section('header', 'Lista de Produtos')

@section('content')
<div class="container mt-4">
    
    <h2 class="text-primary mb-3">Lista de Produtos</h2> 

    <div class="d-flex justify-content-between align-items-center mb-4">
        
        <div class="d-flex align-items-center">
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary" title="Voltar ao Menu Principal">
                <i class="bi bi-arrow-left-circle-fill"></i> Voltar
            </a>
        </div>
     
        <div class="d-flex">
            {{-- FORMULÁRIO DE BUSCA (Certifique-se que o NAME é 'search') --}}
            <form action="{{ route('produtos.index') }}" method="GET" class="d-flex me-3">
                <input type="text" 
                       name="search" 
                       class="form-control form-control-sm" 
                       placeholder="Buscar por Nome..." {{-- AJUSTE NO PLACEHOLDER --}}
                       value="{{ $termo ?? '' }}" {{-- Mantém o termo de busca no input --}}
                       style="width: 250px;">
                       
                <button type="submit" class="btn btn-sm btn-secondary ms-2" title="Pesquisar Produtos">
                    <i class="bi bi-search"></i> Pesquisar
                </button>
            </form>
            
            <a href="{{ route('produtos.create') }}" class="btn btn-sm btn-success" title="Cadastrar Novo Produto">
                <i class="bi bi-plus-circle-fill"></i> Novo Produto
            </a>
        </div>
    </div>

    {{-- MENSAGEM DE SUCESSO --}}
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
                Resultado da busca por: "{{ $termo }}" ({{ $produtos->count() }} {{ $produtos->count() === 1 ? 'produto encontrado' : 'produtos encontrados' }})
            </span>
            <a href="{{ route('produtos.index') }}" class="btn btn-sm btn-primary">
                Limpar Busca
            </a>
        </div>
    @endif

    {{-- VERIFICAÇÃO SE HÁ PRODUTOS OU SE A BUSCA FOI VAZIA --}}
    @if ($produtos->isEmpty() && empty($termo))
        <div class="alert alert-warning" role="alert">
            Nenhum produto cadastrado. Comece adicionando um novo produto!
        </div>
    @elseif ($produtos->isEmpty() && !empty($termo))
        <div class="alert alert-warning" role="alert">
            Nenhum produto encontrado para o termo de busca: **"{{ $termo }}"**.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover table-sm align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Unidade</th>
                        <th>Cód.</th>
                        <th>Quantidade</th>
                        <th>Preço Venda</th>
                        <th style="width: 150px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produtos as $produto)
                        <tr>
                            <td>{{ $produto->id }}</td>
                            <td>{{ $produto->nome }}</td>
                            <td>{{ $produto->unidade_medida }}</td>
                            <td>{{ $produto->codigo ?? '-' }}</td>
                            <td>{{ $produto->estoque_minimo }}</td>
                            <td>R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</td>
                            <td>
                                {{-- BOTÕES DE AÇÃO --}}
                                <a href="{{ route('produtos.show', $produto->id) }}" class="btn btn-sm btn-info text-white" title="Ver Detalhes">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                
                                <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-sm btn-warning" title="Editar Produto">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                
                                <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirmar exclusão de {{ $produto->nome }}?')" title="Excluir Produto">
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