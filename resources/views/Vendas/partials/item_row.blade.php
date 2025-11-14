@php
    // Função auxiliar para obter valores. $item pode ser um objeto (BD) ou array (old)
    $produtoId = old("itens.{$index}.produto_id", data_get($item, 'produto_id'));
    $quantidade = old("itens.{$index}.quantidade", data_get($item, 'quantidade', 0));
    $precoUnitario = old("itens.{$index}.preco_unitario", data_get($item, 'preco_unitario', 0.00));
    $totalItem = $quantidade * $precoUnitario;
@endphp

{{-- A linha da tabela deve ter a classe 'item-row' e o 'data-index' para o JS --}}
<tr class="item-row" data-index="{{ $index }}">
    <td>
        <select name="itens[{{ $index }}][produto_id]" 
                class="form-control item-select" 
                data-index="{{ $index }}" 
                required>
            <option value="">Selecione um Produto/Serviço</option>
            @foreach ($produtos as $produto)
                <option value="{{ $produto->id }}" 
                        data-preco="{{ number_format($produto->preco_venda, 2, '.', '') }}" {{-- Passa o preço formatado para o JS --}}
                        {{ $produto->id == $produtoId ? 'selected' : '' }}>
                    {{ $produto->nome }}
                </option>
            @endforeach
        </select>
        {{-- Campo oculto para ID do item de venda existente (usado na edição) --}}
        <input type="hidden" name="itens[{{ $index }}][id]" value="{{ data_get($item, 'id') }}">
    </td>
    <td>
        <input type="number" 
               name="itens[{{ $index }}][quantidade]" 
               class="form-control item-quantidade" 
               step="0.01" 
               min="0.01" 
               data-index="{{ $index }}" 
               value="{{ number_format($quantidade, 2, '.', '') }}" 
               required>
    </td>
    <td>
        <input type="number" 
               name="itens[{{ $index }}][preco_unitario]" 
               class="form-control item-preco-unitario" 
               step="0.01" 
               min="0.01" 
               data-index="{{ $index }}" 
               value="{{ number_format($precoUnitario, 2, '.', '') }}" 
               required>
    </td>
    <td>
        <span class="item-total-display" data-index="{{ $index }}">
            R$ {{ number_format($totalItem, 2, ',', '.') }}
        </span>
        <input type="hidden" 
               name="itens[{{ $index }}][total_item]" 
               class="item-total-input" 
               value="{{ number_format($totalItem, 2, '.', '') }}">
    </td>
    <td>
        {{-- O botão de remoção não aparece na primeira linha (índice 0) --}}
        @if ($index > 0 || ($item && count($produtos) > 1)) {{-- Permite remover se for item real ou se tiver mais de uma linha --}}
        <button type="button" class="btn btn-sm btn-outline-danger remove-item-btn" title="Remover Item">
            <i class="bi bi-x-circle-fill"></i>
        </button>
        @endif
    </td>
</tr>

<script>
    // **NOTA:** Este script NÃO deve ser incluído aqui. 
    // O código JavaScript de cálculo deve estar APENAS nos arquivos create.blade.php e edit.blade.php.
    // O JS no final de create.blade.php deve ter toda a lógica de cálculo.
</script>