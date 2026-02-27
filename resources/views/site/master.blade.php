<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Pebas 40 Graus</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Raleway', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        [x-cloak] { display: none !important; }

        .z-60 { z-index: 60; }
        .z-70 { z-index: 70; }

        /* Custom Scrollbar Soft */
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e5e7eb;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #facc15;
        }
    </style>
</head>

<body 
    x-data="{ 
        open: false, 
        darkMode: localStorage.getItem('theme') === 'dark' 
    }" 
    x-init="
        $watch('darkMode', val => {
            localStorage.setItem('theme', val ? 'dark' : 'light');
            if (val) document.documentElement.classList.add('dark');
            else document.documentElement.classList.remove('dark');
        });
        {{-- Sincroniza o estado inicial no carregamento --}}
        if (darkMode) document.documentElement.classList.add('dark');
        else document.documentElement.classList.remove('dark');
    "
    :class="{ 'overflow-hidden': open }"
    class="bg-[rgb(var(--background))] text-[rgb(var(--foreground))] transition-colors duration-500"
    @keydown.window.escape="open = false">

    {{-- Overlay Escuro com Blur --}}
    <div x-show="open" 
         x-transition:opacity.duration.400ms 
         @click="open = false"
         class="fixed inset-0 bg-black/60 backdrop-blur-sm z-60" 
         x-cloak>
    </div>

    {{-- Sidebar (Aside) --}}
    <aside x-show="open" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full" 
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200" 
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed top-0 left-0 h-full w-full max-w-[350px] bg-white dark:bg-slate-900 z-70 shadow-2xl flex flex-col border-r border-gray-100 dark:border-slate-800"
        x-cloak>

        <div class="p-8 flex flex-col items-center border-b border-gray-50 dark:border-slate-800 relative bg-portal-blue/5">
            {{-- Botão Fechar --}}
            <button @click="open = false"
                class="absolute top-4 right-4 p-2 text-gray-400 hover:text-portal-blue transition-colors cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <a href="{{ route('site.home') }}" class="flex flex-col items-center group">
                <h2 class="text-xl md:text-2xl font-[900] tracking-tighter text-gray-900 dark:text-white leading-none text-center">
                    Pebas <span class="text-portal-blue">40</span><span class="text-portal-yellow">°</span>
                </h2>
            </a>
        </div>

        <nav class="flex-1 px-8 overflow-y-auto custom-scrollbar pt-10">
            <div class="mb-8">
                <h3 class="text-2xl font-[950] text-gray-900 dark:text-white tracking-tight">Notícias</h3>
                <div class="h-1 w-8 bg-portal-yellow mt-2"></div>
            </div>

            <div class="flex flex-col space-y-4">
                <a href="{{ route('site.home') }}"
                    class="group block text-lg transition-all duration-300 tracking-tight {{ Route::is('site.home') ? 'text-portal-blue font-[950]' : 'text-gray-500 font-bold hover:text-gray-900 dark:hover:text-white' }}">
                    <span class="inline-block group-hover:translate-x-1 transition-transform duration-300">
                        Página Inicial
                    </span>
                </a>

                @isset($categories)
                    @foreach ($categories as $cat)
                        <a href="{{ route('site.categoria', $cat->slug) }}"
                            class="group block text-lg transition-all duration-300 tracking-tight {{ request()->is('categoria/' . $cat->slug) ? 'text-portal-blue dark:text-portal-yellow font-[950]' : 'text-gray-500 font-bold hover:text-gray-900 dark:hover:text-white' }}">
                            <span class="inline-block group-hover:translate-x-1 transition-transform duration-300">
                                {{ $cat->name }}
                            </span>
                        </a>
                    @endforeach
                @endisset
            </div>
        </nav>

        <div class="p-8 border-t border-gray-100 dark:border-slate-800 bg-gray-50/30 dark:bg-slate-900/50">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">
                © 2026 Parauapebas — Pará
            </p>
        </div>
    </aside>

    @include('site.partials.header')

    <main class="min-h-screen animate-soft-entry">
        @yield('content')
    </main>

    @include('site.partials.footer')
</body>
</html>