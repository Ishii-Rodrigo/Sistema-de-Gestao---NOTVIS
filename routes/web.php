<?php

use Illuminate\Support\Facades\Route;

// Importar Controllers existentes
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VeiculoController; 
use App\Http\Controllers\VendaController; 

/*
|--------------------------------------------------------------------------
| Rotas Web
|--------------------------------------------------------------------------
*/

// ------------------------------
// ROTAS DE AUTENTICAÇÃO (LOGIN / LOGOUT)
// ------------------------------

// Rota para mostrar o formulário de login (rota '/' e nome 'login')
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
// Rota para processar a submissão do formulário de login (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
// Rota para fazer logout (POST)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ------------------------------
// ROTAS PROTEGIDAS (APENAS USUÁRIOS AUTENTICADOS)
// ------------------------------
Route::middleware('auth')->group(function () {
    
    // Rota para o menu principal (Após o login)
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // ** Rotas de Produto **
    Route::resource('produtos', ProdutoController::class);

    // ** Rotas de Cliente **
    Route::resource('clientes', ClienteController::class);

    // ** Rotas de Veículo **
    Route::resource('veiculos', VeiculoController::class);

    // ** Rotas de Venda/Serviços **
    Route::resource('vendas', VendaController::class);
});