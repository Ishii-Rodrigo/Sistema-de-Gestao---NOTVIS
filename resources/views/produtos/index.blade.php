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
        
        {{-- CAMPO DE PESQUISA COM BOTÃO E NOVO PRODUTO --}}
        <div class="d-flex">
            <form action="{{ route('produtos.index') }}" method="GET" class="d-flex me-3">
                <input type="text" 
                       name="search" 
                       class="form-control form-control-sm" 
                       placeholder="Buscar por Nome ou Código..."
                       value="{{ $termo ?? '' }}"
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

    {{-- NOVO: Exibe o termo de pesquisa atual --}}
    @isset($termo)
        @if($termo)
            <div class="alert alert-info d-flex justify-content-between align-items-center">
                <span>Resultados para o termo: <strong>"{{ $termo }}"</strong></span>
                <a href="{{ route('produtos.index') }}" class="btn btn-sm btn-info text-white">Limpar Pesquisa</a>
            </div>
        @endif
    @endisset

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($produtos->isEmpty())
        <div class="alert alert-info">Nenhum produto encontrado @isset($termo) para o termo "{{ $termo }}" @endisset.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Un. Medida</th>
                        <th>Preço Venda</th>
                        <th>Estoque Mínimo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produtos as $produto)
                        <tr>
                            <td>{{ $produto->codigo }}</td> 
                            <td>{{ $produto->nome }}</td>
                            <td>{{ $produto->unidade_medida }}</td>
                            <td>R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</td>
                            <td>{{ $produto->estoque_minimo }}</td>
                            <td>
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