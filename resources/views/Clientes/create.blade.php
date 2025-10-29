@extends('layouts.app')

@section('title', 'Cadastrar Novo Cliente')
@section('header', 'Cadastrar Novo Cliente')

@section('content')

<div class="container mt-4">
    <div class="card p-4 shadow-sm">

        <h2 class="text-primary mb-4">Novo Cliente</h2>
        
        <a href="{{ route('clientes.index') }}" class="btn btn-sm btn-outline-primary mb-3" title="Voltar para a Lista">
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

        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf

            <div class="row mb-4">
                <h5 class="mb-3 text-info">Dados Pessoais</h5>
                <div class="col-md-6 form-group">
                    <label for="nome" class="form-label">Nome/Razão Social (*)</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}" required>
                </div>
                <div class="col-md-6 form-group">
                    <label for="cpf_cnpj" class="form-label">CPF/CNPJ</label>
                    <input type="text" name="cpf_cnpj" id="cpf_cnpj" class="form-control" value="{{ old('cpf_cnpj') }}">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-4 form-group">
                    <label for="telefone" class="form-label">Telefone Fixo</label>
                    <input type="text" name="telefone" id="telefone" class="form-control" value="{{ old('telefone') }}">
                </div>
                <div class="col-md-4 form-group">
                    <label for="telefone_celular" class="form-label">Telefone Celular</label>
                    <input type="text" name="telefone_celular" id="telefone_celular" class="form-control" value="{{ old('telefone_celular') }}">
                </div>
                <div class="col-md-4 form-group">
                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                    {{-- CORREÇÃO DE FORMATO OLD() --}}
                    <input type="date" 
                           name="data_nascimento" 
                           id="data_nascimento" 
                           class="form-control" 
                           value="{{ old('data_nascimento') ? \Carbon\Carbon::parse(old('data_nascimento'))->format('Y-m-d') : '' }}">
                </div>
            </div>
            
            <div class="row mb-4">
                <div class="col-12 form-group">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                </div>
            </div>

            <hr class="my-4">
            <h5 class="mb-3 text-info">Informações de Endereço</h5>

            <div class="row mb-3">
                <div class="col-md-3 form-group">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" name="cep" id="cep" class="form-control" value="{{ old('cep') }}">
                </div>
                <div class="col-md-7 form-group">
                    <label for="rua" class="form-label">Rua</label>
                    <input type="text" name="rua" id="rua" class="form-control" value="{{ old('rua') }}">
                </div>
                <div class="col-md-2 form-group">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" name="numero" id="numero" class="form-control" value="{{ old('numero') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-5 form-group">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" name="bairro" id="bairro" class="form-control" value="{{ old('bairro') }}">
                </div>
                <div class="col-md-5 form-group">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" name="cidade" id="cidade" class="form-control" value="{{ old('cidade') }}">
                </div>
                <div class="col-md-2 form-group">
                    <label for="estado" class="form-label">Estado (UF)</label>
                    <input type="text" name="estado" id="estado" class="form-control" value="{{ old('estado') }}" maxlength="2">
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="complemento" class="form-label">Complemento</label>
                <input type="text" name="complemento" id="complemento" class="form-control" value="{{ old('complemento') }}">
            </div>

            <button type="submit" class="btn btn-success">Cadastrar Cliente</button>

        </form>
    </div>
</div>

@endsection