@extends('layouts.app')

@section('title', 'Login no Sistema')

<!-- Remove a navbar e o footer na tela de login, mas mantém a estrutura básica. 
     Usa header vazio para não mostrar o título na navbar, que será removida ou ajustada. 
     Nota: Fizemos a remoção condicional do footer no app.blade.php. -->
@section('header', '')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg p-4">
                <div class="card-body">
                    <h2 class="card-title text-center text-primary mb-4">Acesso ao Sistema</h2>
                    <p class="card-subtitle text-center text-muted mb-4">Entre com suas credenciais.</p>

                    <!-- Exibe mensagens de erro de validação -->
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

                        <!-- Campo E-mail -->
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Senha -->
                        <div class="mb-4">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Botão de Login -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Entrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
