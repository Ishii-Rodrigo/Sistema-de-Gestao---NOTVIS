@extends('layouts.app')

@section('title', 'Novo Produto')
@section('header', 'Cadastrar Produto')

@section('content')
<div class="container mt-4">
    <div class="card p-4 shadow-sm">
        <h2 class="text-primary mb-4">Novo Produto</h2>
        
        <a href="{{ route('produtos.index') }}" class="btn btn-sm btn-outline-primary mb-3" title="Voltar para a Lista">
            <i class="bi bi-arrow-left-circle-fill"></i> Voltar para a Lista
        </a>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('produtos.store') }}" method="POST">
            @csrf
            
            <div class="row mb-3">
                <div class="col-md-6 form-group">
                    <label for="nome" class="form-label">Nome (*)</label>
                    <input name="nome" id="nome" type="text" class="form-control" value="{{ old('nome') }}" required/>
                </div>
                <div class="col-md-6 form-group">
                    <label for="unidade_medida" class="form-label">Unidade de Medida (UN, PC, etc.) (*)</label>
                    <input name="unidade_medida" id="unidade_medida" type="text" class="form-control" value="{{ old('unidade_medida') }}" required/>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 form-group">
                    <label for="preco_custo" class="form-label">Preço de Custo (*)</label>
                    <input name="preco_custo" id="preco_custo" type="number" step="0.01" class="form-control" value="{{ old('preco_custo') }}" required/>
                </div>
                <div class="col-md-4 form-group">
                    <label for="preco_venda" class="form-label">Preço de Venda (*)</label>
                    <input name="preco_venda" id="preco_venda" type="number" step="0.01" class="form-control" value="{{ old('preco_venda') }}" required/>
                </div>
                <div class="col-md-4 form-group">
                    <label for="estoque_minimo" class="form-label">Estoque Mínimo (*)</label>
                    <input name="estoque_minimo" id="estoque_minimo" type="number" class="form-control" value="{{ old('estoque_minimo', 0) }}" required/>
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea name="descricao" id="descricao" class="form-control" rows="3">{{ old('descricao') }}</textarea>
            </div>
            
            {{-- MODIFICADO: Adicionado ícone ao botão de submissão --}}
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save-fill"></i> Cadastrar Produto
            </button>

        </form>
    </div>
</div>
@endsection