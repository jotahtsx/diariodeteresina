<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Diário de Teresina</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Raleway', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .z-60 {
            z-index: 60;
        }

        .z-70 {
            z-index: 70;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Custom Scrollbar Soft */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e5e7eb;
            /* Cinza bem clarinho */
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #EA2027;
            /* Fica vermelho ao passar o mouse */
        }
    </style>
</head>

<body class="bg-[#FDFDFD] text-slate-900" x-data="{ open: false }" @keydown.window.escape="open = false"
    :class="{ 'overflow-hidden': open }">

    {{-- Overlay Escuro com Blur --}}
    <div x-show="open" x-transition:opacity.duration.400ms @click="open = false"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm z-60" style="display: none;">
    </div>

    <aside x-show="open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed top-0 left-0 h-full w-full max-w-[350px] bg-white z-70 shadow-2xl flex flex-col border-r border-gray-100"
        style="display: none;">

        <div class="p-8 flex flex-col items-center border-b border-gray-50 relative bg-gray-50/30">
            {{-- Botão Fechar --}}
            <button @click="open = false"
                class="absolute top-4 right-4 p-2 text-gray-400 hover:text-[#EA2027] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <a href="{{ route('site.home') }}" class="flex flex-col items-center group">
                <svg viewBox="0 0 200 80" xmlns="http://www.w3.org/2000/svg"
                    class="h-16 w-auto mb-3 transform group-hover:scale-105 transition-transform duration-300">
                    <line x1="10" y1="70" x2="190" y2="70" stroke="#EA2027"
                        stroke-width="2" />
                    <line x1="10" y1="74" x2="190" y2="74" stroke="#EA2027"
                        stroke-width="1" />
                    <path d="M100 10 L85 70 M100 10 L115 70" stroke="#EA2027" stroke-width="4" fill="none" />
                    <g stroke="#EA2027" stroke-width="0.8" opacity="0.8">
                        <line x1="100" y1="20" x2="30" y2="70" />
                        <line x1="100" y1="30" x2="45" y2="70" />
                        <line x1="100" y1="40" x2="60" y2="70" />
                        <line x1="100" y1="50" x2="75" y2="70" />
                        <line x1="100" y1="20" x2="170" y2="70" />
                        <line x1="100" y1="30" x2="155" y2="70" />
                        <line x1="100" y1="40" x2="140" y2="70" />
                        <line x1="100" y1="50" x2="125" y2="70" />
                    </g>
                </svg>

                <h2 class="text-xl md:text-2xl font-[900] tracking-tighter text-gray-900 leading-none text-center"
                    style="font-family: 'Raleway', sans-serif;">
                    Diário de <span class="text-[#EA2027]">Teresina</span>
                </h2>
            </a>
        </div>

        <nav class="flex-1 px-8 overflow-y-auto custom-scrollbar pt-10">
            <div class="mb-8">
                <h3 class="text-2xl font-[950] text-gray-900 tracking-tight">
                    Notícias
                </h3>
                <div class="h-1 w-8 bg-[#EA2027] mt-2"></div>
            </div>

            <div class="flex flex-col space-y-4">
                <a href="{{ route('site.home') }}"
                    class="group block text-lg transition-all duration-300 tracking-tight {{ Route::is('site.home') ? 'text-[#EA2027] font-[950]' : 'text-gray-500 font-bold hover:text-gray-900' }}">
                    <span class="inline-block group-hover:translate-x-1 transition-transform duration-300">
                        Página Inicial
                    </span>
                </a>

                @isset($categories)
                    @foreach ($categories as $cat)
                        <a href="{{ route('site.categoria', $cat->slug) }}"
                            class="group block text-lg transition-all duration-300 tracking-tight {{ request()->is('categoria/' . $cat->slug) ? 'text-gray-900 font-[950]' : 'text-gray-500 font-bold hover:text-gray-900' }}">
                            <span class="inline-block group-hover:translate-x-1 transition-transform duration-300">
                                {{ $cat->name }}
                            </span>
                        </a>
                    @endforeach
                @endisset
            </div>
        </nav>

        <div class="p-8 border-t border-gray-100 bg-gray-50/30">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">
                © 2026 Piauí — Brasil
            </p>
        </div>
    </aside>

    @include('site.partials.header')

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('site.partials.footer')
</body>

</html>
