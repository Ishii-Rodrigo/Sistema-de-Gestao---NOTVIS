<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Relatório - {{ strtoupper($relatorio) }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .periodo {
            text-align: center;
            margin-bottom: 20px;
            font-size: 11pt;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-size: 10pt;
        }
        /* Estilos específicos para o relatório de Faturamento e Resumo */
        .resumo {
            margin-top: 20px;
            padding: 15px;
            background-color: #e9ecef;
            border-radius: 5px;
        }
        .resumo p {
            font-size: 12pt;
            font-weight: bold;
        }
    </style>
</head>
<body>
    
    <h1>Relatório: {{ strtoupper($relatorio) }}</h1>

    <div class="periodo">
        Período: {{ date('d/m/Y', strtotime($data_inicio)) }} a {{ date('d/m/Y', strtotime($data_fim)) }}
    </div>

    {{-- 1. Tratamento para Relatório de Faturamento --}}
    @if ($relatorio == 'faturamento' && $resultados)
        <div class="resumo">
            <p>Total de Vendas: {{ $resultados->total_vendas }}</p>
            <p>Receita Bruta: R$ {{ number_format($resultados->receita_bruta, 2, ',', '.') }}</p>
        </div>
    @endif
    
    {{-- 2. Tratamento para Relatório de Produtos Mais Vendidos --}}
    @if ($relatorio == 'produtos-vendidos' && $resultados && $resultados->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Estoque Atual</th>
                    <th>Unidade</th>
                    <th>Qtde. Vendida</th>
                    <th>Faturamento</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resultados as $item)
                <tr>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->estoque_atual }}</td>
                    <td>{{ $item->unidade_medida }}</td>
                    <td>{{ $item->quantidade_vendida }}</td>
                    <td>R$ {{ number_format($item->faturamento_item, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- 3. NOVO BLOCO CORRIGIDO: Tratamento para Margem de Lucro --}}
    {{-- O controller retorna um objeto de resumo para este relatório. --}}
    @if ($relatorio == 'margem-lucro' && $resultados)
        <div class="resumo">
            <h2>Resumo da Margem de Lucro</h2>
            <p>Faturamento Total: R$ {{ number_format($resultados->total_faturamento, 2, ',', '.') }}</p>
            <p>Custo Total: R$ {{ number_format($resultados->total_custo, 2, ',', '.') }}</p>
            <p>Margem Bruta: R$ {{ number_format($resultados->margem_bruta, 2, ',', '.') }}</p>
            <p>Percentual de Margem: {{ number_format($resultados->porcentagem_margem, 2, ',', '.') }}%</p>
        </div>
    @endif

</body>
</html>