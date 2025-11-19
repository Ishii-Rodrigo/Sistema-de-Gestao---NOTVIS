@extends('layouts.print') 

@section('title', 'Venda #' . $venda->id)

@section('styles')
    <style>
        /* 1. CSS para Forçar Tamanho A5 e Otimizar Espaço */
        @page {
            /* Define o tamanho da página como A5 (148mm x 210mm) */
            size: A5; 
            /* Margens mínimas para aproveitar o espaço */
            margin: 5mm; 
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 9pt; /* Reduz o tamanho da fonte */
        }

        /* Títulos e Espaçamento */
        .container {
            width: 100%;
            padding: 0;
            margin: 0;
        }

        h4, h5, h6 {
            margin: 0.5em 0 0.2em 0;
            padding: 0;
        }

        /* Border e Padding das Seções */
        .header-section, .info-section, .items-section, .totals-section {
            border: 1px solid #ccc;
            margin-bottom: 5px;
            padding: 3px; /* Reduz o padding interno */
            page-break-inside: avoid; /* Evita que seções grandes sejam divididas */
        }
        
        .info-section table td {
             font-size: 8.5pt;
        }


        /* Detalhes da Tabela de Itens */
        .table-items {
            width: 100%;
            border-collapse: collapse;
        }
        .table-items th, .table-items td {
            border: 1px solid #ddd;
            padding: 2px 4px; /* Padding mínimo */
            font-size: 8pt; /* Fonte ainda menor para os itens */
        }
        .table-items th {
            text-align: left;
            background-color: #f0f0f0;
        }

        /* Coluna de Totais */
        .totals-section {
            overflow: hidden; /* Garante que o float seja contido */
        }
        .totals-table {
            float: right;
            width: 45%; /* Aumenta um pouco para caber no A5 */
            margin-top: 5px;
        }
        .totals-table td {
            padding: 2px 0;
            font-size: 9pt;
        }
        
        /* Observações */
        .observacoes-content {
            font-size: 7.5pt; 
            min-height: 15mm; /* Garante um espaço mínimo */
        }
        
        /* Limpa o float para o container principal */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

    </style>
@endsection

@section('content')
    <div class="container">
        
        <div class="header-section">
            <h4 style="text-align: center; margin: 0;">{{ $empresa['nome'] }}</h4>
            <div style="text-align: center; font-size: 7pt;">
                CNPJ: {{ $empresa['cnpj'] }} | {{ $empresa['endereco'] }} | Tel: {{ $empresa['telefone'] }}
            </div>
            <h5 style="text-align: center; margin-top: 3px;">
                NOTA DE VENDA / ORÇAMENTO #{{ $venda->id }}
            </h5>
        </div>

        <div class="info-section">
            <h6 style="border-bottom: 1px solid #eee;">Dados da Venda/Cliente</h6>
            <table style="width: 100%;">
                <tr>
                    <td style="width: 50%;">
                        **Cliente:** {{ $venda->cliente->nome ?? 'N/A' }} <br>
                        **CPF/CNPJ:** {{ $venda->cliente->cpf_cnpj ?? '-' }} <br>
                        **Veículo:** {{ $venda->veiculo->modelo ?? 'N/A' }} (Placa: {{ $venda->veiculo->placa ?? '-' }})
                    </td>
                    <td style="width: 50%;">
                        **Data:** {{ $venda->data_venda->format('d/m/Y') }} <br>
                        **Status:** {{ $venda->status }} <br>
                        **Forma Pagamento:** {{ $venda->forma_pagamento }}
                    </td>
                </tr>
            </table>
        </div>

        <div class="items-section">
            <h6 style="border-bottom: 1px solid #eee;">Itens / Serviços</h6>
            <table class="table-items">
                <thead>
                    <tr>
                        <th style="width: 50%;">Produto/Serviço</th>
                        <th style="width: 15%; text-align: center;">Qtd.</th>
                        <th style="width: 15%; text-align: right;">Vlr. Unitário</th>
                        <th style="width: 20%; text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($venda->itens as $item)
                        <tr>
                            <td>{{ $item->produto->nome ?? 'Produto Removido' }}</td>
                            <td style="text-align: center;">{{ number_format($item->quantidade, 2, ',', '.') }}</td>
                            <td style="text-align: right;">R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                            <td style="text-align: right;">R$ {{ number_format($item->total_item, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    {{-- ADICIONA LINHAS VAZIAS SE HOUVER POUCOS ITENS PARA PREENCHER O ESPAÇO --}}
                    @for ($i = $venda->itens->count(); $i < 4; $i++)
                        <tr><td colspan="4" style="padding: 4px 4px; color: #ddd;">&nbsp;</td></tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <div class="totals-section clearfix">
            
            {{-- Tabela de Totais (Flutuando à direita) --}}
            <table class="totals-table">
                <tr>
                    <td>Subtotal (Itens):</td>
                    <td style="text-align: right;">R$ {{ number_format($venda->subtotal, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Desconto:</td>
                    <td style="text-align: right; color: red;">- R$ {{ number_format($venda->desconto, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>**TOTAL FINAL:**</td>
                    <td style="text-align: right; font-size: 10pt; font-weight: bold;">R$ {{ number_format($venda->total_final, 2, ',', '.') }}</td>
                </tr>
            </table>
            
            {{-- Observações (Ocupando o espaço restante) --}}
            <div style="margin-right: 50%; padding-top: 5px;">
                <h6 style="border-bottom: 1px solid #eee;">Observações</h6>
                <div class="observacoes-content">
                    {{ $venda->observacoes ?? 'Nenhuma observação registrada.' }}
                </div>
            </div>

            <div style="clear: both;"></div>
        </div>

        <div style="margin-top: 10px; text-align: center; font-size: 7pt;">
            <p>_________________________ &nbsp; &nbsp; &nbsp; _________________________</p>
            <p>Assinatura do Cliente &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Assinatura da Empresa</p>
        </div>
    </div>
@endsection