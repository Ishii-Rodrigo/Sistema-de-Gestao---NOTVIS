@extends('layouts.app')

@section('title', 'Detalhes do Produto')
@section('header', 'Detalhes do Produto')

@section('content')

<h1>Detalhes do Produto</h1>

<a href="{{ route('produtos.index') }}"> Voltar</a>

<div style="border: 1px solid #ccc; padding: 15px; margin-top: 15px;">
    <div>
        <strong>Código:</strong>
        {{ $produto->codigo }}
    </div>
    <div>
        <strong>Nome:</strong>
        {{ $produto->nome }}
    </div>
    <div>
        <strong>Descrição:</strong>
        {{ $produto->descricao }}
    </div>
    <div>
        <strong>Unidade de Medida:</strong>
        {{ $produto->unidade_medida }}
    </div>
    <div>
        <strong>Preço de Custo:</strong>
        R$ {{ number_format($produto->preco_custo, 2, ',', '.') }}
    </div>
    <div>
        <strong>Preço de Venda:</strong>
        R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}
    </div>
    <div>
        <strong>Estoque Mínimo:</strong>
        {{ $produto->estoque_minimo }}
    </div>
</div>

@endsection