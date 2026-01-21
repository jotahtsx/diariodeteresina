<header style="background-color: #EA2027; height: 70px;" class="sticky top-0 z-50 shadow-lg">
    <div class="container mx-auto h-full px-4 flex items-center justify-between">
        
        {{-- ESQUERDA: Menu Hambúrguer --}}
        <div class="flex-1 flex justify-start">
            <button class="text-white hover:opacity-70 transition-opacity p-2 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>

        {{-- CENTRO: Logo Raleway Puro --}}
        <div class="flex-none">
            <a href="{{ route('site.home') }}" class="block">
                <h1 class="text-2xl md:text-3xl font-[900] tracking-tighter text-white leading-none">
                    Diário de <span class="opacity-90">Teresina</span>
                </h1>
            </a>
        </div>

        {{-- DIREITA: Busca --}}
        <div class="flex-1 hidden md:flex justify-end">
            <div class="relative w-64 group">
                {{-- O Input --}}
                <input 
                    type="text" 
                    placeholder="Buscar notícias..." 
                    class="w-full bg-white/10 hover:bg-white/20 focus:bg-white/20 text-white placeholder-white/70 text-sm py-2.5 pl-4 pr-10 rounded-full border border-white/10 focus:border-white/30 transition-all duration-300 outline-none backdrop-blur-sm"
                >
                
                {{-- Ícone dentro do Input --}}
                <div class="absolute right-3 top-1/2 -translate-y-1/2 text-white/80 group-focus-within:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Ícone de busca apenas para Mobile (Oculto no Desktop) --}}
        <div class="flex md:hidden flex-none">
            <button class="text-white p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>
        </div>
    </div>
</header>