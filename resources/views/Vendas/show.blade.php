@extends('layouts.app')

@section('title', 'Detalhes da Venda ID: ' . $venda->id)
@section('header', 'Detalhes da Venda')

@section('content')
<div class="container mt-4">
    <div class="card p-4 shadow-lg">

        <h2 class="text-primary mb-4">Venda/Orçamento #{{ $venda->id }}</h2>

        {{-- BOTÕES DE AÇÃO: Voltar, Editar, Excluir --}}
        <div class="mb-4 d-flex justify-content-between">
            <a href="{{ route('vendas.index') }}" class="btn btn-sm btn-outline-primary" title="Voltar para a Lista">
                <i class="bi bi-arrow-left-circle-fill"></i> Voltar para a Lista
            </a>
            
            <div class="d-flex">
                <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-sm btn-warning me-2" title="Editar Venda">
                    <i class="bi bi-pencil-square"></i> Editar
                </a>
                
                <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta venda/orçamento?')" title="Excluir Venda">
                        <i class="bi bi-trash-fill"></i> Excluir
                    </button>
                </form>
            </div>
        </div>
        
        <hr>
        
        <div class="row mb-4">
            <div class="col-md-6 mb-4">
                <h5 class="mb-3 text-info border-bottom pb-2">Cliente e Veículo</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Cliente:</strong> {{ $venda->cliente->nome ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>Veículo:</strong> {{ $venda->veiculo->placa ?? 'Nenhum veículo associado' }}</li>
                </ul>
            </div>
            <div class="col-md-6 mb-4">
                <h5 class="mb-3 text-info border-bottom pb-2">Informações da Venda</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Data:</strong> {{ $venda->created_at->format('d/m/Y H:i') }}</li>
                    <li class="list-group-item">
                        <strong>Status:</strong> 
                        <span class="badge bg-{{ $venda->status == 'Finalizada' ? 'success' : 'warning' }}">
                            {{ $venda->status }}
                        </span>
                    </li>
                    <li class="list-group-item"><strong>Forma de Pagamento:</strong> {{ $venda->forma_pagamento ?? 'Aguardando definição' }}</li>
                </ul>
            </div>
        </div>

        <div class="p-3 mb-4 border rounded">
            <h5 class="text-info mb-3">Itens Adicionados</h5>
            
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>Item</th>
                            <th>Qtd.</th>
                            <th>Unit.</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Deve iterar sobre os itens do relacionamento 'itens' da Venda --}}
                        @if ($venda->itens && $venda->itens->count() > 0)
                            @foreach ($venda->itens as $item)
                                <tr>
                                    <td>{{ $item->produto->nome ?? 'Item/Serviço Não Encontrado' }}</td>
                                    <td>{{ $item->quantidade }}</td>
                                    <td>R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                                    <td>R$ {{ number_format($item->quantidade * $item->preco_unitario, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="4" class="text-center text-muted">Nenhum item registrado para esta venda.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="p-3 mb-4 border rounded bg-light">
            <h5 class="text-info mb-3">Totais e Observações</h5>
            <div class="row">
                <div class="col-md-4">
                    <p class="mb-1">Subtotal (Itens): <strong>R$ {{ number_format($venda->subtotal, 2, ',', '.') }}</strong></p>
                    <p class="mb-1">Descontos: <strong class="text-danger">R$ {{ number_format($venda->desconto, 2, ',', '.') }}</strong></p>
                </div>
                <div class="col-md-4">
                    <h4 class="mt-2 text-primary">Total Final: <strong class="text-success">R$ {{ number_format($venda->total_final, 2, ',', '.') }}</strong></h4>
                </div>
            </div>

            <div class="form-group mt-3">
                <label class="form-label">Observações</label>
                <div class="card card-body bg-white small">
                    {{ $venda->observacoes ?? 'Nenhuma observação registrada.' }}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection