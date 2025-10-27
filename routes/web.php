<?php

use Illuminate\Support\Facades\Route;

// Importar Controllers existentes
use App\Http\Controllers\MeuPrimeiroController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\AuthController;

// Imports de módulos de CRUD
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VeiculoController; 

/*
|--------------------------------------------------------------------------
| Rotas Web
|--------------------------------------------------------------------------
|
| Aqui você pode registrar rotas web para sua aplicação. Essas
| rotas são carregadas pelo RouteServiceProvider e todas receberão
| o grupo de middleware "web". Crie algo incrível!
|
*/

// Rota inicial (Página de boas-vindas)
Route::get('/', function () {
    return view('welcome');
})->name('welcome'); // Adicionando nome para facilitar redirecionamentos

// Rota de teste
Route::get('/teste', function() {
    return 'Bem vindo a laravel';
});


// ------------------------------
// ROTAS DE AUTENTICAÇÃO
// ------------------------------
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ------------------------------
// ROTAS PROTEGIDAS (APENAS USUÁRIOS AUTENTICADOS)
// ------------------------------
Route::middleware('auth')->group(function () {
    
    // Rota para o menu principal (Após o login)
    // Aponta para a view 'home' que você criou.
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // ** Rotas de Produto (Módulo Existente) **
    // Cria as 7 rotas RESTful para o CRUD de Produtos
    Route::resource('produtos', ProdutoController::class);

    // ** Rotas de Cliente **
    // Cria as 7 rotas RESTful para o CRUD de Clientes
    Route::resource('clientes', ClienteController::class);

    // ** NOVO MÓDULO: Rotas de Veículo **
    // Cria as 7 rotas RESTful para o CRUD de Veículos
    Route::resource('veiculos', VeiculoController::class);

});