@php
    // Usado para garantir que os valores de 'old()' sejam priorizados após falha de validação
    $produtoId = old("itens.{$index}.produto_id", data_get($item, 'produto_id'));
    $quantidade = old("itens.{$index}.quantidade", data_get($item, 'quantidade', 1.00));
    $precoUnitario = old("itens.{$index}.preco_unitario", data_get($item, 'preco_unitario', 0.00));
    // Se estiver em edição, use o total salvo. Caso contrário, calcule.
    $totalItem = old("itens.{$index}.total_item", data_get($item, 'total_item', $quantidade * $precoUnitario));
@endphp

{{-- A linha da tabela deve ter a classe 'item-row' e o 'data-index' para o JS --}}
<tr class="item-row" data-index="{{ $index }}">
    <td>
        {{-- Campo oculto para ID do item de venda existente (usado apenas em edição/update) --}}
        @if (data_get($item, 'id'))
            <input type="hidden" name="itens[{{ $index }}][id]" value="{{ data_get($item, 'id') }}">
        @endif
        
        <select name="itens[{{ $index }}][produto_id]" 
                class="form-select item-select" 
                data-index="{{ $index }}" 
                required>
            <option value="">Selecione um Produto/Serviço</option>
            @foreach ($produtos as $produto)
                <option value="{{ $produto->id }}" 
                        data-preco="{{ number_format($produto->preco_venda, 2, '.', '') }}" {{-- Preço formatado para o JS --}}
                        {{ $produto->id == $produtoId ? 'selected' : '' }}>
                    {{ $produto->nome }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <input type="number" 
               name="itens[{{ $index }}][quantidade]" 
               class="form-control item-quantidade text-end" 
               step="0.01" 
               min="0.01" 
               data-index="{{ $index }}" 
               value="{{ number_format($quantidade, 2, '.', '') }}" 
               required>
    </td>
    <td>
        <input type="number" 
               name="itens[{{ $index }}][preco_unitario]" 
               class="form-control item-preco-unitario text-end" 
               step="0.01" 
               min="0.01" 
               data-index="{{ $index }}" 
               value="{{ number_format($precoUnitario, 2, '.', '') }}" 
               required>
    </td>
    <td>
        <span class="item-total-display text-end" data-index="{{ $index }}">
            R$ {{ number_format($totalItem, 2, ',', '.') }}
        </span>
        <input type="hidden" 
               name="itens[{{ $index }}][total_item]" 
               class="item-total-input" 
               value="{{ number_format($totalItem, 2, '.', '') }}">
    </td>
    <td>
        {{-- Adiciona botão de remoção se for uma linha real ou não for a primeira (apenas em 'create') --}}
        @if ($index > 0 || (isset($item) && $item))
            <button type="button" class="btn btn-sm btn-outline-danger remove-item-btn" title="Remover Item">
                <i class="bi bi-x-circle-fill"></i>
            </button>
        @endif
    </td>
</tr>