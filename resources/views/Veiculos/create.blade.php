@extends('layouts.app')

@section('title', 'Cadastrar Novo Veículo')
@section('header', 'Cadastrar Veículo')

@section('content')

<div class="container mt-4">
    <div class="card p-4 shadow-sm">

        <h2 class="text-primary mb-4">Novo Veículo</h2>
        
        {{-- Botão Voltar --}}
        <a href="{{ route('veiculos.index') }}" class="btn btn-sm btn-outline-primary mb-3" title="Voltar para a Lista">
            <i class="bi bi-arrow-left-circle-fill"></i> Voltar para a Lista
        </a>

        {{-- Exibição de Erros de Validação (Obrigatório) --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulário de Criação (POST para 'veiculos.store') --}}
        <form action="{{ route('veiculos.store') }}" method="POST">
            @csrf {{-- Token CSRF obrigatório --}}

            <div class="row mb-3">
                
                {{-- Campo Cliente (cliente_id) --}}
                <div class="col-md-6 form-group">
                    <label for="cliente_id" class="form-label">Proprietário/Cliente (*)</label>
                    {{-- O Controller passa a variável $clientes, que deve ser usada aqui --}}
                    <select name="cliente_id" id="cliente_id" class="form-control" required>
                        <option value="">Selecione um Cliente</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Campo Placa --}}
                <div class="col-md-6 form-group">
                    <label for="placa" class="form-label">Placa (*)</label>
                    <input name="placa" id="placa" type="text" class="form-control" value="{{ old('placa') }}" required maxlength="7"/>
                </div>
            </div>
            
            <div class="row mb-3">
                {{-- Campo Marca --}}
                <div class="col-md-4 form-group">
                    <label for="marca" class="form-label">Marca (*)</label>
                    <input name="marca" id="marca" type="text" class="form-control" value="{{ old('marca') }}" required/>
                </div>
                
                {{-- Campo Modelo --}}
                <div class="col-md-4 form-group">
                    <label for="modelo" class="form-label">Modelo (*)</label>
                    <input name="modelo" id="modelo" type="text" class="form-control" value="{{ old('modelo') }}" required/>
                </div>
                
                {{-- Campo Ano --}}
                <div class="col-md-4 form-group">
                    <label for="ano" class="form-label">Ano (*)</label>
                    <input name="ano" id="ano" type="number" class="form-control" value="{{ old('ano') }}" min="1900" max="{{ date('Y') + 1 }}" required/>
                </div>
            </div>

            <div class="row mb-4">
                {{-- Campo Cor --}}
                <div class="col-md-4 form-group">
                    <label for="cor" class="form-label">Cor (*)</label>
                    <input name="cor" id="cor" type="text" class="form-control" value="{{ old('cor') }}" required/>
                </div>
            </div>
            
            {{-- Botão de Submissão (Corrigido para w-100 para padronização) --}}
            <button type="submit" class="btn btn-success w-100">
                <i class="bi bi-plus-circle-fill"></i> Cadastrar Veículo
            </button>

        </form>
    </div>
</div>

@endsection