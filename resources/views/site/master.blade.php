<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Diário de Teresina</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- Importando Raleway com pesos 400 (normal), 700 (bold) e 900 (black) --}}
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700;900&display=swap" rel="stylesheet">

    <style>
        body { 
            font-family: 'Raleway', sans-serif; 
            -webkit-font-smoothing: antialiased; /* Deixa a fonte mais nítida */
        }
    </style>
</head>
<body class="bg-[#FDFDFD] text-slate-900">
    @include('site.partials.header')
    
    <main class="min-h-screen container mx-auto px-4 py-8">
        @yield('content')
    </main>

    @include('site.partials.footer')
</body>
</html>