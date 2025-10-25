@extends('layouts.app')

@section('title', 'Editar Produto')
@section('header', 'Editar Produto')

@section('content')

<h1 style="color:#008CBA;">Editar Produto: {{ $produto->nome }}</h1>
<p style="color:#555;">Código Sequencial: 
    <strong style="color:#f44336;">{{ $produto->codigo }}</strong> 
    (Este campo é gerado automaticamente e não pode ser editado.)
</p>

@if($errors->any())
    <div style="color:red; background-color: #ffeaea; border: 1px solid red; padding: 10px; margin-bottom: 20px; border-radius: 5px;">
        <h3>Por favor, corrija os seguintes erros:</h3>
        <ul style="margin-left: 20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- O formulário aponta para a rota 'produtos.update' e usa o ID do produto -->
<form action="{{ route('produtos.update', $produto->id) }}" method="POST" style="max-width: 500px; padding: 20px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9;">
    @csrf
    <!-- O Laravel exige este campo oculto para simular o método PUT/PATCH -->
    @method('PUT') 
    
    <a href="{{ route('produtos.index') }}" style="display: block; margin-bottom: 20px; color: #008CBA; text-decoration: none;">&larr; Voltar para a Lista</a>
    
    <!-- Campo Nome -->
    <div style="margin-bottom: 15px;">
        <label for="nome" style="display: block; font-weight: bold; margin-bottom: 5px;">Nome</label>
        <input id="nome" name="nome" type="text" 
               value="{{ old('nome', $produto->nome) }}" 
               required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"/>
    </div>
    
    <!-- Campo Descrição -->
    <div style="margin-bottom: 15px;">
        <label for="descricao" style="display: block; font-weight: bold; margin-bottom: 5px;">Descrição</label>
        <textarea id="descricao" name="descricao" required 
                  style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; min-height: 80px;">{{ old('descricao', $produto->descricao) }}</textarea>
    </div>
    
    <!-- Campo Unidade de Medida -->
    <div style="margin-bottom: 15px;">
        <label for="unidade_medida" style="display: block; font-weight: bold; margin-bottom: 5px;">Unidade de Medida (UN, PC, etc.)</label>
        <input id="unidade_medida" name="unidade_medida" type="text" 
               value="{{ old('unidade_medida', $produto->unidade_medida) }}" 
               required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"/>
    </div>
    
    <!-- Campo Preço de Custo -->
    <div style="margin-bottom: 15px;">
        <label for="preco_custo" style="display: block; font-weight: bold; margin-bottom: 5px;">Preço de Custo</label>
        <input id="preco_custo" name="preco_custo" type="number" step="0.01" 
               value="{{ old('preco_custo', $produto->preco_custo) }}" 
               required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"/>
    </div>
    
    <!-- Campo Preço de Venda -->
    <div style="margin-bottom: 15px;">
        <label for="preco_venda" style="display: block; font-weight: bold; margin-bottom: 5px;">Preço de Venda</label>
        <input id="preco_venda" name="preco_venda" type="number" step="0.01" 
               value="{{ old('preco_venda', $produto->preco_venda) }}" 
               required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"/>
    </div>
    
    <!-- Campo Estoque Mínimo -->
    <div style="margin-bottom: 25px;">
        <label for="estoque_minimo" style="display: block; font-weight: bold; margin-bottom: 5px;">Estoque Mínimo</label>
        <input id="estoque_minimo" name="estoque_minimo" type="number" 
               value="{{ old('estoque_minimo', $produto->estoque_minimo) }}" 
               required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"/>
    </div>
    
    <button type="submit" 
            style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 4px; font-size: 16px;">
        Salvar Alterações
    </button>
</form>

@endsection
