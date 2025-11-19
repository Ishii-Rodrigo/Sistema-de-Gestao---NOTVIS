<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\VendaItem;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class RelatorioController extends Controller
{
    public function index(Request $request)
    {
        $relatorio = $request->get('tipo_relatorio', 'faturamento');
        $data_fim = $request->get('data_fim', Carbon::now()->toDateString());
        $data_inicio = $request->get('data_inicio', Carbon::parse($data_fim)->subMonths(1)->toDateString());
        $resultados = null;

        if ($request->has('tipo_relatorio')) {
          
            list($data_inicio, $data_fim) = $this->parseDateFilters($request);
            
            $resultados = $this->generateReport($relatorio, $data_inicio, $data_fim);
        }

        return view('relatorios.index', compact('relatorio', 'data_inicio', 'data_fim', 'resultados'));
    }

    private function generateReport($tipo_relatorio, $data_inicio, $data_fim)
    {
        switch ($tipo_relatorio) {
            case 'faturamento':
                return $this->getFaturamento($data_inicio, $data_fim);
            case 'produtos-vendidos':
                return $this->getProdutosMaisVendidos($data_inicio, $data_fim);
            case 'margem-lucro':
                return $this->getMargemLucro($data_inicio, $data_fim);
            default:
                return null;
        }
    }

    private function getFaturamento($inicio, $fim)
    {
        return Venda::whereBetween('data_venda', [$inicio, $fim])
                    ->select(
                        DB::raw('COUNT(id) as total_vendas'),
                       
                        DB::raw('SUM(total_final) as receita_bruta')
                    )
                    ->first();
    }

    private function getProdutosMaisVendidos($inicio, $fim)
    {
        return VendaItem::join('vendas', 'venda_items.venda_id', '=', 'vendas.id')
                        ->join('produtos', 'venda_items.produto_id', '=', 'produtos.id')
                        ->whereBetween('vendas.data_venda', [$inicio, $fim])
                        ->groupBy('produtos.id', 'produtos.nome', 'produtos.estoque_atual', 'produtos.unidade_medida')
                        ->select(
                            'produtos.nome', 
                            'produtos.estoque_atual',
                            'produtos.unidade_medida',
                            DB::raw('SUM(venda_items.quantidade) as quantidade_vendida'),
                            
                            DB::raw('SUM(venda_items.total_item) as faturamento_item')
                        )
                        ->orderByDesc('quantidade_vendida')
                        ->get();
    }

    private function getMargemLucro($inicio, $fim)
    {
        $dados = VendaItem::join('vendas', 'venda_items.venda_id', '=', 'vendas.id')
                        ->join('produtos', 'venda_items.produto_id', '=', 'produtos.id')
                        ->whereBetween('vendas.data_venda', [$inicio, $fim])
                        ->select(
                            DB::raw('SUM(venda_items.total_item) as total_faturamento'),
                           
                            DB::raw('SUM(produtos.preco_custo * venda_items.quantidade) as total_custo')
                        )
                        ->first();
       
        if (!$dados || $dados->total_faturamento === null) {
            return (object)['total_faturamento' => 0, 'total_custo' => 0, 'margem_bruta' => 0, 'porcentagem_margem' => 0];
        }

        $dados->margem_bruta = $dados->total_faturamento - $dados->total_custo;
        $dados->porcentagem_margem = $dados->total_faturamento > 0 
                                      ? ($dados->margem_bruta / $dados->total_faturamento) * 100 
                                      : 0;
        
        return $dados;
    }

    private function parseDateFilters(Request $request)
    {
        $data_inicio = $request->get('data_inicio');
        $data_fim = $request->get('data_fim');
        $periodo_rapido = $request->get('periodo_rapido');
        
        $now = Carbon::now();

        if ($periodo_rapido) {
            switch ($periodo_rapido) {
                case 'hoje':
                    $data_inicio = $now->startOfDay()->toDateString();
                    $data_fim = $now->endOfDay()->toDateString();
                    break;
                case 'semana':
                    $data_inicio = $now->startOfWeek(Carbon::SUNDAY)->toDateString();
                    $data_fim = $now->endOfWeek(Carbon::SATURDAY)->toDateString();
                    break;
                case 'mes':
                    $data_inicio = $now->startOfMonth()->toDateString();
                    $data_fim = $now->endOfMonth()->toDateString();
                    break;
                case 'ano':
                    $data_inicio = $now->startOfYear()->toDateString();
                    $data_fim = $now->endOfYear()->toDateString();
                    break;
            }
        }
      
        return [
            Carbon::parse($data_inicio)->startOfDay()->toDateTimeString(), 
            Carbon::parse($data_fim)->endOfDay()->toDateTimeString()
        ];
    }
    
    public function exportPdf(Request $request)
    {
        list($data_inicio, $data_fim) = $this->parseDateFilters($request);
        $relatorio = $request->get('tipo_relatorio');
        $resultados = $this->generateReport($relatorio, $data_inicio, $data_fim);

        $pdf = PDF::loadView('relatorios.print_pdf', compact('relatorio', 'data_inicio', 'data_fim', 'resultados'));
        
        $nome_arquivo = "relatorio-{$relatorio}-{$data_inicio}-a-{$data_fim}.pdf";

        return $pdf->download($nome_arquivo);
    }
}