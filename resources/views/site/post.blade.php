@extends('site.master')
@section('title', $post->title . ' - Diário de Teresina')

@section('content')
    <section class="max-w-7xl mx-auto px-4 mb-10 mt-6">
        <div class="flex flex-col items-center">
            <div class="flex items-center gap-4 mb-3 w-full" style="max-width: 970px;">
                <span class="text-[9px] text-slate-500 uppercase tracking-[0.3em] font-bold whitespace-nowrap">Espaço
                    Publicitário</span>
                <div class="h-px bg-slate-200 grow opacity-50"></div>
            </div>
            <div style="max-width: 970px; min-height: 90px;"
                class="w-full aspect-970/90 bg-slate-900 border border-slate-800 rounded-2xl flex items-center justify-center overflow-hidden transition-all hover:border-slate-700 group shadow-xl">
                @if (isset($adHeader))
                    <div class="w-full h-full">{!! $adHeader->code !!}</div>
                @else
                    <div
                        class="flex items-center gap-6 px-8 text-slate-500 group-hover:text-slate-300 transition-colors cursor-pointer text-center md:text-left">
                        <div class="hidden md:block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 opacity-20" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[11px] font-bold tracking-widest uppercase">Anuncie sua marca aqui</span>
                            <span class="text-[9px] opacity-40 tracking-normal font-medium mt-0.5 uppercase">Posicionamento
                                de Topo — Audiência Qualificada</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <article class="container mx-auto px-4 max-w-4xl py-10">
        <header class="mb-10 text-center">
            {{-- Eyebrow / Breadcrumb --}}
            <div class="flex items-center justify-center gap-3 mb-6">
                <a href="{{ route('site.home') }}"
                    class="text-[13px] font-bold text-gray-400 hover:text-red-600 transition">HOME</a>
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                <span class="bg-red-50 text-red-600 px-3 py-1 rounded-full text-[13px] font-bold uppercase tracking-wider">
                    {{ $post->category->name }}
                </span>
            </div>

            {{-- Título Impactante (Soft Style) --}}
            <h1
                class="text-3xl md:text-5xl lg:text-5xl font-[950] text-slate-950 leading-none tracking-[-0.03em] transition-colors duration-500 group-hover:text-slate-700">
                {{ $post->title }}
            </h1>

            {{-- Info do Autor e Data --}}
            <div
                class="flex flex-col md:flex-row items-center justify-center text-gray-500 text-[15px] gap-4 border-y border-gray-100 py-6">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-gray-100 border border-gray-200 rounded-full flex items-center justify-center font-bold text-red-600">
                        {{ substr($post->author->name ?? 'R', 0, 1) }}
                    </div>
                    <span class="text-gray-900">Por <strong
                            class="font-bold">{{ $post->author->name ?? 'Redação' }}</strong></span>
                </div>
                <span class="hidden md:block text-gray-300">|</span>
                <div class="flex items-center gap-4 text-gray-500">
                    <time datetime="{{ $post->created_at }}">{{ $post->created_at->format('d/m/Y \à\s H:i') }}</time>
                    <span class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        {{ $post->views }}
                    </span>
                </div>
            </div>
        </header>

        {{-- Imagem de Capa com Rounded Soft --}}
        @if ($post->image)
            <div class="mb-12">
                <img src="{{ $post->image }}" class="w-full rounded-[25px] shadow-sm object-cover max-h-[550px]"
                    alt="{{ $post->title }}">
                @if ($post->image_caption)
                    <p class="text-center text-sm text-gray-400 mt-4 italic">{{ $post->image_caption }}</p>
                @endif
            </div>
        @endif

        {{-- Conteúdo da Notícia --}}
        <div class="max-w-3xl mx-auto">
            <div class="text-gray-800 leading-[1.8] text-lg md:text-xl font-light space-y-6">
                {!! nl2br($post->content) !!}
            </div>

            {{-- Footer da Notícia / Share --}}
            <div class="mt-16 p-10 bg-[#fbfbfb] border border-gray-100 rounded-[25px] text-center">
                <h4 class="text-xl font-[950] mb-2 text-gray-900">Gostou desta notícia?</h4>
                <p class="text-gray-500 mb-8">Compartilhe o que acontece em <strong>{{ $post->city->name }}</strong> com
                    seus amigos.</p>

                <div class="flex flex-wrap justify-center gap-4">
                    <a href="#"
                        class="bg-[#25D366] text-white px-8 py-3 rounded-full font-bold hover:opacity-90 transition flex items-center gap-2">
                        WhatsApp
                    </a>
                    <a href="{{ route('site.home') }}"
                        class="bg-gray-900 text-white px-8 py-3 rounded-full font-bold hover:bg-black transition">
                        Voltar para o Início
                    </a>
                </div>
            </div>
        </div>
    </article>
@endsection
