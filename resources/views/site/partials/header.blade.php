{{-- Header Principal Azul --}}
<header style="background-color: #1e40af; height: 70px;" class="sticky top-0 z-50 shadow-lg">
    <div class="container mx-auto h-full px-4 grid grid-cols-3 items-center">
        {{-- Esquerda: Hamburguer --}}
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

        {{-- Centro: Logo --}}
        <div class="flex justify-center py-2">
            <a href="{{ route('site.home') }}" class="flex flex-row items-center gap-3">
                <h1 class="text-xl md:text-2xl font-[900] tracking-tighter text-white leading-none">
                    Pebas <span style="color: #facc15;">40°</span>
                </h1>
            </a>
        </div>

        {{-- Direita: Dark Mode + Redes Sociais --}}
        <div class="flex justify-end items-center gap-4">
            <button @click="darkMode = !darkMode" class="text-white/80 hover:text-white p-2 cursor-pointer focus:outline-none">
                <i x-show="!darkMode" class="fa-solid fa-moon text-lg"></i>
                <i x-show="darkMode" x-cloak class="fa-solid fa-sun text-yellow-400 text-lg"></i>
            </button>

            <div class="hidden md:flex items-center gap-3 pl-3 border-l border-white/20">
                <a href="#" class="text-white/70 hover:text-[#E4405F] transition-all hover:scale-110">
                    <i class="fa-brands fa-instagram text-lg"></i>
                </a>
                <a href="#" class="text-white/70 hover:text-black dark:hover:text-white transition-all hover:scale-110">
                    <i class="fa-brands fa-x-twitter text-lg"></i>
                </a>
                <a href="#" class="text-white/70 hover:text-white transition-all hover:scale-110">
                    <i class="fa-brands fa-tiktok text-lg"></i>
                </a>
            </div>
        </div>
    </div>
</header>

{{-- A BARRA DO MENU - RESOLVIDA --}}
<div class="w-full border-b border-gray-200 dark:border-slate-800 shadow-sm mb-6 transition-all duration-300"
     :style="darkMode 
        ? 'background: #0f172a !important;' 
        : 'background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%) !important;'">
    
    <div class="container mx-auto px-4 h-16 flex items-center justify-between gap-6">
        <nav class="flex items-center space-x-8 overflow-x-auto no-scrollbar py-2">
            @php
                $isHomeActive = Route::is('site.home');
            @endphp
            <a href="{{ route('site.home') }}"
                class="text-[17px] transition-all whitespace-nowrap tracking-tighter hover:opacity-70"
                :class="darkMode ? 'text-white' : 'text-black'"
                style="font-weight: 900; {{ $isHomeActive ? 'color: #1e40af !important;' : '' }}">
                Últimas
            </a>

            @isset($categories)
                @foreach ($categories as $cat)
                    @php
                        $isEsporte = Str::lower($cat->name) == 'esporte' || $cat->slug == 'esporte' || $cat->slug == 'esportes';
                        $displayName = $isEsporte ? 'Esportes' : $cat->name;
                        $isActive = request()->is('categoria/' . $cat->slug);
                        
                        $customColor = null;
                        if ($isEsporte) { $customColor = '#27ae60'; }
                        elseif ($isActive) { $customColor = '#1e40af'; }
                    @endphp
                    <a href="{{ route('site.categoria', $cat->slug) }}"
                        class="text-[17px] transition-all whitespace-nowrap tracking-tighter hover:opacity-70"
                        :class="darkMode ? 'text-white' : 'text-black'"
                        style="font-weight: 900; @if($customColor) color: {{ $customColor }} !important; @endif">
                        {{ $displayName }}
                    </a>
                @endforeach
            @endisset
        </nav>

        <a href="https://wa.me/5586994173635" target="_blank" class="hidden lg:flex items-center group transition-all ml-10 pl-6 border-l border-gray-200 dark:border-slate-800">
            <i class="fa-brands fa-whatsapp text-[#2ecc71] text-2xl mr-3"></i>
            <div class="flex flex-col leading-tight">
                <span style="color: #2ecc71; font-weight: 900;" class="text-[10px] uppercase tracking-[0.15em]">Sugestões</span>
                <span class="text-[15px] font-mono group-hover:text-[#1e40af] transition-colors" 
                      :class="darkMode ? 'text-white' : 'text-black'"
                      style="font-weight: 900;">
                    86 99417-3635
                </span>
            </div>
        </a>
    </div>
</div>