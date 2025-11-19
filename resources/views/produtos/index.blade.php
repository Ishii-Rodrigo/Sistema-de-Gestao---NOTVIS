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
            {{-- FORMULÁRIO DE BUSCA --}}
            <form action="{{ route('produtos.index') }}" method="GET" class="d-flex me-3">
                <input type="text" 
                       name="search" 
                       class="form-control form-control-sm" 
                       placeholder="Buscar por Nome..."
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

    @if($produtos->isEmpty())
        <div class="alert alert-warning text-center">
            Nenhum produto encontrado.
        </div>
    @else
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <div class="table-responsive">
            <table class="table table-sm table-striped table-hover align-middle">
                <thead>
                    <tr>
                        {{-- Novos pesos e alinhamentos --}}
                        <th style="width: 10%">Código</th>
                        <th style="width: 35%">Nome</th>
                        <th style="width: 10%">Unidade</th>
                        
                        {{-- Coluna Venda: Largura ajustada e alinhamento à direita --}}
                        <th style="width: 15%" class="text-end">Venda</th>
                        
                        {{-- Coluna Estoque Atual: Largura ajustada e alinhamento à direita --}}
                        <th style="width: 15%" class="text-end">Estoque Atual</th> 
                        
                        {{-- Coluna Ações: Largura ajustada e alinhamento centralizado --}}
                        <th style="width: 15%" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produtos as $produto)
                        <tr>
                            <td>{{ $produto->codigo }}</td>
                            <td>{{ $produto->nome }}</td>
                            {{-- 💡 CORRIGIDO: Exibe o nome por extenso usando o mapeamento --}}
                            <td>{{ $unidadesMap[$produto->unidade_medida] ?? $produto->unidade_medida }}</td>
                            
                            {{-- Dado Venda: Alinhado à direita --}}
                            <td class="text-end">R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</td>
                            
                            {{-- Dado Estoque Atual: Alinhado à direita --}}
                            <td class="text-end">{{ $produto->estoque_atual }}</td>
                            
                            <td class="text-center"> {{-- Centraliza os botões --}}
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