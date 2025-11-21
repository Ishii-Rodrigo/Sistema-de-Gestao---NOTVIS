@extends('layouts.app')

{{-- Define o título da página --}}
@section('title', 'Relatórios de Vendas') 

{{-- Define o cabeçalho principal --}}
@section('header', 'Relatórios')

@section('content')
<div class="container-fluid">
    <form action="{{ route('relatorios.index') }}" method="GET" id="form-relatorio">
        <div class="card mb-4 shadow">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-filter"></i> Filtros do Relatório
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tipo_relatorio">Selecione o Relatório</label>
                            <select name="tipo_relatorio" id="tipo_relatorio" class="form-control" onchange="document.getElementById('form-relatorio').submit();">
                                <option value="faturamento" {{ $relatorio == 'faturamento' ? 'selected' : '' }}>1. Faturamento por Período</option>
                                <option value="produtos-vendidos" {{ $relatorio == 'produtos-vendidos' ? 'selected' : '' }}>2. Produtos Mais Vendidos</option>
                                <option value="margem-lucro" {{ $relatorio == 'margem-lucro' ? 'selected' : '' }}>3. Margem de Lucro Bruta</option>
                            </select>
                        </div>
                    </div>
                 
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="periodo_rapido">Seleção Rápida</label>
                            <select name="periodo_rapido" id="periodo_rapido" class="form-control" onchange="document.getElementById('form-relatorio').submit();">
                                <option value="">Intervalo Personalizado</option>
                                <option value="hoje" {{ request('periodo_rapido') == 'hoje' ? 'selected' : '' }}>Hoje</option>
                                <option value="semana" {{ request('periodo_rapido') == 'semana' ? 'selected' : '' }}>Esta Semana</option>
                                <option value="mes" {{ request('periodo_rapido') == 'mes' ? 'selected' : '' }}>Este Mês</option>
                                <option value="ano" {{ request('periodo_rapido') == 'ano' ? 'selected' : '' }}>Este Ano</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="data_inicio">Data Inicial</label>
                            <input type="date" name="data_inicio" id="data_inicio" class="form-control" value="{{ Carbon\Carbon::parse($data_inicio)->toDateString() }}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="data_fim">Data Final</label>
                            <input type="date" name="data_fim" id="data_fim" class="form-control" value="{{ Carbon\Carbon::parse($data_fim)->toDateString() }}" required>
                        </div>
                    </div>

                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fas fa-search"></i> Gerar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
    @if ($resultados)
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Resultado para o período de {{ Carbon\Carbon::parse($data_inicio)->format('d/m/Y') }} a {{ Carbon\Carbon::parse($data_fim)->format('d/m/Y') }}</h4>
       
        <a href="{{ route('relatorios.exportPdf', request()->query()) }}" class="btn btn-danger">
            <i class="fas fa-file-pdf"></i> Imprimir (PDF)
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            
            @if(session('info'))
                <div class="alert alert-warning">{{ session('info') }}</div>
            @endif

            @if ($relatorio == 'faturamento' && $resultados)
                <h5>Faturamento por Período</h5>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Total de Vendas</th>
                            <th>Receita Bruta (Valor Total)</th>
                            <th>Ticket Médio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ number_format($resultados->total_vendas, 0, ',', '.') }}</td>
                            <td>R$ {{ number_format($resultados->receita_bruta, 2, ',', '.') }}</td>
                            @php
                                $ticket_medio = $resultados->total_vendas > 0 ? $resultados->receita_bruta / $resultados->total_vendas : 0;
                            @endphp
                            <td>R$ {{ number_format($ticket_medio, 2, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            @endif
            
            @if ($relatorio == 'produtos-vendidos' && $resultados && $resultados->count() > 0)
                <h5>Produtos Mais Vendidos (em Quantidade)</h5>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Produto/Serviço</th>
                            <th>Quantidade Vendida</th>
                            <th>Estoque Atual</th>
                            <th>Faturamento (Item)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resultados as $item)
                        <tr>
                            <td>{{ $item->nome }}</td>
                            <td>{{ number_format($item->quantidade_vendida, 2, ',', '.') }} {{ $item->unidade_medida }}</td>
                            <td>{{ number_format($item->estoque_atual, 2, ',', '.') }} {{ $item->unidade_medida }}</td>
                            <td>R$ {{ number_format($item->faturamento_item, 2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @elseif ($relatorio == 'produtos-vendidos')
                <div class="alert alert-info">Nenhuma venda de produto/serviço encontrada no período.</div>
            @endif
            
            @if ($relatorio == 'margem-lucro' && $resultados)
                <h5>Margem de Lucro Bruta</h5>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Total Faturamento</th>
                            <th>Total Custo (Produtos Vendidos)</th>
                            <th>Margem Bruta (Lucro)</th>
                            <th>% Margem Bruta (Lucro / Faturamento)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>R$ {{ number_format($resultados->total_faturamento, 2, ',', '.') }}</td>
                            <td>R$ {{ number_format($resultados->total_custo, 2, ',', '.') }}</td>
                            <td>R$ {{ number_format($resultados->margem_bruta, 2, ',', '.') }}</td>
                            <td class="{{ $resultados->porcentagem_margem > 0 ? 'text-success font-weight-bold' : 'text-danger' }}">
                                {{ number_format($resultados->porcentagem_margem, 2, ',', '.') }}%
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endif

        </div>
    </div>
    @else
        <div class="alert alert-info">Selecione um relatório, ajuste o período e clique em **Gerar** para visualizar os resultados.</div>
    @endif
</div>
@endsection