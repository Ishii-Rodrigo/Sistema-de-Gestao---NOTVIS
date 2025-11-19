<?php

use Illuminate\Support\Facades\Route;

// Importar Controllers existentes
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\RelatorioController; // 💡 Importa o novo Controller
use App\Models\Cliente;

/*
|--------------------------------------------------------------------------
| Rotas Web
|--------------------------------------------------------------------------
*/

// ROTAS DE AUTENTICAÇÃO (LOGIN / LOGOUT)
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ROTAS PROTEGIDAS (APENAS USUÁRIOS AUTENTICADOS)
Route::middleware('auth')->group(function () {

    // Rotas Principais
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // Rotas Resource (CRUD)
    Route::resource('produtos', ProdutoController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('veiculos', VeiculoController::class);

    // ** Rotas da Venda (Resource) **
    Route::resource('vendas', VendaController::class);

    // Rota ADICIONAL para Impressão
    Route::get('vendas/{venda}/print', [VendaController::class, 'printVenda'])->name('vendas.print');

    // Rotas de API
    Route::get('/api/veiculos/cliente/{clienteId}', [VendaController::class, 'getVeiculosDoCliente'])->name('api.veiculos.cliente');
    Route::get('/api/produtos/detalhes/{produtoId}', [VendaController::class, 'getProdutoDetalhes'])->name('api.produtos.detalhes');
    
    
    // =========================================================================
    // 💡 NOVAS ROTAS DE RELATÓRIOS
    // =========================================================================
    Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');
    Route::get('/relatorios/exportar', [RelatorioController::class, 'exportPdf'])->name('relatorios.exportPdf');

});