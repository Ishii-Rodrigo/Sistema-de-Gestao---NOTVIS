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

            {{-- DETALHES DO CLIENTE E VEÍCULO --}}
            <div class="p-3 mb-4 border rounded bg-light">
                <h5 class="text-info mb-3">Detalhes do Cliente e Veículo</h5>
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label for="cliente_id" class="form-label">Cliente (*)</label>
                        <select name="cliente_id" id="cliente_id" class="form-select" required>
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
                        <select name="veiculo_id" id="veiculo_id" class="form-select">
                            <option value="">Selecione o Veículo (Será carregado após selecionar o cliente)</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- ADICIONAR ITEM (Novo Bloco) --}}
            <div class="p-3 mb-4 border rounded bg-light">
                <h5 class="text-info mb-3">Itens da Venda / Serviço</h5>
                
                <div class="row align-items-end mb-3">
                    <div class="col-md-6 form-group">
                        <label for="produto_select" class="form-label">Produto/Serviço (*)</label>
                        <select id="produto_select" class="form-select">
                            <option value="" data-nome="" data-preco="0.00">Selecione o Item</option>
                            @foreach ($produtos as $produto)
                                <option 
                                    value="{{ $produto->id }}" 
                                    data-nome="{{ $produto->nome }}" 
                                    data-preco="{{ number_format($produto->preco_venda, 2, '.', '') }}"
                                >
                                    {{ $produto->nome }} (R$ {{ number_format($produto->preco_venda, 2, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="quantidade_input" class="form-label">Quantidade (*)</label>
                        <input type="number" id="quantidade_input" class="form-control" value="1" min="0.01" step="0.01">
                    </div>

                    {{-- REMOÇÃO DO CAMPO V. UNITÁRIO --}}
                    <div class="col-md-3 form-group">
                        <button type="button" id="adicionar_item_btn" class="btn btn-success w-100" title="Adicionar Item">
                            <i class="bi bi-plus-circle-fill"></i> Adicionar
                        </button>
                    </div>
                </div>

                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-striped table-sm">
                        <thead class="table-dark">
                            <tr>
                                <th>Produto/Serviço</th>
                                <th style="width: 15%;">Qtd</th>
                                <th style="width: 20%;">V. Unitário</th>
                                <th style="width: 20%;">Total Item</th>
                                <th style="width: 5%;">Ações</th>
                            </tr>
                        </thead>
                        <tbody id="itens-lista">
                            {{-- Itens serão inseridos aqui (via JS) --}}
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- TOTAIS E PAGAMENTO --}}
            <div class="p-3 mb-4 border rounded bg-light">
                <h5 class="text-info mb-3">Totais e Pagamento</h5>
                <div class="row">
                    
                    <div class="col-md-3 form-group mb-3">
                        <label for="subtotal" class="form-label">Subtotal dos Itens</label>
                        <input type="text" id="subtotal_display" class="form-control" value="R$ 0,00" readonly>
                        <input type="hidden" name="subtotal" id="subtotal_input" value="0.00">
                    </div>
                    
                    <div class="col-md-3 form-group mb-3">
                        <label for="desconto" class="form-label">Desconto (R$)</label>
                        <input type="number" name="desconto" id="desconto_input" class="form-control" value="{{ old('desconto', 0.00) }}" min="0.00" step="0.01">
                    </div>
                    
                    <div class="col-md-3 form-group mb-3">
                        <label for="total_final_display" class="form-label">Total Final</label>
                        <input type="text" id="total_final_display" class="form-control fw-bold text-success" value="R$ 0,00" readonly>
                        <input type="hidden" name="total_final" id="total_final_input" value="0.00">
                    </div>

                    <div class="col-md-3 form-group mb-3">
                        <label for="forma_pagamento" class="form-label">Forma de Pagamento (*)</label>
                        <select name="forma_pagamento" id="forma_pagamento" class="form-select" required>
                            <option value="">Selecione</option>
                            @foreach (['A Vista', 'Cartão de Crédito', 'Cartão de Débito', 'Transferência', 'Boleto'] as $fp)
                                <option value="{{ $fp }}" {{ old('forma_pagamento') == $fp ? 'selected' : '' }}>{{ $fp }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 form-group mb-3">
                        <label for="observacoes" class="form-label">Observações</label>
                        <textarea name="observacoes" id="observacoes" class="form-control" rows="3">{{ old('observacoes') }}</textarea>
                    </div>

                    <div class="col-md-4 form-group mb-3">
                        <label for="data_venda" class="form-label">Data (*)</label>
                        <input type="date" name="data_venda" id="data_venda" class="form-control" value="{{ old('data_venda', date('Y-m-d')) }}" required>
                    </div>

                    <div class="col-md-4 form-group mb-3">
                        <label for="status" class="form-label">Status (*)</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="Orcamento" {{ old('status') == 'Orcamento' ? 'selected' : '' }}>Orçamento</option>
                            <option value="Finalizada" {{ old('status') == 'Finalizada' ? 'selected' : '' }}>Finalizada</option>
                            <option value="Cancelada" {{ old('status') == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                        </select>
                    </div>

                </div>
            </div>

            <button type="submit" class="btn btn-success mt-3" id="salvar_venda_btn">
                <i class="bi bi-save-fill"></i> Salvar Venda/Orçamento
            </button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // ====================================================================
        // 1. LÓGICA DE CARREGAMENTO DE VEÍCULOS POR CLIENTE
        // (Mantida, pois é necessária para o funcionamento do formulário)
        // ====================================================================

        const clienteSelect = document.getElementById('cliente_id');
        const veiculoSelect = document.getElementById('veiculo_id');
        const oldVeiculoId = "{{ old('veiculo_id', '') }}"; 
        const veiculoApiUrl = "{{ route('api.veiculos.cliente', ['clienteId' => '__clienteId__']) }}";

        function carregarVeiculosDoCliente(clienteId, selectedVeiculoId = null) {
            veiculoSelect.innerHTML = '<option value="">Carregando...</option>';
            if (!clienteId) {
                veiculoSelect.innerHTML = '<option value="">Selecione um Cliente</option>';
                return;
            }

            const url = veiculoApiUrl.replace('__clienteId__', clienteId);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    veiculoSelect.innerHTML = '<option value="">Selecione o Veículo (Opcional)</option>';
                    if (data.length > 0) {
                        data.forEach(veiculo => {
                            const option = document.createElement('option');
                            option.value = veiculo.id;
                            option.textContent = veiculo.placa + ' (' + veiculo.modelo + ')';
                            
                            const idToSelect = selectedVeiculoId || oldVeiculoId;
                            if (veiculo.id == idToSelect) {
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

        clienteSelect.addEventListener('change', function() {
            carregarVeiculosDoCliente(this.value);
        });
        
        const initialClienteId = clienteSelect.value;
        if (initialClienteId) {
             carregarVeiculosDoCliente(initialClienteId, oldVeiculoId);
        }


        // ====================================================================
        // 2. LÓGICA DE GERENCIAMENTO DE ITENS E CÁLCULO DE TOTAIS (CORRIGIDA)
        // ====================================================================
        
        const produtoSelect = document.getElementById('produto_select');
        const quantidadeInput = document.getElementById('quantidade_input');
        const adicionarItemBtn = document.getElementById('adicionar_item_btn');
        const itensLista = document.getElementById('itens-lista');
        const descontoInput = document.getElementById('desconto_input');
        const subtotalInput = document.getElementById('subtotal_input');
        const totalFinalInput = document.getElementById('total_final_input');
        const subtotalDisplay = document.getElementById('subtotal_display');
        const totalFinalDisplay = document.getElementById('total_final_display');
        
        let itemIndex = 0; 
        
        // Listener para o botão de adicionar item
        adicionarItemBtn.addEventListener('click', function() {
            const selectedOption = produtoSelect.options[produtoSelect.selectedIndex];
            const produtoId = selectedOption.value;
            const nomeProduto = selectedOption.dataset.nome;
            const precoUnitario = parseFloat(selectedOption.dataset.preco); // Preço unitário do BD
            let quantidade = parseFloat(quantidadeInput.value);

            // 1. Validação
            if (!produtoId || quantidade <= 0 || isNaN(precoUnitario) || precoUnitario <= 0) {
                alert('Por favor, selecione um produto e insira uma quantidade válida. Verifique o preço de venda do produto.');
                return;
            }

            // 2. Cálculo do Total do Item
            const totalItem = (quantidade * precoUnitario).toFixed(2);
            
            // 3. Criação da nova linha (usando Template String)
            const newRow = document.createElement('tr');
            newRow.classList.add('item-row');
            newRow.dataset.index = itemIndex;

            // Prepara a marcação HTML da linha
            newRow.innerHTML = `
                <td>
                    ${nomeProduto}
                    {{-- Inputs Hidden para submissão dos dados (Produto ID e Preço Unitário fixo) --}}
                    <input type="hidden" name="itens[${itemIndex}][produto_id]" value="${produtoId}">
                    <input type="hidden" name="itens[${itemIndex}][preco_unitario]" value="${precoUnitario.toFixed(2)}">
                </td>
                <td>
                    {{-- Apenas a Quantidade é editável --}}
                    <input type="number" name="itens[${itemIndex}][quantidade]" class="form-control form-control-sm item-quantidade" 
                        value="${quantidade.toFixed(2)}" step="0.01" min="0.01" data-index="${itemIndex}">
                </td>
                <td>
                    {{-- Valor Unitário fixo e não editável --}}
                    <span class="item-unitario-display" data-index="${itemIndex}">R$ ${formatCurrency(precoUnitario)}</span>
                </td>
                <td>
                    {{-- Total do Item exibido e campo hidden para o subtotal do item --}}
                    <span class="item-total-display" data-index="${itemIndex}">R$ ${formatCurrency(totalItem)}</span>
                    <input type="hidden" name="itens[${itemIndex}][total_item]" class="item-total-input" value="${totalItem}">
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-item-btn" data-index="${itemIndex}" title="Remover Item">
                        <i class="bi bi-x-circle-fill"></i>
                    </button>
                </td>
            `;

            itensLista.appendChild(newRow);
            itemIndex++;
            
            // 4. Recalcula os totais
            calcularTotais();

            // 5. Limpa os inputs de adição
            produtoSelect.value = '';
            quantidadeInput.value = '1';
        });

        /**
         * Função principal para calcular subtotal e total final.
         */
        function calcularTotais() {
            let subtotal = 0;
            let desconto = parseFloat(descontoInput.value) || 0;
            
            // 1. Itera sobre todos os itens na lista para somar o total_item
            document.querySelectorAll('.item-row').forEach(row => {
                const totalItemInput = row.querySelector('.item-total-input');
                
                if (totalItemInput) {
                    subtotal += parseFloat(totalItemInput.value);
                }
            });

            // 2. Calcula o Total Final
            let totalFinal = subtotal - desconto;
            if (totalFinal < 0) totalFinal = 0;

            // 3. Atualiza os inputs e displays
            subtotalInput.value = subtotal.toFixed(2);
            subtotalDisplay.value = `R$ ${formatCurrency(subtotal)}`;

            totalFinalInput.value = totalFinal.toFixed(2);
            totalFinalDisplay.value = `R$ ${formatCurrency(totalFinal)}`;
        }

        /**
         * Recalcula o total de uma linha específica após alteração na Quantidade.
         * @param {number} index - O índice do item na lista.
         */
        function recalcularLinha(index) {
            const row = document.querySelector(`.item-row[data-index="${index}"]`);
            if (!row) return;

            // Pega os inputs necessários
            const qtdInput = row.querySelector(`.item-quantidade[data-index="${index}"]`);
            const precoHiddenInput = row.querySelector(`input[name$="[preco_unitario]"]`);
            const totalDisplay = row.querySelector(`.item-total-display[data-index="${index}"]`);
            const totalInput = row.querySelector(`.item-total-input`);

            const quantidade = parseFloat(qtdInput.value) || 0;
            const precoUnitario = parseFloat(precoHiddenInput.value) || 0; // Valor unitário fixo (hidden)
            
            const totalItem = quantidade * precoUnitario;
            
            // Atualiza o display e o campo hidden do total do item
            totalDisplay.textContent = `R$ ${formatCurrency(totalItem.toFixed(2))}`;
            totalInput.value = totalItem.toFixed(2);

            // Recalcula os totais globais
            calcularTotais();
        }

        /**
         * Delega a manipulação de eventos (apenas Quantidade) e remoção.
         */
        itensLista.addEventListener('change', function(event) {
            const target = event.target;
            const index = target.dataset.index;

            // Altera apenas a quantidade (o campo item-preco-unitario não existe mais na interface)
            if (target.classList.contains('item-quantidade')) {
                recalcularLinha(index);
            }
        });

        itensLista.addEventListener('click', function(event) {
            const target = event.target.closest('.remove-item-btn');

            // Remove o item
            if (target) {
                const row = target.closest('.item-row');
                row.remove();
                calcularTotais(); // Recalcula o total após a remoção
            }
        });
        
        // Listener para Desconto: Recalcula tudo quando o desconto muda
        descontoInput.addEventListener('change', calcularTotais);
        descontoInput.addEventListener('keyup', calcularTotais);


        /**
         * Função auxiliar para formatar um número como moeda brasileira.
         */
        function formatCurrency(value) {
            const number = parseFloat(value);
            if (isNaN(number)) return '0,00';
            return number.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }
        
        // Inicializa o cálculo ao carregar a página
        calcularTotais();

    });
</script>
@endsection