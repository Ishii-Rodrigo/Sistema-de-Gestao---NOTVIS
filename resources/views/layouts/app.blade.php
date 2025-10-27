<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Meu Sistema')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
          crossorigin="anonymous">
    
    <style>
        /* Padronizando o estilo para se parecer com a tela de login */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f8f9fa; /* Fundo mais claro, como o login */
        }
        main {
            padding-top: 1rem;
            padding-bottom: 1rem;
            flex-grow: 1; 
            background: none !important; /* Remove o gradiente azul de todas as telas */
        }
        
        /* Estilos para a navbar (logado e não logado) */
        .navbar-light .navbar-nav .nav-link {
            color: #495057 !important; /* Links mais escuros */
        }
        .navbar-light .navbar-nav .nav-link:hover {
            color: #007bff !important;
        }
        
        /* Estilo do botão Sair/Entrar (gradiente azul do login) */
        .btn-primary-login {
            background-color: #007bff; 
            border-color: #007bff; 
            background-image: linear-gradient(to right, #007bff, #00c6ff);
        }

    </style>
    @yield('styles') {{-- Ponto de Injeção para CSS específico da view --}}
</head>
<body class="@yield('body_class')">

    @php
        // Verifica se a rota atual é 'home' (Menu Principal)
        $isHome = Auth::check() && Route::currentRouteName() === 'home';
    @endphp

    {{-- NAV BAR PRINCIPAL (Branca, como a tela de login) --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-fluid d-flex justify-content-between align-items-center"> 
            
            {{-- Logo (AGORA COM IMAGEM) --}}
            <a class="navbar-brand d-flex align-items-center ps-4" href="{{ Auth::check() ? route('home') : route('login') }}">
                {{-- Troca do span de texto pelo img asset --}}
                <img src="{{ asset('img/logo.png') }}" 
                     alt="Logo NOTVIS" 
                     style="height: 50px;">
            </a>
            
            @if (Auth::check())
                {{-- NAV BAR COM MENU (Para telas internas) --}}
                @if (!$isHome)
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav me-auto">
                            {{-- DROPDOWN CADASTROS --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCadastros" role="button" data-bs-toggle="dropdown" aria-expanded="false">Cadastros</a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownCadastros">
                                    <li><a class="dropdown-item" href="{{ route('clientes.index') }}">Clientes</a></li>
                                    <li><a class="dropdown-item" href="#">Fornecedores</a></li> 
                                    <li><a class="dropdown-item" href="{{ route('produtos.index') }}">Produtos</a></li>
                                    <li><a class="dropdown-item" href="{{ route('veiculos.index') }}">Veículos</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#">Venda/OS</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Relatórios</a></li>
                        </ul>
                    </div>
                @endif
                
                {{-- Bloco de Usuário (Sempre presente quando logado) --}}
                <form action="{{ route('logout') }}" method="post" class="d-flex align-items-center me-3">
                    @csrf
                    <span class="me-3 text-secondary">Olá, {{ Auth::user()->name }}</span>
                    {{-- Botão 'Sair' com estilo gradiente do login --}}
                    <button class="btn btn-primary btn-sm btn-primary-login" type="submit">Sair</button>
                </form>

            @else
                {{-- NAV BAR NÃO LOGADO (Para tela de Login) --}}
                <div class="d-flex align-items-center me-3">
                    <span class="me-3 text-secondary">Olá, Usuário</span>
                    {{-- Botão 'Entrar' com estilo gradiente do login --}}
                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm btn-primary-login">Entrar</a>
                </div>
            @endif
        </div>
    </nav>
    
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- O footer fixo será adicionado diretamente nas views 'home' e 'login' --}}
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
            crossorigin="anonymous">
    </script>
    @yield('scripts')
</body>
</html>