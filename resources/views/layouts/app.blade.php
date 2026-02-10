<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @filamentStyles
    @livewireStyles
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-900">

    {{-- Aqui entra o conteúdo das suas views --}}
    {{ $slot }}

    @filamentScripts
    @livewireScripts
</body>

</html>
