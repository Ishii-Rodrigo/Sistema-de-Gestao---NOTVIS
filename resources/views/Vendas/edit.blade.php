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
                                {{-- Mantém o cliente da venda ou o old() --}}
                                <option value="{{ $cliente->id }}" {{ old('cliente_id', $venda->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('cliente_id')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    {{-- NOVO CAMPO: SELEÇÃO DE VEÍCULO (PREENCHIMENTO DINÂMICO) --}}
                    <div class="col-md-6 form-group mb-3">
                        <label for="veiculo_id" class="form-label">Veículo (Opcional)</label>
                        <select name="veiculo_id" id="veiculo_id" class="form-control">
                            {{-- A opção será preenchida e selecionada via JavaScript --}}
                            <option value="">Carregando veículos...</option> 
                        </select>
                        @error('veiculo_id')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="p-3 mb-4 border rounded bg-light">
                <h5 class="text-info mb-3">Dados da Venda</h5>
                <div class="row">
                    <div class="col-md-4 form-group mb-3">
                        <label for="data_venda" class="form-label">Data (*)</label>
                        <input type="date" name="data_venda" id="data_venda" class="form-control" 
                               value="{{ old('data_venda', date('Y-m-d', strtotime($venda->data_venda))) }}" required>
                    </div>
                    <div class="col-md-4 form-group mb-3">
                        <label for="status" class="form-label">Status (*)</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="Orcamento" {{ old('status', $venda->status) == 'Orcamento' ? 'selected' : '' }}>Orçamento</option>
                            <option value="Finalizada" {{ old('status', $venda->status) == 'Finalizada' ? 'selected' : '' }}>Finalizada</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- ----------------------------------------------------- --}}
            {{-- BLOCO DE ITENS (ESTRUTURA JAVASCRIPT) --}}
            {{-- ----------------------------------------------------- --}}

            <div class="p-3 mb-4 border rounded bg-light" id="itens-container">
                <h5 class="text-info mb-3">Itens / Serviços</h5>
                <div class="table-responsive">
                    <table class="table table-bordered" id="itens-table">
                        <thead>
                            <tr>
                                <th>Produto/Serviço (*)</th>
                                <th style="width: 15%">Qtd (*)</th>
                                <th style="width: 20%">Preço Unitário (*)</th>
                                <th style="width: 20%">Total</th>
                                <th style="width: 5%">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Carrega itens existentes da venda ou old() --}}
                            @php $item_index = 0; @endphp
                            @if (old('itens'))
                                @foreach (old('itens') as $item)
                                    @include('vendas.partials.item_row', ['produtos' => $produtos, 'item' => (object)$item, 'index' => $item_index++])
                                @endforeach
                            @else
                                @foreach ($venda->itens as $item)
                                    @include('vendas.partials.item_row', ['produtos' => $produtos, 'item' => $item, 'index' => $item_index++])
                                @endforeach
                            @endif
                            
                            {{-- Garante que haja pelo menos uma linha se a venda for nova e vazia --}}
                            @if ($item_index === 0)
                                @include('vendas.partials.item_row', ['produtos' => $produtos, 'item' => null, 'index' => 0])
                                @php $item_index = 1; @endphp
                            @endif

                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-sm btn-outline-success" id="add-item-btn">
                    <i class="bi bi-plus-circle"></i> Adicionar Item
                </button>
            </div>
            
            <input type="hidden" name="subtotal" id="subtotal_input" value="{{ old('subtotal', $venda->subtotal) }}">
            <input type="hidden" name="total_final" id="total_final_input" value="{{ old('total_final', $venda->total_final) }}">


            <div class="p-3 mb-4 border rounded bg-light">
                <h5 class="text-info mb-3">Totais e Pagamento</h5>
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <p class="mb-1">Subtotal (Itens): <strong id="subtotal-display">R$ {{ number_format($venda->subtotal, 2, ',', '.') }}</strong></p>
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

{{-- ------------------------------------------------------------------- --}}
{{-- NOVO BLOCO SCRIPT PARA CARREGAMENTO DINÂMICO DE VEÍCULOS --}}
{{-- ------------------------------------------------------------------- --}}
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const clienteSelect = document.getElementById('cliente_id');
        const veiculoSelect = document.getElementById('veiculo_id');

        // URL da API usando a rota nomeada do Laravel (é necessário ter a rota 'api.veiculos.cliente' configurada em web.php!)
        const apiUrlTemplate = "{{ route('api.veiculos.cliente', ['clienteId' => '__cliente_id__']) }}";

        // Variável com o ID do veículo a ser selecionado (se houver old, usa old; senão, usa o da venda)
        const oldVeiculoId = "{{ old('veiculo_id', $venda->veiculo_id ?? '') }}";

        function carregarVeiculosDoCliente(clienteId, selectedVeiculoId = null) {
            veiculoSelect.innerHTML = '<option value="">Carregando...</option>';
            
            if (!clienteId) {
                veiculoSelect.innerHTML = '<option value="">Selecione um Cliente primeiro</option>';
                return;
            }

            const fetchUrl = apiUrlTemplate.replace('__cliente_id__', clienteId);
            
            fetch(fetchUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao carregar veículos: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(veiculos => {
                    veiculoSelect.innerHTML = '<option value="">Selecione um Veículo (Opcional)</option>';

                    if (veiculos.length > 0) {
                        veiculos.forEach(veiculo => {
                            const option = document.createElement('option');
                            option.value = veiculo.id;
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
            // Ao mudar o cliente, carregamos os veículos sem pré-selecionar o oldVeiculoId
            carregarVeiculosDoCliente(this.value);
        });
        
        // Inicialização: Carrega veículos na primeira vez que a página é carregada, usando o ID do cliente e o Veículo ID da Venda
        const initialClienteId = clienteSelect.value;
        if (initialClienteId) {
             carregarVeiculosDoCliente(initialClienteId, oldVeiculoId);
        }

        // ... (Seu código JavaScript de cálculo de itens e totais deve vir aqui) ...
        // Este código foi omitido para focar na correção do Veículo.
    });
</script>
@endsection

