<header style="background-color: #EA2027; height: 70px;" class="sticky top-0 z-50 shadow-lg">
    <div class="container mx-auto h-full px-4 grid grid-cols-3 items-center">
        <div class="flex justify-start">
            <button @click="open = true"
                class="text-white hover:opacity-70 transition-opacity p-2 focus:outline-none cursor-pointer">
                <div class="space-y-1.5 flex flex-col items-start">
                    <span class="block w-7 h-0.5 bg-white rounded-full"></span>
                    <span class="block w-5 h-0.5 bg-white rounded-full"></span>
                    <span class="block w-7 h-0.5 bg-white rounded-full"></span>
                </div>
            </button>
        </div>

        <div class="flex justify-center py-2">
            <a href="{{ route('site.home') }}" class="flex flex-row items-center gap-3">
                <svg viewBox="0 0 200 80" xmlns="http://www.w3.org/2000/svg" class="h-10 w-auto">
                    <line x1="10" y1="70" x2="190" y2="70" stroke="white" stroke-width="2" />
                    <line x1="10" y1="74" x2="190" y2="74" stroke="white" stroke-width="1" />
                    <path d="M100 10 L85 70 M100 10 L115 70" stroke="white" stroke-width="4" fill="none" />
                    <g stroke="white" stroke-width="0.8">
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
                <h1 class="text-xl md:text-2xl font-[900] tracking-tighter text-white leading-none"
                    style="font-family: 'Raleway', sans-serif;">
                    Diário de Teresina
                </h1>
            </a>
        </div>

        <div class="hidden md:flex justify-end items-center gap-4">
            <div class="relative w-56 lg:w-64">
                <input type="text" placeholder="Buscar notícias..."
                    class="w-full bg-white/10 hover:bg-white/15 focus:bg-white/20
                   text-white placeholder-white/70 text-sm py-2.5 pl-4 pr-10
                   rounded-xl border border-white/5 focus:border-white/20
                   transition-all outline-none backdrop-blur-sm shadow-inner">
                <div class="absolute right-3 top-1/2 -translate-y-1/2 text-white/80">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
            </div>

            <div class="flex items-center gap-3 pl-3 border-l border-white/20">
                <button x-data="{
                    darkMode: localStorage.getItem('theme') === 'dark',
                    toggle() {
                        this.darkMode = !this.darkMode;
                        localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
                        document.documentElement.classList.toggle('dark', this.darkMode);
                    }
                }" x-init="document.documentElement.classList.toggle('dark', darkMode)" @click="toggle()"
                    class="relative w-8 h-8 flex items-center justify-center text-white/70 hover:text-white transition-all duration-300 hover:scale-110 focus:outline-none cursor-pointer">
                    <i x-show="!darkMode" class="fa-solid fa-moon text-lg absolute"></i>
                    <i x-show="darkMode" x-cloak class="fa-solid fa-sun text-yellow-400 text-lg absolute"></i>
                </button>

                <div class="flex items-center gap-3">
                    <a href="#" class="text-white/70 hover:text-[#E4405F] transition-all hover:scale-110"><i
                            class="fa-brands fa-instagram text-lg"></i></a>
                    <a href="#" class="text-white/70 hover:text-black transition-all hover:scale-110"><i
                            class="fa-brands fa-x-twitter text-lg"></i></a>
                    <a href="#" class="text-white/70 hover:text-[#1877F2] transition-all hover:scale-110"><i
                            class="fa-brands fa-facebook-f text-lg"></i></a>
                    <a href="#" class="text-white/70 hover:text-white transition-all hover:scale-110"><i
                            class="fa-brands fa-tiktok text-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
</header>


<div class="w-full bg-white border-b border-gray-100 shadow-sm">
    <div class="container mx-auto px-4 h-16 flex items-center justify-between gap-6">
        <nav id="categories-list" class="flex items-center space-x-8 overflow-x-auto no-scrollbar py-2">
            <a href="{{ route('site.home') }}"
                class="{{ Route::is('site.home') ? 'font-[950] text-[#EA2027]' : 'font-medium text-gray-600' }} hover:text-[#EA2027] text-[14px] transition-all whitespace-nowrap uppercase tracking-tight">
                Últimas
            </a>

            @isset($categories)
                @foreach ($categories as $cat)
                    <a href="{{ route('site.categoria', $cat->slug) }}"
                        class="relative {{ request()->is('categoria/' . $cat->slug) ? 'font-[950] text-[#EA2027]' : 'font-medium text-gray-600' }} hover:text-[#EA2027] text-[14px] transition-all whitespace-nowrap uppercase tracking-tight flex items-center gap-2">
                        {{ $cat->name }}
                    </a>
                @endforeach
            @endisset
        </nav>

        <a href="https://wa.me/5586994173635" target="_blank"
            class="hidden lg:flex items-center group transition-all ml-10 pl-6 border-l border-gray-100">
            <i
                class="fa-brands fa-whatsapp text-[#2ecc71] text-2xl mr-3 group-hover:scale-110 transition-transform"></i>
            <div class="flex flex-col leading-tight">
                <span class="text-[#2ecc71] text-[10px] font-black uppercase tracking-[0.15em]">Sugestões</span>
                <span
                    class="text-gray-600 text-[15px] font-bold font-mono tracking-tighter group-hover:text-black transition-colors">
                    86 99417-3635
                </span>
            </div>
        </a>
    </div>
</div>
