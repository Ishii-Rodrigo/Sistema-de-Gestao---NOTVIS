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

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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
                        @error('cliente_id')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    {{-- NOVO CAMPO: SELEÇÃO DE VEÍCULO (PREENCHIMENTO DINÂMICO) --}}
                    <div class="col-md-6 form-group mb-3">
                        <label for="veiculo_id" class="form-label">Veículo (Opcional)</label>
                        <select name="veiculo_id" id="veiculo_id" class="form-control">
                            <option value="">Selecione um Cliente primeiro</option>
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
                               value="{{ old('data_venda', date('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-4 form-group mb-3">
                        <label for="status" class="form-label">Status (*)</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="Orcamento" {{ old('status') == 'Orcamento' ? 'selected' : '' }}>Orçamento</option>
                            <option value="Finalizada" {{ old('status') == 'Finalizada' ? 'selected' : '' }}>Finalizada</option>
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
                            {{-- Linhas de itens serão adicionadas aqui pelo JS ou pelo old() --}}
                            @php $item_index = 0; @endphp
                            @if (old('itens'))
                                @foreach (old('itens') as $item)
                                    @include('vendas.partials.item_row', ['produtos' => $produtos, 'item' => $item, 'index' => $item_index++])
                                @endforeach
                            @else
                                {{-- Linha inicial vazia --}}
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
            
            <input type="hidden" name="subtotal" id="subtotal_input" value="{{ old('subtotal', '0.00') }}">
            <input type="hidden" name="total_final" id="total_final_input" value="{{ old('total_final', '0.00') }}">

            <div class="p-3 mb-4 border rounded bg-light">
                <h5 class="text-info mb-3">Totais e Pagamento</h5>
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <p class="mb-1">Subtotal (Itens): <strong id="subtotal-display">R$ 0,00</strong></p>
                        <p class="mb-1">Descontos: <input type="number" name="desconto" id="desconto_input" step="0.01" class="form-control form-control-sm d-inline w-50" value="{{ old('desconto', '0.00') }}" min="0"></p>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="forma_pagamento" class="form-label">Pagamento (*)</label>
                        <select name="forma_pagamento" id="forma_pagamento" class="form-control" required>
                            <option value="Dinheiro" {{ old('forma_pagamento') == 'Dinheiro' ? 'selected' : '' }}>Dinheiro</option>
                            <option value="Cartao" {{ old('forma_pagamento') == 'Cartao' ? 'selected' : '' }}>Cartão</option>
                            <option value="Boleto" {{ old('forma_pagamento') == 'Boleto' ? 'selected' : '' }}>Boleto</option>
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
                <i class="bi bi-cash-coin"></i> Finalizar Venda / Criar Orçamento
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
        // O '__cliente_id__' é um placeholder que será substituído no JS
        const apiUrlTemplate = "{{ route('api.veiculos.cliente', ['clienteId' => '__cliente_id__']) }}";

        function carregarVeiculosDoCliente(clienteId, selectedVeiculoId = null) {
            // Inicia o campo de veículo
            veiculoSelect.innerHTML = '<option value="">Carregando...</option>';
            
            if (!clienteId) {
                veiculoSelect.innerHTML = '<option value="">Selecione um Cliente primeiro</option>';
                return;
            }

            // Constrói a URL final substituindo o placeholder
            const fetchUrl = apiUrlTemplate.replace('__cliente_id__', clienteId);
            
            fetch(fetchUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao carregar veículos: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(veiculos => {
                    // Limpa e adiciona a opção padrão
                    veiculoSelect.innerHTML = '<option value="">Selecione um Veículo (Opcional)</option>';

                    if (veiculos.length > 0) {
                        veiculos.forEach(veiculo => {
                            const option = document.createElement('option');
                            option.value = veiculo.id;
                            option.textContent = `${veiculo.placa} - ${veiculo.modelo || 'Sem Modelo'}`; 
                            
                            // Mantém a seleção se a página estiver sendo recarregada após erro de validação (old())
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
            // Ao mudar o cliente, limpa qualquer seleção anterior e carrega os novos veículos
            carregarVeiculosDoCliente(this.value);
        });
        
        // Inicialização: Carrega veículos se já houver um cliente selecionado ao carregar a página (old('cliente_id'))
        const initialClienteId = clienteSelect.value;
        const oldVeiculoId = "{{ old('veiculo_id') }}"; // Pega o valor anterior (após erro de validação)
        if (initialClienteId) {
             carregarVeiculosDoCliente(initialClienteId, oldVeiculoId);
        }

        // ... (Seu código JavaScript de cálculo de itens e totais deve vir aqui) ...
        // Este código foi omitido para focar na correção do Veículo.
    });
</script>
@endsection