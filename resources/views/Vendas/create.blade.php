@extends('layouts.app')

@section('title', 'Nova Venda / Orçamento')
@section('header', 'Nova Venda / Orçamento')

@section('content')
<div class="container mt-4">
    <div class="card p-4 shadow-lg">

        <h2 class="text-primary mb-4">Nova Venda / Orçamento</h2>
        
        <a href="{{ route('vendas.index') }}" class="btn btn-sm btn-outline-primary mb-3" title="Voltar para a Lista">
            <i class="bi bi-arrow-left-circle-fill"></i> Voltar para a Lista
        </a>

        <form action="{{ route('vendas.store') }}" method="POST">
            @csrf

            <div class="p-3 mb-4 border rounded bg-light">
                <h5 class="text-info mb-3">Detalhes do Cliente e Veículo</h5>
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label for="cliente_id" class="form-label">Cliente (*)</label>
                        <select name="cliente_id" id="cliente_id" class="form-control" required>
                            <option value="">Selecione um Cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label for="veiculo_id" class="form-label">Veículo</label>
                        <select name="veiculo_id" id="veiculo_id" class="form-control">
                            <option value="">Selecione um Veículo (Se aplicável)</option>
                            {{-- Opções serão carregadas via JS/AJAX --}}
                        </select>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="data_venda" class="form-label">Data (*)</label>
                        <input type="date" name="data_venda" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="status" class="form-label">Status (*)</label>
                        <select name="status" class="form-control" required>
                            <option value="Orcamento">Orçamento</option>
                            <option value="Aberta">Aberta</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="p-3 mb-4 border rounded">
                <h5 class="text-info mb-3">Itens da Venda (Produtos e Serviços)</h5>
                
                <div id="item-input-area" class="d-flex mb-3">
                    <select id="produto_search" class="form-control me-2" style="width: 50%;">
                         <option value="">Buscar/Selecionar Produto/Serviço...</option>
                         @foreach ($produtos as $produto)
                             <option value="{{ $produto->id }}" data-preco="{{ $produto->preco_venda }}">{{ $produto->nome }}</option>
                         @endforeach
                    </select>
                    <input type="number" id="item_qty" placeholder="Qtd" class="form-control me-2" style="width: 80px;" value="1" min="1">
                    <button type="button" id="add_item_btn" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i> Add</button>
                </div>

                <div id="item-list-table">
                    <table class="table table-striped table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>Item</th>
                                <th>Qtd.</th>
                                <th>Unit.</th>
                                <th>Subtotal</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody id="venda_items_body">
                            <tr><td colspan="5" class="text-center text-muted">Nenhum item adicionado.</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="p-3 mb-4 border rounded bg-light">
                <h5 class="text-info mb-3">Totais e Pagamento</h5>
                <div class="row">
                    <div class="col-md-4">
                        <p class="mb-1">Subtotal: <strong id="subtotal_display">R$ 0,00</strong></p>
                        <p class="mb-1">Descontos: <input type="number" name="desconto" id="desconto_input" step="0.01" class="form-control form-control-sm d-inline w-50" value="0.00" min="0"></p>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="forma_pagamento" class="form-label">Pagamento (*)</label>
                        <select name="forma_pagamento" id="forma_pagamento" class="form-control" required>
                            <option value="Dinheiro">Dinheiro</option>
                            <option value="Cartao">Cartão</option>
                            <option value="Boleto">Boleto</option>
                        </select>
                    </div>
                    <div class="col-md-4 text-end">
                        <h4 class="mt-2">Total: <strong class="text-success" id="total-final-display">R$ 0,00</strong></h4>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label for="observacoes" class="form-label">Observações</label>
                    <textarea name="observacoes" id="observacoes" class="form-control" rows="2">{{ old('observacoes') }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-lg btn-success w-100">
                <i class="bi bi-cash-coin"></i> Finalizar Venda
            </button>
        </form>

    </div>
</div>
@endsection