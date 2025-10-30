<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }
    
    public function login(Request $request){
        
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'O campo e-mail é obrigatório',
            'email.email' => 'Digite um email valido',
            // CORREÇÃO APLICADA AQUI: Mudando a chave para 'password.required'
            'password.required' => 'O campo senha é obrigatório'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            // Redireciona para a home (Menu Principal) após o login
            return redirect()->intended('/home');
        }

        // CORREÇÃO APLICADA AQUI: A mensagem de erro de credenciais é mais descritiva
        return back()->withErrors([
            'email' => 'Credenciais inválidas. Verifique seu e-mail e senha.'
        ])->onlyInput('email');
        

    }

    public function logout(Request $request){
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken(); // Uso de regenerateToken é a prática mais segura
        
        // Redireciona para a rota de login nomeada 'login'
        return redirect()->route('login');
    }
}