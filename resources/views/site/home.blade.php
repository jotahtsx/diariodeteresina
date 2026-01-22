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
            {{-- Categoria --}}
            <div class="mb-6">
                <span
                    class="bg-slate-100 text-slate-500 font-mono font-black text-[11px] uppercase tracking-[0.3em] px-5 py-2 rounded-full group-hover:bg-[#EA2027] group-hover:text-white transition-all duration-300 shadow-sm">
                    Polícia
                </span>
            </div>

            {{-- Manchete --}}
            <a href="#" class="block px-2">
                <h2
                    class="text-3xl md:text-5xl lg:text-6xl font-[900] text-slate-900 leading-[1.05] tracking-tighter group-hover:text-[#EA2027] transition-colors duration-300">
                    Polícia Civil indicia funcionários da Cacique Pneus por furto
                </h2>
            </a>

            {{-- Detalhe Decorativo --}}
            <div class="mt-10">
                <div
                    class="w-20 h-1.5 bg-slate-200 rounded-full group-hover:w-32 group-hover:bg-[#EA2027] transition-all duration-500">
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-6xl mx-auto px-4 mb-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- NOTÍCIA GRANDE (Ocupa 2 colunas no Desktop) --}}
            <div class="lg:col-span-2 group cursor-pointer">
                <div class="relative overflow-hidden mb-4" style="border-radius: 25px;">
                    {{-- Placeholder da Imagem Grande --}}
                    <div
                        class="aspect-video bg-slate-200 group-hover:scale-105 transition-transform duration-700 flex items-center justify-center">
                        <i class="fa-regular fa-image text-slate-400 text-5xl"></i>
                    </div>
                    {{-- Badge de Categoria Flutuante --}}
                    <span
                        class="absolute top-4 left-4 bg-[#EA2027] text-white font-mono font-black text-[10px] uppercase tracking-wider px-3 py-1 rounded-full shadow-lg">
                        Destaque
                    </span>
                </div>
                <h3
                    class="text-2xl md:text-3xl font-[900] text-slate-900 leading-tight tracking-tighter group-hover:text-[#EA2027] transition-colors">
                    Título da Notícia Principal com Imagem Grande Ocupando Duas Colunas
                </h3>
                <p class="mt-3 text-slate-500 line-clamp-2 text-sm md:text-base">
                    Aqui vai um breve resumo da notícia para instigar o clique, mantendo a elegância e o estilo soft do
                    Diário de Teresina.
                </p>
            </div>

            {{-- COLUNA LATERAL (2 Notícias Menores) --}}
            <div class="flex flex-col gap-8">

                {{-- Notícia Menor 1 --}}
                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden mb-3" style="border-radius: 20px;">
                        <div
                            class="aspect-[16/9] bg-slate-200 group-hover:scale-105 transition-transform duration-700 flex items-center justify-center">
                            <i class="fa-regular fa-image text-slate-400 text-3xl"></i>
                        </div>
                    </div>
                    <h4
                        class="text-lg font-bold text-slate-800 leading-snug tracking-tight group-hover:text-[#EA2027] transition-colors line-clamp-2">
                        Título da notícia secundária número um com imagem
                    </h4>
                </div>

                {{-- Notícia Menor 2 --}}
                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden mb-3" style="border-radius: 20px;">
                        <div
                            class="aspect-[16/9] bg-slate-200 group-hover:scale-105 transition-transform duration-700 flex items-center justify-center">
                            <i class="fa-regular fa-image text-slate-400 text-3xl"></i>
                        </div>
                    </div>
                    <h4
                        class="text-lg font-bold text-slate-800 leading-snug tracking-tight group-hover:text-[#EA2027] transition-colors line-clamp-2">
                        Segunda notícia da lateral com o mesmo padrão visual
                    </h4>
                </div>

            </div>
        </div>
    </div>

    {{-- 4. Listagem de Notícias --}}
    <div class="max-w-6xl mx-auto px-4 mb-10">
        <h3 class="text-xl font-[900] text-slate-800 mb-8 tracking-tighter uppercase flex items-center">
            <span class="w-2 h-6 bg-[#EA2027] mr-3 rounded-full"></span>
            Mais Notícias
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($posts as $post)
                <div
                    class="p-6 bg-white border border-slate-100 hover:border-slate-200 hover:shadow-md transition-all cursor-pointer rounded-[25px]">
                    <p class="text-slate-700 font-bold text-lg leading-tight group-hover:text-[#EA2027]">
                        {{ $post->title }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- CSS de Animação --}}
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
