<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    {{-- Título da Venda/Orçamento --}}
    <title>@yield('title', 'Documento de Impressão')</title>

    {{-- 
        Você pode incluir um arquivo CSS específico para impressão aqui, 
        ou manter todos os estilos de impressão diretamente no view.
        Se você usa Bootstrap, inclua o CSS dele AQUI. 
    --}}
    
    {{-- Se você usa Bootstrap ou outro framework, inclua o link para o CSS aqui --}}
    {{-- Exemplo: <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    {{-- Espaço para estilos internos (onde você colocará o CSS @page A5) --}}
    @yield('styles') 
    
</head>
<body onload="window.print();">
    
    {{-- O conteúdo específico da venda será injetado aqui --}}
    @yield('content')
    
</body>
</html>