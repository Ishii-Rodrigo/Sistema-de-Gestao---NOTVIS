@extends('layouts.app')

@section('title', 'Histórico de Vendas/Orçamentos')
@section('header', 'Histórico de Vendas')

@section('content')
<div class="container mt-4">
    
    <h2 class="text-primary mb-3">Histórico de Vendas/Orçamentos</h2>

    <div class="d-flex justify-content-between align-items-center mb-4">
        
        <div class="d-flex align-items-center">
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary me-3" title="Voltar ao Menu Principal">
                <i class="bi bi-arrow-left-circle-fill"></i> Voltar
            </a>
            
            <form action="{{ route('vendas.index') }}" method="GET" class="d-flex me-3">
                <input type="text" 
                       name="search" 
                       class="form-control form-control-sm" 
                       placeholder="Buscar por ID ou Cliente..."
                       value="{{ $termo ?? '' }}"
                       style="width: 250px;">
                       
                <button type="submit" class="btn btn-sm btn-secondary ms-2" title="Pesquisar Vendas">
                    <i class="bi bi-search"></i> Pesquisar
                </button>
            </form>
        </div>
        
        <a href="{{ route('vendas.create') }}" class="btn btn-sm btn-success" title="Nova Venda/Orçamento">
            <i class="bi bi-plus-circle-fill"></i> Nova Venda/Orçamento
        </a>
    </div>

    @if($vendas->isEmpty())
        <div class="alert alert-info">Nenhuma venda ou orçamento encontrado.</div>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Cliente</th>
                        <th>Veículo (Placa)</th>
                        <th>Total Final</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vendas as $venda)
                        <tr>
                            <td>{{ $venda->id }}</td>
                            <td>{{ $venda->data_venda->format('d/m/Y') }}</td>
                            <td>{{ $venda->cliente->nome ?? 'N/A' }}</td>
                            <td>{{ $venda->veiculo->placa ?? '-' }}</td>
                            <td>R$ {{ number_format($venda->total_final, 2, ',', '.') }}</td>
                            <td><span class="badge bg-{{ $venda->status == 'Finalizada' ? 'success' : 'warning' }}">{{ $venda->status }}</span></td>
                            <td>
                                <a href="{{ route('vendas.show', $venda->id) }}" class="btn btn-sm btn-info text-white" title="Ver Detalhes">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-sm btn-warning" title="Editar Venda">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection