<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Meu Sistema')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
          crossorigin="anonymous">
    
    <style>
        /* Ajusta o espaçamento superior e inferior do conteúdo principal */
        main {
            padding-top: 1rem !important; /* Reduz de py-4 para um padding menor */
            padding-bottom: 1rem !important; /* Reduz de py-4 para um padding menor */
            flex-grow: 1; /* Garante que o conteúdo ocupe o espaço disponível */

            background: linear-gradient(to right, rgb(20,147,220), rgb(17, 54, 71));
        }
        /* Configura a altura mínima da body para permitir o layout flex */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        /* Estilo para a imagem do logo no navbar para garantir alinhamento */
        .navbar-brand img {
            vertical-align: middle;
            margin-bottom: 2px; /* Pequeno ajuste de alinhamento */
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid"> 
        <a class="navbar-brand d-flex align-items-center ps-4" href="/">
            <img src="{{ asset('img/logo.png') }}" 
                alt="Logo Carro" 
                style="height: 90px; margin-right: 2px;">
        </a>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                {{-- Verifica se o usuário está logado para mostrar os links principais --}}
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('produtos.index') }}">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('clientes.index') }}">Clientes</a>
                    </li>
                @endif
            </ul>

            {{-- Login/Logout na direita --}}
            @if(Auth::check())
                <form action="{{ route('logout') }}" method="post" class="d-flex align-items-center me-3">
                    @csrf
                    {{-- Exibe o nome do usuário logado --}}
                    <span class="navbar-text me-3 text-white">
                        Olá, {{ Auth::user()->name }}
                    </span>
                    {{-- Botão 'Sair' (Logout) --}}
                    <button class="btn btn-outline-light btn-sm" type="submit">Sair</button>
                </form>
            @endif
        </div>
    </div>
</nav>
    
    @if (Auth::check())
        <header class="py-2 bg-light border-bottom"> <div class="container">
                <h1 class="h6 text-secondary mb-0">@yield('header', 'Módulo Principal')</h1> </div>
        </header>
    @endif

    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="bg-dark text-white py-2"> <div class="container text-center">
            <p class="mb-0">&copy; {{date('Y')}} - NOTVIS. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
            crossorigin="anonymous">
    </script>
</body>
</html>