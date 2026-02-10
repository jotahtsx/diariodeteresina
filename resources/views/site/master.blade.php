<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Diário de Teresina</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="/js/app.js" type="module" defer></script>
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

    {{-- Sidebar Calibrada: Equilíbrio entre Impacto e Elegância --}}
    <aside x-show="open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed top-0 left-0 h-full w-full max-w-[350px] bg-white z-70 shadow-2xl flex flex-col border-r border-gray-100"
        style="display: none;">

        {{-- Topo: Logo mais contida --}}
        <div class="p-8 flex justify-between items-center border-b border-gray-50">
            <h2 class="text-xl font-[950] tracking-tighter text-gray-900 leading-none uppercase">
                Diário de <span class="text-[#EA2027]">Teresina</span>
            </h2>
            <button @click="open = false" class="p-2 text-gray-400 hover:text-black transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
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

                @foreach ($categories as $cat)
                    <a href="{{ route('site.categoria', $cat->slug) }}"
                        class="group block text-lg transition-all duration-300 tracking-tight {{ request()->is('categoria/' . $cat->slug) ? 'text-gray-900 font-[950]' : 'text-gray-500 font-bold hover:text-gray-900' }}">
                        <span class="inline-block group-hover:translate-x-1 transition-transform duration-300">
                            {{ $cat->name }}
                        </span>
                    </a>
                @endforeach
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
