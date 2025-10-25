@extends('layouts.app')

@section('title', 'Novo Produto')
@section('header', 'Cadastrar Produtos')

@section('content')

<h1>Novo Produto</h1>

@if($errors->any())
    @endif

<form action="{{ route('produtos.store') }}" method="POST">
    @csrf
    <a href="{{ route('produtos.index') }}"> Voltar para Lista</a>
    <br/><br/>
    
    <label>Nome</label>
    <input name="nome" type="text" value="{{ old('nome') }}" required/>
    <br/>
    
    <label>Descrição</label>
    <textarea name="descricao" required>{{ old('descricao') }}</textarea>
    <br/>
    
    <label>Unidade de Medida (UN, PC, etc.)</label>
    <input name="unidade_medida" type="text" value="{{ old('unidade_medida') }}" required/>
    <br/>
    
    <label>Preço de Custo</label>
    <input name="preco_custo" type="number" step="0.01" value="{{ old('preco_custo') }}" required/>
    <br/>
    
    <label>Preço de Venda</label>
    <input name="preco_venda" type="number" step="0.01" value="{{ old('preco_venda') }}" required/>
    <br/>
    
    <label>Estoque Mínimo</label>
    <input name="estoque_minimo" type="number" value="{{ old('estoque_minimo') }}" required/>
    <br/>
    
    <button type="submit">Cadastrar</button>
</form>

@endsection