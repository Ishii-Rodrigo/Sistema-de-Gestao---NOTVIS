@extends('layouts.app')

@section('title', 'Editar Veículo: ' . $veiculo->placa)
@section('header', 'Editar Veículo')

@section('content')

<div class="container mt-4">
    <div class="card p-4 shadow-sm">

        <h2 class="text-primary mb-4">Editar Veículo (Placa: {{ $veiculo->placa }})</h2>
        
        <a href="{{ route('veiculos.show', $veiculo->id) }}" class="btn btn-sm btn-outline-primary mb-3" title="Voltar para Detalhes">
            <i class="bi bi-arrow-left-circle-fill"></i> Voltar para Detalhes
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

        <form action="{{ route('veiculos.update', $veiculo->id) }}" method="POST">
            @csrf 
            @method('PUT')

            <div class="row mb-3">
                
                <div class="col-md-6 form-group">
                    <label for="cliente_id" class="form-label">Proprietário/Cliente (*)</label>
                    <select name="cliente_id" id="cliente_id" class="form-control" required>
                        <option value="">Selecione um Cliente</option>
                        {{-- O Controller deve passar a variável $clientes --}}
                        @foreach ($clientes as $cliente)
                            {{-- Usa old() para persistir dados, ou $veiculo->cliente_id para o valor atual --}}
                            <option value="{{ $cliente->id }}" {{ old('cliente_id', $veiculo->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 form-group">
                    <label for="placa" class="form-label">Placa (*)</label>
                    <input name="placa" id="placa" type="text" class="form-control" value="{{ old('placa', $veiculo->placa) }}" required maxlength="7"/>
                </div>
            </div>
            
            <div class="row mb-3">
               
                <div class="col-md-4 form-group">
                    <label for="marca" class="form-label">Marca (*)</label>
                    <input name="marca" id="marca" type="text" class="form-control" value="{{ old('marca', $veiculo->marca) }}" required/>
                </div>
                
                <div class="col-md-4 form-group">
                    <label for="modelo" class="form-label">Modelo (*)</label>
                    <input name="modelo" id="modelo" type="text" class="form-control" value="{{ old('modelo', $veiculo->modelo) }}" required/>
                </div>
                
                <div class="col-md-4 form-group">
                    <label for="ano" class="form-label">Ano (*)</label>
                    <input name="ano" id="ano" type="number" class="form-control" value="{{ old('ano', $veiculo->ano) }}" min="1900" max="{{ date('Y') + 1 }}" required/>
                </div>
            </div>

            <div class="row mb-4">
             
                <div class="col-md-4 form-group">
                    <label for="cor" class="form-label">Cor (*)</label>
                    <input name="cor" id="cor" type="text" class="form-control" value="{{ old('cor', $veiculo->cor) }}" required/>
                </div>
            </div>
            
            <button type="submit" class="btn btn-warning w-100">
                <i class="bi bi-pencil-square"></i> Salvar Alterações
            </button>

        </form>
    </div>
</div>

@endsection