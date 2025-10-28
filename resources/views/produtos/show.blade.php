@extends('layouts.app')

@section('title', 'Detalhes do Produto')
@section('header', 'Detalhes do Produto')

@section('content')
<div class="container mt-4">
    <div class="card p-4 shadow-lg">

        <h2 class="text-primary mb-4">Detalhes do Produto: {{ $produto->nome }}</h2>

        <div class="mb-4 d-flex justify-content-between">
            <a href="{{ route('produtos.index') }}" class="btn btn-sm btn-outline-primary" title="Voltar para a Lista">
                <i class="bi bi-arrow-left-circle-fill"></i> Voltar para a Lista
            </a>
            
            <div class="d-flex">
                <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-sm btn-warning me-2" title="Editar Produto">
                    <i class="bi bi-pencil-square"></i> Editar
                </a>
                
                <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este produto?')" title="Excluir Produto">
                        <i class="bi bi-trash-fill"></i> Excluir
                    </button>
                </form>
            </div>
        </div>
        
        <hr>

        <div class="row">
            <div class="col-md-6 mb-4">
                <h5 class="mb-3 text-info border-bottom pb-2">Informações Básicas</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Código:</strong> {{ $produto->codigo }}</li>
                    <li class="list-group-item"><strong>Nome:</strong> {{ $produto->nome }}</li>
                    <li class="list-group-item"><strong>Unidade de Medida:</strong> {{ $produto->unidade_medida }}</li>
                </ul>
            </div>
            <div class="col-md-6 mb-4">
                <h5 class="mb-3 text-info border-bottom pb-2">Valores e Estoque</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Preço de Custo:</strong> R$ {{ number_format($produto->preco_custo, 2, ',', '.') }}</li>
                    <li class="list-group-item"><strong>Preço de Venda:</strong> R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</li>
                    <li class="list-group-item"><strong>Estoque Mínimo:</strong> {{ $produto->estoque_minimo }}</li>
                </ul>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <h5 class="mb-3 text-info border-bottom pb-2">Descrição</h5>
                <div class="card card-body bg-light">
                    {{ $produto->descricao }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection