<header style="background-color: #EA2027; height: 70px;" class="sticky top-0 z-50 shadow-lg">
    <div class="container mx-auto h-full px-4 flex items-center justify-between">

        <div class="flex-1 flex justify-start">
            <button @click="open = true" class="text-white hover:opacity-70 transition-opacity p-2 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>

        <div class="flex-none py-2">
            <a href="{{ route('site.home') }}" class="flex flex-row items-center gap-3">
                <svg viewBox="0 0 200 80" xmlns="http://www.w3.org/2000/svg" class="h-10 w-auto">
                    <line x1="10" y1="70" x2="190" y2="70" stroke="white" stroke-width="2" />
                    <line x1="10" y1="74" x2="190" y2="74" stroke="white" stroke-width="1" />

                    <path d="M100 10 L85 70 M100 10 L115 70" stroke="white" stroke-width="4" fill="none" />

                    <line x1="100" y1="20" x2="30" y2="70" stroke="white"
                        stroke-width="0.8" />
                    <line x1="100" y1="30" x2="45" y2="70" stroke="white"
                        stroke-width="0.8" />
                    <line x1="100" y1="40" x2="60" y2="70" stroke="white"
                        stroke-width="0.8" />
                    <line x1="100" y1="50" x2="75" y2="70" stroke="white"
                        stroke-width="0.8" />

                    <line x1="100" y1="20" x2="170" y2="70" stroke="white"
                        stroke-width="0.8" />
                    <line x1="100" y1="30" x2="155" y2="70" stroke="white"
                        stroke-width="0.8" />
                    <line x1="100" y1="40" x2="140" y2="70" stroke="white"
                        stroke-width="0.8" />
                    <line x1="100" y1="50" x2="125" y2="70" stroke="white"
                        stroke-width="0.8" />
                </svg>

                <h1 class="text-xl md:text-2xl font-[900] tracking-tighter text-white leading-none"
                    style="font-family: 'Raleway', sans-serif;">
                    Diário de Teresina
                </h1>
            </a>
        </div>

        <div class="flex-1 hidden md:flex justify-end items-center gap-4">
            <div class="relative w-64 group">
                <input type="text" placeholder="Buscar notícias..."
                    class="w-full bg-white/10 hover:bg-white/20 focus:bg-white/20
                   text-white placeholder-white/70 text-sm py-2.5 pl-4 pr-10
                   rounded-full border border-white/10 focus:border-white/30
                   transition-all outline-none backdrop-blur-sm">

                <div
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-white/80
                   group-focus-within:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
            </div>

            <div class="flex items-center gap-4 pl-4 border-l border-white/20">


                <a href="#" aria-label="Instagram"
                    class="text-white/70 hover:text-[#E4405F]
              transition-all duration-300
              hover:scale-110">
                    <i class="fa-brands fa-instagram text-lg"></i>
                </a>

                <a href="#" aria-label="X"
                    class="text-white/70 hover:text-black
              transition-all duration-300
              hover:scale-110">
                    <i class="fa-brands fa-x-twitter text-lg"></i>
                </a>

                <a href="#" aria-label="Facebook"
                    class="text-white/70 hover:text-[#1877F2]
              transition-all duration-300
              hover:scale-110">
                    <i class="fa-brands fa-facebook-f text-lg"></i>
                </a>

                <a href="#" aria-label="TikTok"
                    class="text-white/70 hover:text-white
              transition-all duration-300
              hover:scale-110">
                    <i class="fa-brands fa-tiktok text-lg"></i>
                </a>
            </div>
        </div>
    </div>
</header>

<div class="w-full bg-white border-b border-gray-100 shadow-sm">
    <div class="container mx-auto px-4 h-16 flex items-center justify-between gap-6">
        <nav id="categories-list"
            class="flex items-center space-x-8 overflow-x-auto no-scrollbar py-2
   scroll-smooth cursor-grab active:cursor-grabbing">
            <a href="{{ route('site.home') }}"
                class="{{ Route::is('site.home') ? 'font-[950] text-[#EA2027]' : 'font-medium text-gray-600' }} hover:text-[#EA2027] text-[14px] transition-all whitespace-nowrap uppercase tracking-tight">
                Últimas
            </a>

            @isset($categories)
                @foreach ($categories as $cat)
                    @php
                        $isEsporte = str_contains(strtolower($cat->name), 'esporte');
                        $statusCache = cache('has_live_games', false);
                        $isActive = request()->is('categoria/' . $cat->slug);
                    @endphp

                    <a href="{{ route('site.categoria', $cat->slug) }}"
                        class="relative {{ $isActive ? 'font-[950] text-[#EA2027]' : 'font-medium text-gray-600' }} hover:text-[#EA2027] text-[14px] transition-all whitespace-nowrap uppercase tracking-tight flex items-center gap-2">

                        {{ $cat->name }}

                        @if ($isEsporte && $statusCache)
                            {{-- Seu código do ícone de live game mantido --}}
                            <div class="relative flex items-center justify-center w-5 h-5">
                                <span class="absolute flex h-2 w-2">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-600 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                </span>
                            </div>
                        @endif
                    </a>
                @endforeach
            @endisset
        </nav>

        <a href="https://wa.me/5586994173635" target="_blank"
            class="hidden lg:flex items-center group transition-all ml-10 pl-6 border-l border-gray-100">

            {{-- Ícone WhatsApp - Mantive o destaque na cor para conversão --}}
            <i
                class="fa-brands fa-whatsapp text-[#2ecc71] text-2xl mr-3 group-hover:scale-110 transition-transform"></i>

            <div class="flex flex-col leading-tight">
                <span class="text-[#2ecc71] text-[10px] font-black uppercase tracking-[0.15em]">
                    Sugestões
                </span>
                <span
                    class="text-gray-600 text-[15px] font-bold font-mono tracking-tighter group-hover:text-black transition-colors">
                    86 99417-3635
                </span>
            </div>
        </a>
    </div>
</div>

<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .social-hover:hover {
        filter: drop-shadow(0 0 6px rgba(255, 255, 255, 0.35));
    }
</style>
