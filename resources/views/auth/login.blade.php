@extends('layouts.app')

@section('title', 'Acesso ao Sistema NOTVIS')

@section('header', '')

@section('body_class', 'login-page') 

@section('content')
<div class="container-fluid" style="flex-grow: 1;">
    <div class="row justify-content-center align-items-center" style="min-height: 85vh;">
        
        <div class="col-md-6 d-none d-md-flex flex-column align-items-center justify-content-center text-center px-5">
            
            <h1 class="display-5 fw-bold mb-3" style="color: rgb(20,147,220);">
                Sistema de Gestão NOTVIS
            </h1>
            <p class="lead mb-4 text-muted">
                Gestão completa para sua oficina mecânica. Controle de serviços, clientes e estoque em um só lugar.
            </p>
            
            {{--
            <div class="text-start">
                <span class="d-block mb-1"><i class="bi bi-circle-fill text-primary me-2" style="font-size: 0.5rem;"></i> Gestão de Serviços</span>
                <span class="d-block mb-1"><i class="bi bi-circle-fill text-primary me-2" style="font-size: 0.5rem;"></i> Controle de Estoque</span>
                <span class="d-block mb-1"><i class="bi bi-circle-fill text-primary me-2" style="font-size: 0.5rem;"></i> Relatórios Detalhados</span>
            </div>
            --}}
            
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg p-4 border-0">
                <div class="card-body">
                    <h2 class="card-title text-center text-primary mb-1">Área de Acesso</h2>
                    <p class="card-subtitle text-center text-muted mb-4" style="font-size: 0.9rem;">Sistema de gestão NOTVIS</p>

                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.submit') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <div class="input-group">
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="seu@email.com"
                                       required 
                                       autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <div class="input-group">
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       placeholder="••••••••"
                                       required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Lembrar-me
                                </label>
                            </div>
                            <a href="#" class="text-decoration-none">Esqueceu a senha?</a>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg" style="background-color: #007bff; border-color: #007bff; background-image: linear-gradient(to right, #007bff, #00c6ff);">
                                Entrar no Sistema
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="w-100 position-absolute bottom-0 start-0 bg-primary" style="height: 50px;">
            <div class="container text-center text-white p-2">
                 <span class="fw-bold">© 2025 - NOTVIS. Todos os direitos reservados.</span>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilos específicos para a tela de login */
    .login-page main {
        background: none !important; /* Remove o gradiente da main padrão */
        padding: 0 !important;
        flex-grow: 1;
    }
    .login-page body {
        background-color: #f8f9fa; /* Fundo mais claro */
    }
    /* O logo na navbar superior (definida em app.blade.php) garante o logo no canto. */
</style>

@endsection