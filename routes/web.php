<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\RelatorioController;
use App\Models\Cliente;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::resource('produtos', ProdutoController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('veiculos', VeiculoController::class);

    Route::resource('vendas', VendaController::class);

    Route::get('vendas/{venda}/print', [VendaController::class, 'printVenda'])->name('vendas.print');

    Route::get('/api/veiculos/cliente/{clienteId}', [VendaController::class, 'getVeiculosDoCliente'])->name('api.veiculos.cliente');
    Route::get('/api/produtos/detalhes/{produtoId}', [VendaController::class, 'getProdutoDetalhes'])->name('api.produtos.detalhes');
    
    Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');
    Route::get('/relatorios/exportar', [RelatorioController::class, 'exportPdf'])->name('relatorios.exportPdf');

});