@extends('site.master')

@section('title', 'Diário de Teresina')

@section('content')
    {{-- 1. Banner Placar Ao Vivo --}}
    <div class="mb-12 flex justify-center px-4">
        <a href="#" class="block w-full max-w-2xl transition-transform active:scale-95">
            <div style="border-radius: 25px; background-color: #2ecc71;"
                class="py-4 px-6 shadow-lg shadow-green-200/60 border border-green-400/20 text-center animate-pulse-fast">
                <span
                    class="text-white font-[900] uppercase tracking-[0.12em] text-sm sm:text-base md:text-lg whitespace-nowrap"
                    style="text-shadow: 1px 1px 3px rgba(0,0,0,0.3);">
                    ACOMPANHE O PLACAR DOS JOGOS AO VIVO
                </span>
            </div>
        </a>
    </div>

    {{-- 2. Espaço Publicitário Dark --}}
    <div class="mb-12 flex justify-center px-4">
        <div class="w-full max-w-[970px]">
            <div style="border-radius: 12px;"
                class="w-full h-[90px] bg-[#1E293B] border border-slate-700 flex items-center justify-between px-10 group hover:bg-[#0F172A] transition-all duration-500 shadow-xl">
                <span
                    class="text-[9px] font-[900] uppercase tracking-[0.3em] text-slate-500 group-hover:text-slate-400 transition-colors">
                    Publicidade
                </span>
                <div class="flex items-center space-x-2">
                    <span
                        class="text-white/20 group-hover:text-white/60 font-bold text-sm font-mono tracking-tighter transition-all"
                        style="text-shadow: 0 0 10px rgba(255,255,255,0.1);">
                        970 x 90
                    </span>
                </div>
                <div class="text-slate-500 group-hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. Notícia de Destaque Centralizada --}}
    <section class="mb-20 mt-12 flex justify-center px-4">
        <div class="max-w-4xl w-full flex flex-col items-center text-center group cursor-pointer">
            {{-- Categoria com Hover Cinza Escuro --}}
            <div class="mb-6">
                <span
                    class="bg-slate-100 text-slate-500 font-mono font-black text-[11px] uppercase tracking-[0.3em] px-5 py-2 rounded-full group-hover:bg-slate-800 group-hover:text-white transition-all duration-300 shadow-sm">
                    Polícia
                </span>
            </div>

            {{-- Manchete com Hover Cinza Escuro --}}
            <a href="#" class="block px-2">
                <h2
                    class="text-3xl md:text-5xl lg:text-6xl font-[900] text-slate-900 leading-[1.05] tracking-tighter group-hover:text-slate-700 transition-colors duration-300">
                    Polícia Civil indicia funcionários da Cacique Pneus por furto
                </h2>
            </a>

            {{-- Detalhe Decorativo em Cinza --}}
            <div class="mt-10">
                <div
                    class="w-20 h-1.5 bg-slate-200 rounded-full group-hover:w-32 group-hover:bg-slate-800 transition-all duration-500">
                </div>
            </div>
        </div>
    </section>

    {{-- Grid de Notícias - Estilo High-Impact --}}
    <div class="max-w-6xl mx-auto px-4 mb-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">

            {{-- COLUNA ESQUERDA (Notícia Vertical) --}}
            <div class="group cursor-pointer flex flex-col border-b border-slate-100 pb-6">
                {{-- Categoria + Ícone (Igual à imagem) --}}
                <div class="flex items-center space-x-2 mb-3">
                    <span class="text-[12px] font-bold text-sky-500 hover:underline">Novo cargo</span>
                    <i class="fa-solid fa-share-nodes text-sky-500 text-[10px]"></i>
                </div>

                {{-- Imagem Vertical (Aspect Ratio 3/4 ou similar) --}}
                <div class="relative overflow-hidden mb-5 flex-grow" style="border-radius: 12px;">
                    <div
                        class="w-full h-full bg-slate-200 group-hover:scale-105 transition-transform duration-700 flex items-center justify-center min-h-[500px]">
                        <i class="fa-regular fa-image text-slate-400 text-6xl"></i>
                    </div>
                </div>

                <h2
                    class="text-2xl md:text-3xl font-[900] text-slate-900 leading-tight tracking-tight group-hover:text-slate-700">
                    Chico Lucas é confirmado como Secretário Nacional de Segurança
                </h2>
                <p class="mt-2 text-slate-500 text-sm leading-relaxed">
                    A indicação foi feita pelo Conselho Nacional de Secretários de Segurança Pública.
                </p>
            </div>

            {{-- COLUNA DIREITA (Duas Notícias Empilhadas) --}}
            <div class="flex flex-col justify-between">

                {{-- Notícia Topo Direita --}}
                <div class="group cursor-pointer flex flex-col border-b border-slate-100 pb-6 mb-6">
                    <div class="flex items-center space-x-2 mb-3">
                        <span class="text-[12px] font-bold text-sky-500">Entrevista</span>
                        <i class="fa-solid fa-share-nodes text-sky-500 text-[10px]"></i>
                    </div>
                    <div class="relative overflow-hidden mb-4 h-[240px]" style="border-radius: 12px;">
                        <div
                            class="w-full h-full bg-slate-200 group-hover:scale-105 transition-transform duration-700 flex items-center justify-center">
                            <i class="fa-regular fa-image text-slate-400 text-4xl"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 leading-tight group-hover:text-slate-700">
                        DHPP concluiu 114 inquéritos com indiciamento em 2025, diz delegado
                    </h3>
                    <div class="flex items-center mt-2 space-x-1">
                        <span class="w-1.5 h-1.5 bg-sky-500 rounded-full"></span>
                        <p class="text-xs text-slate-500">Polícia Civil indicia funcionários da Cacique Pneus por furto</p>
                    </div>
                </div>

                {{-- Notícia Base Direita --}}
                <div class="group cursor-pointer flex flex-col border-b border-slate-100 pb-6">
                    <div class="flex items-center space-x-2 mb-3">
                        <span class="text-[12px] font-bold text-sky-500">Instrução</span>
                        <i class="fa-solid fa-share-nodes text-sky-500 text-[10px]"></i>
                    </div>
                    <div class="relative overflow-hidden mb-4 h-[240px]" style="border-radius: 12px;">
                        <div
                            class="w-full h-full bg-slate-200 group-hover:scale-105 transition-transform duration-700 flex items-center justify-center">
                            <i class="fa-regular fa-image text-slate-400 text-4xl"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 leading-tight group-hover:text-slate-700">
                        Justiça marca audiência do acusado de matar filho de vice-prefeito
                    </h3>
                    <p class="mt-2 text-xs text-slate-500">
                        A sessão para ouvir o réu, testemunhas, defesa e acusação foi agendada para 26 de março de 2026.
                    </p>
                </div>

            </div>
        </div>
    </div>

    {{-- Estilos de Animação mantidos --}}
    <style>
        @keyframes pulse-fast {

            0%,
            100% {
                transform: scale(1);
                filter: brightness(1);
            }

            50% {
                transform: scale(1.03);
                filter: brightness(1.1);
            }
        }

        .animate-pulse-fast {
            animation: pulse-fast 0.8s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
@endsection
