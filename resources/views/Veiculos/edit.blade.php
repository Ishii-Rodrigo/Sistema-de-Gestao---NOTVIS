@extends('layouts.app')

@section('title', 'Editar Venda ID: ' . $venda->id)
@section('header', 'Editar Venda')

@section('content')
<div class="container mt-4">
    <div class="card p-4 shadow-lg">

        <h2 class="text-primary mb-4">Editar Venda/Orçamento #{{ $venda->id }}</h2>
        
        <a href="{{ route('vendas.show', $venda->id) }}" class="btn btn-sm btn-outline-primary mb-3" title="Voltar para Detalhes">
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

        <form action="{{ route('vendas.update', $venda->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="p-3 mb-4 border rounded bg-light">
                <h5 class="text-info mb-3">Detalhes do Cliente e Veículo</h5>
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label for="cliente_id" class="form-label">Cliente (*)</label>
                        <select name="cliente_id" id="cliente_id" class="form-control" required>
                            <option value="">Selecione um Cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('cliente_id', $venda->cliente_id) == $cliente->id ? 'selected' : '' }}>
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
                        <input type="date" name="data_venda" class="form-control" value="{{ old('data_venda', $venda->created_at->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="status" class="form-label">Status (*)</label>
                        <select name="status" class="form-control" required>
                            <option value="Orcamento" {{ old('status', $venda->status) == 'Orcamento' ? 'selected' : '' }}>Orçamento</option>
                            <option value="Aberta" {{ old('status', $venda->status) == 'Aberta' ? 'selected' : '' }}>Aberta</option>
                            <option value="Finalizada" {{ old('status', $venda->status) == 'Finalizada' ? 'selected' : '' }}>Finalizada</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="p-3 mb-4 border rounded">
                <h5 class="text-info mb-3">Itens da Venda (Produtos e Serviços)</h5>
          
                <div id="item-input-area" class="d-flex mb-3">...</div> 
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
                             @if ($venda->itens && $venda->itens->count() > 0)
                                @foreach ($venda->itens as $index => $item)
                                    {{-- **IMPORTANTE:** Os inputs ocultos são necessários para enviar os dados dos itens no POST/PUT --}}
                                    <tr data-item-id="{{ $item->id }}">
                                        <td>{{ $item->produto->nome ?? 'Item/Serviço' }}
                                            <input type="hidden" name="itens[{{ $index }}][item_id]" value="{{ $item->id }}">
                                            <input type="hidden" name="itens[{{ $index }}][produto_id]" value="{{ $item->produto_id }}">
                                        </td>
                                        <td>
                                            <input type="number" name="itens[{{ $index }}][quantidade]" value="{{ $item->quantidade }}" class="form-control form-control-sm item-qty-input">
                                        </td>
                                        <td>R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}
                                            <input type="hidden" name="itens[{{ $index }}][preco_unitario]" value="{{ $item->preco_unitario }}" class="item-unit-price-input">
                                        </td>
                                        <td class="item-subtotal-display">R$ {{ number_format($item->quantidade * $item->preco_unitario, 2, ',', '.') }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger remove-item-btn"><i class="bi bi-trash-fill"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="5" class="text-center text-muted">Nenhum item adicionado.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="p-3 mb-4 border rounded bg-light">
                <h5 class="text-info mb-3">Totais e Pagamento</h5>
                <div class="row">
                    <div class="col-md-4">
                        <p class="mb-1">Subtotal: <strong id="subtotal_display">R$ {{ number_format($venda->subtotal, 2, ',', '.') }}</strong></p>
                        <p class="mb-1">Descontos: <input type="number" name="desconto" id="desconto_input" step="0.01" class="form-control form-control-sm d-inline w-50" value="{{ old('desconto', $venda->desconto) }}" min="0"></p>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="forma_pagamento" class="form-label">Pagamento (*)</label>
                        <select name="forma_pagamento" id="forma_pagamento" class="form-control" required>
                            <option value="Dinheiro" {{ old('forma_pagamento', $venda->forma_pagamento) == 'Dinheiro' ? 'selected' : '' }}>Dinheiro</option>
                            <option value="Cartao" {{ old('forma_pagamento', $venda->forma_pagamento) == 'Cartao' ? 'selected' : '' }}>Cartão</option>
                            <option value="Boleto" {{ old('forma_pagamento', $venda->forma_pagamento) == 'Boleto' ? 'selected' : '' }}>Boleto</option>
                        </select>
                    </div>
                    <div class="col-md-4 text-end">
                        <h4 class="mt-2">Total: <strong class="text-success" id="total-final-display">R$ {{ number_format($venda->total_final, 2, ',', '.') }}</strong></h4>
                        <input type="hidden" name="total_final" id="total_final_input" value="{{ $venda->total_final }}">
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label for="observacoes" class="form-label">Observações</label>
                    <textarea name="observacoes" id="observacoes" class="form-control" rows="2">{{ old('observacoes', $venda->observacoes) }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-warning w-100">
                <i class="bi bi-check-circle-fill"></i> Salvar Alterações
            </button>
        </form>

    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const clienteSelect = document.getElementById('cliente_id');
        const veiculoSelect = document.getElementById('veiculo_id');
        
        // Valor do veículo previamente selecionado na venda (se existir)
        const oldVeiculoId = "{{ old('veiculo_id', $venda->veiculo_id) }}"; 

        // Função para carregar veículos via AJAX
        function carregarVeiculosDoCliente(clienteId, selectedVeiculoId = null) {
            veiculoSelect.innerHTML = '<option value="">Carregando...</option>';
            
            if (!clienteId) {
                veiculoSelect.innerHTML = '<option value="">Selecione um Veículo (Se aplicável)</option>';
                return;
            }

            // A URL usa a rota nomeada 'clientes.veiculos' criada no web.php
            const url = `{{ route('clientes.veiculos', ['cliente' => 'TEMP_ID']) }}`.replace('TEMP_ID', clienteId);

            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao buscar veículos');
                    }
                    return response.json();
                })
                .then(veiculos => {
                    veiculoSelect.innerHTML = '<option value="">Selecione um Veículo (Se aplicável)</option>';
                    if (veiculos.length > 0) {
                        veiculos.forEach(veiculo => {
                            const option = document.createElement('option');
                            option.value = veiculo.id;
                            // Assumindo que o Model Veiculo tem campos 'placa' e 'modelo'
                            option.textContent = `${veiculo.placa} - ${veiculo.modelo || 'Sem Modelo'}`;
                            
                            // Seleciona o veículo se ele for o antigo (venda existente ou old)
                            if (veiculo.id == selectedVeiculoId) {
                                option.selected = true;
                            }
                            
                            veiculoSelect.appendChild(option);
                        });
                    } else {
                        veiculoSelect.innerHTML = '<option value="">Nenhum veículo encontrado para este cliente</option>';
                    }
                })
                .catch(error => {
                    console.error("Erro no fetch:", error);
                    veiculoSelect.innerHTML = '<option value="">Erro ao carregar veículos</option>';
                });
        }

        // Listener para o evento de mudança do cliente
        clienteSelect.addEventListener('change', function() {
            // Ao mudar, carregamos os veículos sem pré-selecionar o oldVeiculoId
            carregarVeiculosDoCliente(this.value);
        });
        
        // Carrega veículos na primeira vez que a página é carregada, usando o ID do cliente e o Veículo ID da Venda
        const initialClienteId = clienteSelect.value;
        if (initialClienteId) {
             carregarVeiculosDoCliente(initialClienteId, oldVeiculoId);
        }
    });
</script>
@endsection