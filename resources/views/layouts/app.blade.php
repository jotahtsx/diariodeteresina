<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    {{-- Filament Styles --}}
    @filamentStyles
    @livewireStyles
</head>

<body class="font-sans antialiased">

    {{ $slot }}

    {{-- Filament Scripts --}}
    @filamentScripts
    @livewireScripts
</body>

</html>
