@extends('layouts.app')

@section('title', 'Cadastrar Novo Veículo')
@section('header', 'Cadastrar Novo Veículo')

@section('content')

<div class="container mt-4">
    <div class="card p-4 shadow-sm">

        <h2 class="text-primary mb-4">Cadastrar Novo Veículo</h2>
        <a href="{{ route('veiculos.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
            ← Voltar para a Lista
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

        <form action="{{ route('veiculos.store') }}" method="POST">
            @csrf
            
            <div class="row mb-4">
                {{-- PROPRIETÁRIO --}}
                <div class="col-md-6 form-group">
                    <label for="cliente_id" class="form-label">Proprietário (*)</label>
                    <select name="cliente_id" id="cliente_id" class="form-control" required>
                        <option value="">Selecione um Cliente</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('cliente_id') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                
                {{-- PLACA --}}
                <div class="col-md-3 form-group">
                    <label for="placa" class="form-label">Placa (*)</label>
                    <input type="text" name="placa" id="placa" class="form-control" 
                           value="{{ old('placa') }}" maxlength="7" required>
                    @error('placa') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row mb-4">
                {{-- MARCA --}}
                <div class="col-md-4 form-group">
                    <label for="marca" class="form-label">Marca (*)</label>
                    <input type="text" name="marca" id="marca" class="form-control" 
                           value="{{ old('marca') }}" required>
                    @error('marca') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                
                {{-- MODELO --}}
                <div class="col-md-5 form-group">
                    <label for="modelo" class="form-label">Modelo (*)</label>
                    <input type="text" name="modelo" id="modelo" class="form-control" 
                           value="{{ old('modelo') }}" required>
                    @error('modelo') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                
                {{-- ANO --}}
                <div class="col-md-3 form-group">
                    <label for="ano" class="form-label">Ano (*)</label>
                    <input type="number" name="ano" id="ano" class="form-control" 
                           value="{{ old('ano') }}" required min="1900" max="{{ date('Y') + 1 }}">
                    @error('ano') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row mb-4">
                {{-- COR --}}
                <div class="col-md-4 form-group">
                    <label for="cor" class="form-label">Cor (*)</label>
                    <input type="text" name="cor" id="cor" class="form-control" 
                           value="{{ old('cor') }}" required>
                    @error('cor') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar Veículo</button>
        </form>
    </div>
</div>

@endsection
