<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Diário de Teresina')</title>

    {{-- SEO básico --}}
    <meta name="description" content="@yield('description', 'Notícias de Teresina e do Piauí em tempo real')">

    {{-- Fonts / Icons (se estiver usando FontAwesome) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- VITE (OBRIGATÓRIO) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900 antialiased">

    {{-- HEADER --}}
    @include('site.partials.header')

    {{-- CONTEÚDO PRINCIPAL --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER (opcional) --}}
    {{-- @include('site.partials.footer') --}}

</body>

</html>
