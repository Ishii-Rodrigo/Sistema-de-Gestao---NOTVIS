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
    
    @yield('styles')

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f3f3f3ff; 
        }
        main {
            padding-top: 1rem;
            padding-bottom: 1rem;
            flex-grow: 1; 
            background: none !important; 
        }
       
        .navbar-light .navbar-nav .nav-link {
            color: rgba(0,0,0,.55);
        }

        .btn-primary-login {
            background-color: #007bff; 
            border-color: #007bff; 
            background-image: linear-gradient(to right, #007bff, #00c6ff);
        }

        .form-label {
            font-weight: 500;
        }

        .navbar-brand img {
            height: 45px; 
            width: auto;
        }
    </style>
</head>
<body class="@yield('body_class')">
    {{-- Barra de Navegação (Menu) --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('img/logo.png') }}" alt="NOTVIS - GESTÃO Logo">
            </a>
            
            @if (Auth::check())                
                
                <form action="{{ route('logout') }}" method="post" class="d-flex align-items-center me-3">
                    @csrf
                    <span class="me-3 text-secondary">Olá, {{ Auth::user()->name }}</span>
                    <button class="btn btn-primary btn-sm btn-primary-login" type="submit">Sair</button>
                </form>

            @else
                
                <div class="d-flex align-items-center me-3">
                    <span class="me-3 text-secondary">Olá, Usuário</span>
                </div>
            @endif
        </div>
    </nav>
    
    <main class="py-4">
        <div class="container">
            
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @hasSection('header')
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <h1 class="h3 text-secondary">@yield('header')</h1>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
            crossorigin="anonymous"></script>

    {{-- Adiciona scripts específicos da view --}}
    @yield('scripts')
</body>
</html>