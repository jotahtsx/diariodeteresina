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

        /* Custom Z-index para o Tailwind via CDN se não estiver no config */
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
    </style>
</head>

<body class="bg-[#FDFDFD] text-slate-900" x-data="{ open: false }">

    <div x-show="open" x-transition:opacity @click="open = false"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm z-60" style="display: none;">
    </div>

    <aside x-show="open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed top-0 left-0 h-full w-[320px] bg-white z-70 shadow-2xl flex flex-col border-r border-gray-100"
        style="display: none;">

        <div class="p-8 flex justify-between items-center border-b border-gray-50">
            <h2 class="text-2xl font-[950] tracking-tighter text-gray-900 leading-none">
                Diário de <span class="text-[#EA2027]">Teresina</span>
            </h2>
            <button @click="open = false"
                class="p-2 hover:bg-gray-100 transition-colors text-gray-400 hover:text-black">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Corpo: Listagem de Notícias --}}
        <nav class="flex-1 px-8 overflow-y-auto no-scrollbar space-y-6 pt-10">
            <div>
                <h3 class="text-3xl font-[950] text-gray-900 tracking-tight mb-6">
                    Notícias
                </h3>
            </div>

            <div class="flex flex-col space-y-5">
                <a href="{{ route('site.home') }}"
                    class="block text-xl font-bold {{ Route::is('site.home') ? 'text-[#EA2027]' : 'text-gray-600' }} hover:text-[#EA2027] transition-colors tracking-tight">
                    Página Inicial
                </a>

                @foreach ($categories as $cat)
                    <a href="{{ route('site.categoria', $cat->slug) }}"
                        class="block text-xl font-bold {{ request()->is('categoria/' . $cat->slug) ? 'text-gray-900 font-[950]' : 'text-gray-600' }} hover:text-gray-900 transition-colors tracking-tight">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </nav>

        <div class="p-8 border-t border-gray-100">
            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                © 2026 Teresina - Piauí
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
