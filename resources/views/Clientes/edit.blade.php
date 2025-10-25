@extends('layouts.app')

@section('title', 'Editar Cliente: ' . $cliente->nome)
@section('header', 'Editar Cliente')

@section('content')

<div class="container mt-4">
    <div class="card p-4 shadow-sm">

        <h2 class="text-primary mb-4">Editar Cliente: {{ $cliente->nome }}</h2>
        <!-- Link de volta para a tela de detalhes do cliente -->
        <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-sm btn-outline-secondary mb-3">
            ← Voltar para Detalhes
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

        <!-- O formulário aponta para o método 'update' e usa o método HTTP PUT -->
        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
            @csrf
            @method('PUT') 

            <!-- DADOS PESSOAIS/CONTATO -->
            <div class="row mb-4">
                <div class="col-md-6 form-group">
                    <label for="nome" class="form-label">Nome/Razão Social (*)</label>
                    <!-- Usa old() para reter valor em caso de erro de validação, senão usa o valor do cliente -->
                    <input type="text" name="nome" id="nome" class="form-control" 
                           value="{{ old('nome', $cliente->nome) }}" required>
                </div>
                <div class="col-md-6 form-group">
                    <label for="cpf_cnpj" class="form-label">CPF/CNPJ</label>
                    <input type="text" name="cpf_cnpj" id="cpf_cnpj" class="form-control" 
                           value="{{ old('cpf_cnpj', $cliente->cpf_cnpj) }}">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6 form-group">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" name="telefone" id="telefone" class="form-control" 
                           value="{{ old('telefone', $cliente->telefone) }}">
                </div>
                <div class="col-md-6 form-group">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" 
                           value="{{ old('email', $cliente->email) }}">
                </div>
            </div>
            
            <hr class="my-4">
            <h5 class="mb-3 text-info">Informações de Endereço (Separadas)</h5>

            <!-- ENDEREÇO: CEP / RUA / NÚMERO -->
            <div class="row mb-3">
                <div class="col-md-3 form-group">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" name="cep" id="cep" class="form-control" 
                           value="{{ old('cep', $cliente->cep) }}">
                </div>
                <div class="col-md-7 form-group">
                    <label for="rua" class="form-label">Rua</label>
                    <input type="text" name="rua" id="rua" class="form-control" 
                           value="{{ old('rua', $cliente->rua) }}">
                </div>
                <div class="col-md-2 form-group">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" name="numero" id="numero" class="form-control" 
                           value="{{ old('numero', $cliente->numero) }}">
                </div>
            </div>

            <!-- ENDEREÇO: BAIRRO / CIDADE / ESTADO -->
            <div class="row mb-3">
                <div class="col-md-5 form-group">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" name="bairro" id="bairro" class="form-control" 
                           value="{{ old('bairro', $cliente->bairro) }}">
                </div>
                <div class="col-md-5 form-group">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" name="cidade" id="cidade" class="form-control" 
                           value="{{ old('cidade', $cliente->cidade) }}">
                </div>
                <div class="col-md-2 form-group">
                    <label for="estado" class="form-label">Estado (UF)</label>
                    <input type="text" name="estado" id="estado" class="form-control" 
                           value="{{ old('estado', $cliente->estado) }}" maxlength="2">
                </div>
            </div>

            <!-- ENDEREÇO: COMPLEMENTO -->
            <div class="form-group mb-4">
                <label for="complemento" class="form-label">Complemento</label>
                <input type="text" name="complemento" id="complemento" class="form-control" 
                       value="{{ old('complemento', $cliente->complemento) }}">
            </div>

            <!-- Botão de Submissão -->
            <button type="submit" class="btn btn-success">Salvar Alterações</button>

        </form>
    </div>
</div>

@endsection
