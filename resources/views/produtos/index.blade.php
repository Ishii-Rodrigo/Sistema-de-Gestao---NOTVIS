@extends('layouts.app')

@section('title', 'Lista de Produtos')
@section('header', 'Lista de Produtos')

@section('content')
<h1>Lista de Produtos</h1>
<a href="{{ route('produtos.create') }}">Novo Produto</a>

@if (session('success'))
    <div style="color: green; margin-top: 15px;">
        {{ session('success') }}
    </div>
@endif

<table border="1" style="width:100%; margin-top: 15px;">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Un. Medida</th>
            <th>Preço Venda</th>
            <th>Estoque Mínimo</th>
            <th>Ações</th> <!-- Nova coluna para botões -->
        </tr>
    </thead>
    <tbody>
        @foreach($produtos as $produto)
            <tr>
                <!-- Usa o Acessor do Model para mostrar o Código formatado (001, 002...) -->
                <td>{{ $produto->codigo }}</td> 
                <td>{{ $produto->nome }}</td>
                <td>{{ $produto->unidade_medida }}</td>
                <td>R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</td>
                <td>{{ $produto->estoque_minimo }}</td>
                <td>
                    <!-- Botão Editar -->
                    <a href="{{ route('produtos.edit', $produto->id) }}" 
                       style="background-color: #008CBA; color: white; padding: 5px 10px; text-decoration: none; border-radius: 3px;">
                        Editar
                    </a>
                    
                    <!-- Botão Deletar (com formulário) -->
                    <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                style="background-color: #f44336; color: white; padding: 5px 10px; border: none; cursor: pointer; border-radius: 3px;"
                                onclick="return confirm('Tem certeza que deseja deletar o produto {{ $produto->codigo }} - {{ $produto->nome }}?');">
                            Deletar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
