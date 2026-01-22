<header style="background-color: #EA2027; height: 70px;" class="sticky top-0 z-50 shadow-lg">
    <div class="container mx-auto h-full px-4 flex items-center justify-between">

        <div class="flex-1 flex justify-start">
            <button class="text-white hover:opacity-70 transition-opacity p-2 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>

        <div class="flex-none">
            <a href="{{ route('site.home') }}">
                <h1 class="text-2xl md:text-3xl font-[900] tracking-tighter text-white leading-none">
                    Diário de <span class="opacity-90">Teresina</span>
                </h1>
            </a>
        </div>

        {{-- DIREITA: Busca --}}
        <div class="flex-1 hidden md:flex justify-end items-center gap-4">

            {{-- SEARCH --}}
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
    {{-- Aumentado de h-12 para h-16 (+16px de respiro total) --}}
    <div class="container mx-auto px-4 h-16 flex items-center justify-between gap-6">

        {{-- CATEGORIAS (Esquerda) --}}
        <nav id="categories-list"
            class="flex items-center space-x-8 overflow-x-auto no-scrollbar py-2
                   scroll-smooth cursor-grab active:cursor-grabbing">

            @isset($categories)
                @foreach ($categories as $cat)
                    <a href="{{ route('site.categoria', $cat->slug) }}"
                        class="text-gray-600 hover:text-[#EA2027]
                               font-bold text-[14px] transition-all
                               hover:-translate-y-[1px] whitespace-nowrap uppercase tracking-tight">
                        {{ $cat->name }}
                    </a>
                @endforeach
            @else
                <span class="text-gray-300 text-[11px] font-bold animate-pulse uppercase tracking-widest">
                    Carregando...
                </span>
            @endisset
        </nav>

        {{-- WHATSAPP ESTRATÉGICO (Direita) --}}
        <a href="https://wa.me/5586994173636" target="_blank" class="hidden lg:flex items-center group transition-all">

            {{-- Aumentado o padding (py-2.5 px-6) e o arredondamento --}}
            <div
                class="flex items-center bg-[#2ecc71]/10 group-hover:bg-[#2ecc71]/20 py-2.5 px-6 rounded-[25px] border border-[#2ecc71]/20 transition-all shadow-sm group-hover:shadow-md">
                {{-- Ícone WhatsApp maior --}}
                <i class="fa-brands fa-whatsapp text-[#2ecc71] text-xl mr-3"></i>

                <div class="flex flex-col leading-tight">
                    <span class="text-[#2ecc71] text-[10px] font-[900] uppercase tracking-wider">Sugestões</span>
                    <span
                        class="text-gray-800 text-[15px] font-bold font-mono tracking-tighter group-hover:text-black transition-colors">
                        86 99417-3636
                    </span>
                </div>
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
