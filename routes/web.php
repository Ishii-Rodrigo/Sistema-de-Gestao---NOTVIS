<?php

use Illuminate\Support\Facades\Route;

// Importar Controllers existentes
use App\Http\Controllers\MeuPrimeiroController;
// Note: Assumindo 'ProdutoController' como o nome correto, conforme o traço da exceção.
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\AuthController;

// Imports de módulos de CRUD
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VeiculoController; // <-- NOVO: Importar o Controller de Veiculo

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teste', function() {
    return 'Bem vindo a laravel';
});


// Rotas para autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ** Rotas de Produto (Módulo Existente) **
// Cria as 7 rotas RESTful para o CRUD de Produtos
Route::resource('produtos', ProdutoController::class);

// ** Rotas de Cliente **
// Esta linha cria as 7 rotas RESTful para o CRUD de Clientes
Route::resource('clientes', ClienteController::class);

// ** NOVO MÓDULO: Rotas de Veículo **
// Esta linha cria as 7 rotas RESTful para o CRUD de Veículos (index, create, store, show, edit, update, destroy)
Route::resource('veiculos', VeiculoController::class);
