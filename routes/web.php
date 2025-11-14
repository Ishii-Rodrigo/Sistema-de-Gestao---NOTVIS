<?php

use Illuminate\Support\Facades\Route;

// Importar Controllers existentes
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VeiculoController; 
use App\Http\Controllers\VendaController; 
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
    Route::resource('vendas', VendaController::class);

    // ** Rota de API para carregar veículos de um cliente (CORRIGIDA/ADICIONADA) **
    // Mapeia para o novo método no VendaController
    Route::get('/api/veiculos/cliente/{clienteId}', [VendaController::class, 'getVeiculosPorCliente'])
        ->name('api.veiculos.cliente');
        
});