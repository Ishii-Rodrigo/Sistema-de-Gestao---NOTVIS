@extends('layouts.app')

@section('title', 'Detalhes da Venda ID: ' . $venda->id)
@section('header', 'Detalhes da Venda')

@section('content')
<div class="container mt-4">
    <div class="card p-4 shadow-lg">

        <h2 class="text-primary mb-4">Venda/Orçamento #{{ $venda->id }}</h2>

        {{-- Botões de Ação (Linha 20, onde estava o erro) --}}
        <div class="mb-4 d-flex justify-content-between">
            <a href="{{ route('vendas.index') }}" class="btn btn-sm btn-outline-primary" title="Voltar para a Lista">
                <i class="bi bi-arrow-left-circle-fill"></i> Voltar para a Lista
            </a>
            
            <div class="d-flex">
                {{-- Botão Imprimir que AGORA aponta corretamente para a rota 'vendas.print' --}}
                <a href="{{ route('vendas.print', $venda->id) }}" target="_blank" class="btn btn-sm btn-info text-white me-2" title="Imprimir/PDF">
                    <i class="bi bi-printer-fill"></i> Imprimir
                </a>
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
        
        {{-- Dados da Venda --}}
        <div class="p-3 mb-4 border rounded bg-light">
            <h5 class="text-info mb-3">Informações da Venda</h5>
            <div class="row">
                <div class="col-md-4"><p class="mb-1"><strong>Nº da Venda:</strong> {{ $venda->id }}</p></div>
                <div class="col-md-4"><p class="mb-1"><strong>Data:</strong> {{ $venda->data_venda->format('d/m/Y') }}</p></div>
                <div class="col-md-4"><p class="mb-1"><strong>Status:</strong> <span class="badge bg-{{ $venda->status == 'Finalizada' ? 'success' : 'warning' }}">{{ $venda->status }}</span></p></div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12"><p class="mb-1"><strong>Condição de Pagamento:</strong> {{ $venda->forma_pagamento }}</p></div>
            </div>
        </div>

        {{-- Dados do Cliente --}}
        <div class="p-3 mb-4 border rounded">
            <h5 class="text-info mb-3">Dados do Cliente</h5>
            @php
                $cliente = $venda->cliente;
            @endphp
            <div class="row">
                <div class="col-md-6"><p class="mb-1"><strong>Nome:</strong> {{ $cliente->nome ?? 'N/A' }}</p></div>
                <div class="col-md-6"><p class="mb-1"><strong>CPF/CNPJ:</strong> {{ $cliente->cpf_cnpj ?? '-' }}</p></div>
                <div class="col-md-12"><p class="mb-1"><strong>Endereço:</strong> {{ $cliente->endereco ?? '-' }}</p></div>
                <div class="col-md-6"><p class="mb-1"><strong>Telefone:</strong> {{ $cliente->telefone ?? '-' }}</p></div>
                <div class="col-md-6"><p class="mb-1"><strong>E-mail:</strong> {{ $cliente->email ?? '-' }}</p></div>
            </div>
            @if($venda->veiculo)
            <div class="row mt-3 border-top pt-2">
                <div class="col-md-12"><p class="mb-1"><strong>Veículo Associado:</strong> {{ $venda->veiculo->modelo ?? 'N/A' }} (Placa: {{ $venda->veiculo->placa ?? '-' }})</p></div>
            </div>
            @endif
        </div>
        
        {{-- Lista de Itens/Serviços --}}
        <div class="p-3 mb-4 border rounded bg-light">
            <h5 class="text-info mb-3">Itens/Serviços Vendidos</h5>
            <div class="table-responsive">
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>Produto/Serviço</th>
                            <th class="text-end" style="width: 15%">Qtd.</th>
                            <th class="text-end" style="width: 25%">Vlr. Unitário</th>
                            <th class="text-end" style="width: 25%">Total do Item</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($venda->itens->count() > 0)
                            @foreach ($venda->itens as $item)
                                <tr>
                                    <td>{{ $item->produto->nome ?? 'Produto Removido' }}</td>
                                    <td class="text-end">{{ number_format($item->quantidade, 2, ',', '.') }}</td>
                                    <td class="text-end">R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                                    <td class="text-end">R$ {{ number_format($item->total_item, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="4" class="text-center text-muted">Nenhum item registrado.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Totais e Observações --}}
        <div class="p-3 mb-4 border rounded">
            <h5 class="text-info mb-3">Resumo Financeiro</h5>
            <div class="row justify-content-end">
                <div class="col-md-6 col-lg-4">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td class="text-end">Subtotal:</td>
                            <td class="text-end">R$ {{ number_format($venda->subtotal, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-end text-danger">Desconto:</td>
                            <td class="text-end text-danger">- R$ {{ number_format($venda->desconto, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-end"><strong>Total Final:</strong></td>
                            <td class="text-end text-success fs-5"><strong>R$ {{ number_format($venda->total_final, 2, ',', '.') }}</strong></td>
                        </tr>
                    </table>
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