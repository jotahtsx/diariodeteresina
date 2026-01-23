@extends('site.master')

@section('title', 'Diário de Teresina')

@section('content')
    @if (isset($hasLiveGames) && $hasLiveGames)
        <div class="mb-12 flex justify-center px-4">
            <a href="#" class="block w-full max-w-2xl transition-transform active:scale-95 group">
                <div style="border-radius: 25px; background-color: #27ae60;"
                    class="py-4 px-6 shadow-xl shadow-green-900/40 border border-green-400/30 text-center hover:brightness-110 transition-all duration-500 animate-soft-glow">
                    <div class="flex items-center justify-center gap-3">
                        <span class="relative flex h-3 w-3">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-white"></span>
                        </span>
                        <span
                            class="text-white font-black uppercase tracking-[0.12em] text-sm sm:text-base md:text-lg whitespace-nowrap"
                            style="text-shadow: 1px 2px 4px rgba(0,0,0,0.3);">
                            ACOMPANHE O PLACAR DOS JOGOS AO VIVO
                        </span>
                    </div>
                </div>
            </a>
        </div>
    @endif

    <section class="max-w-7xl mx-auto px-4 mb-10 mt-6">
        <div class="flex flex-col items-center">
            <div class="flex items-center gap-4 mb-3 w-full" style="max-width: 970px;">
                <span class="text-[9px] text-slate-500 uppercase tracking-[0.3em] font-bold whitespace-nowrap">
                    Espaço Publicitário
                </span>
                <div class="h-px bg-slate-200 grow opacity-50"></div>
            </div>

            <div style="max-width: 970px; min-height: 90px;"
                class="w-full aspect-970/90 bg-slate-900 border border-slate-800 rounded-2xl flex items-center justify-center overflow-hidden transition-all hover:border-slate-700 group shadow-xl">

                @if (isset($adHeader))
                    <div class="w-full h-full">
                        {!! $adHeader->code !!}
                    </div>
                @else
                    <div
                        class="flex items-center gap-6 px-8 text-slate-500 group-hover:text-slate-300 transition-colors cursor-pointer">
                        <div class="hidden md:block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 opacity-20" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                            </svg>
                        </div>
                        <div class="flex flex-col text-center md:text-left">
                            <span class="text-[11px] font-bold tracking-widest uppercase">Anuncie sua marca aqui</span>
                            <span class="text-[9px] opacity-40 tracking-normal font-medium mt-0.5 uppercase">
                                Posicionamento de Topo — Audiência Qualificada
                            </span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @if (isset($postDestaque))
        <section class="mb-14 mt-10 flex justify-center px-4">
            <div class="max-w-4xl w-full flex flex-col items-center text-center group">
                <div class="mb-5 flex items-center gap-4">
                    <span style="background-color: {{ $postDestaque->category->color ?? '#000' }};"
                        class="text-white font-black text-[11px] px-3 py-1.5 uppercase tracking-[0.2em] border-l-4 border-white/20">
                        {{ $postDestaque->category->name }}
                    </span>
                    <span class="text-slate-500 font-black text-[10px] uppercase tracking-[0.3em]">Destaque do Dia</span>
                </div>
                <a href="{{ route('site.post', $postDestaque->slug) }}" class="block px-2">
                    <h2
                        class="text-3xl md:text-5xl lg:text-5xl font-[950] text-slate-950 leading-none tracking-[-0.03em] transition-colors duration-500 group-hover:text-slate-700">
                        {{ $postDestaque->title }}
                    </h2>
                </a>
                <div class="mt-6">
                    <div
                        class="w-12 h-1 bg-slate-950 transition-all duration-700 group-hover:w-28 group-hover:bg-slate-700">
                    </div>
                </div>
                <p class="mt-5 text-slate-600 text-sm md:text-base max-w-lg font-bold leading-relaxed tracking-tight">
                    {{ Str::limit($postDestaque->content, 160) }}
                </p>
            </div>
        </section>
    @endif

    <div class="max-w-6xl mx-auto px-4 mb-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
            @if (isset($postsPrincipais[0]))
                <div class="group flex flex-col border-b border-slate-100 pb-6">
                    <div class="flex items-center space-x-3 mb-3">
                        <span style="color: {{ $postsPrincipais[0]->category->color ?? '#000' }};"
                            class="text-[18px] font-black tracking-tight">{{ $postsPrincipais[0]->category->name }}</span>
                    </div>
                    <a href="{{ route('site.post', $postsPrincipais[0]->slug) }}"
                        class="relative overflow-hidden mb-5 grow block" style="border-radius: 18px;">
                        <img src="{{ $postsPrincipais[0]->image }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                            style="min-height: 500px;">
                    </a>
                    <h2 class="text-2xl md:text-3xl font-black text-slate-900 leading-tight group-hover:text-slate-700">
                        <a href="{{ route('site.post', $postsPrincipais[0]->slug) }}">{{ $postsPrincipais[0]->title }}</a>
                    </h2>
                    <p class="mt-2 text-slate-500 text-sm leading-relaxed">
                        {{ Str::limit($postsPrincipais[0]->content, 100) }}</p>
                </div>
            @endif

            <div class="flex flex-col justify-between">
                @foreach ($postsPrincipais->skip(1) as $p)
                    <div class="group flex flex-col border-b border-slate-100 pb-6 mb-6">
                        <div class="flex items-center space-x-3 mb-3">
                            <span style="color: {{ $p->category->color ?? '#000' }};"
                                class="text-[18px] font-black tracking-tight">{{ $p->category->name }}</span>
                        </div>
                        <a href="{{ route('site.post', $p->slug) }}" class="relative overflow-hidden mb-4 block"
                            style="border-radius: 18px; height: 240px;">
                            <img src="{{ $p->image }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        </a>
                        <h3 class="text-xl font-black text-slate-800 leading-tight group-hover:text-slate-700">
                            <a href="{{ route('site.post', $p->slug) }}">{{ $p->title }}</a>
                        </h3>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 mb-20 space-y-12">
        @foreach ($postsRestante->take(2) as $h)
            <div class="group flex flex-col md:flex-row gap-8 border-b border-slate-100 pb-12">
                <a href="{{ route('site.post', $h->slug) }}" class="md:w-5/12 block">
                    <div class="relative overflow-hidden" style="border-radius: 18px; height: 320px;">
                        <img src="{{ $h->image }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000">
                    </div>
                </a>
                <div class="md:w-7/12 flex flex-col justify-center">
                    <div class="flex items-center space-x-3 mb-4">
                        <span style="color: {{ $h->category->color ?? '#000' }};"
                            class="text-[18px] font-black tracking-tight">{{ $h->category->name }}</span>
                    </div>
                    <h2
                        class="text-3xl md:text-4xl font-black text-slate-900 leading-[1.1] tracking-tighter group-hover:text-slate-700">
                        <a href="{{ route('site.post', $h->slug) }}">{{ $h->title }}</a>
                    </h2>
                    <p class="mt-4 text-slate-500 text-lg leading-relaxed line-clamp-3">{{ Str::limit($h->content, 180) }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="max-w-6xl mx-auto px-4 mb-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 items-stretch">
            {{-- PUB --}}
            <div class="group flex flex-col h-full bg-slate-50 border border-slate-200 p-5 shadow-sm hover:shadow-md transition-all"
                style="border-radius: 18px;">
                <span class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400">Publicidade</span>
                <div class="grow flex flex-col justify-center items-center text-center space-y-4">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center border border-slate-100"><i
                            class="fa-solid fa-store text-slate-300 text-2xl"></i></div>
                    <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight">Anuncie Aqui</h4>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-200 text-center">
                    <a href="#"
                        class="block w-full py-2 bg-white border border-slate-200 rounded-lg text-[10px] font-black uppercase text-slate-600 group-hover:bg-slate-800 group-hover:text-white transition-all">Ver
                        Planos</a>
                </div>
            </div>
            @foreach ($postsRestante->skip(2)->take(3) as $item)
                <div class="group flex flex-col border-b border-slate-100 pb-4">
                    <div class="mb-3">
                        <span style="color: {{ $item->category->color ?? '#000' }};"
                            class="text-[18px] font-black tracking-tight">{{ $item->category->name }}</span>
                    </div>
                    <a href="{{ route('site.post', $item->slug) }}" class="relative overflow-hidden mb-4 block"
                        style="border-radius: 18px; height: 200px;">
                        <img src="{{ $item->image }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </a>
                    <h3 class="text-lg font-black text-slate-800 group-hover:text-slate-700 line-clamp-3">
                        <a href="{{ route('site.post', $item->slug) }}">{{ $item->title }}</a>
                    </h3>
                </div>
            @endforeach
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 mb-20">
        <div class="flex items-center justify-between mb-8 border-b-2 border-slate-900 pb-4">
            <h2 class="text-xl font-black uppercase tracking-tighter text-slate-800">Notícias das Cidades</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 items-stretch">
            @foreach ($postsCidades as $c)
                <div class="group flex flex-col border-b border-slate-100 pb-6">
                    <div class="mb-3 flex items-center gap-2">
                        <span
                            class="bg-slate-900 text-white px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">
                            {{ $c->city->name }}
                        </span>
                        <span style="color: {{ $c->category->color ?? '#64748b' }};"
                            class="text-[11px] font-black uppercase tracking-tight">
                            {{ $c->category->name }}
                        </span>
                    </div>

                    <a href="{{ route('site.post', $c->slug) }}" class="relative overflow-hidden mb-4 block shadow-sm"
                        style="border-radius: 12px; height: 160px;">
                        <img src="{{ $c->image }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </a>

                    <h2
                        class="text-base font-black text-slate-900 group-hover:text-blue-600 line-clamp-2 leading-tight transition-colors">
                        <a href="{{ route('site.post', $c->slug) }}">{{ $c->title }}</a>
                    </h2>

                    <p class="mt-2 text-slate-500 text-xs line-clamp-2 leading-relaxed">
                        {{ Str::limit($c->content, 90) }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 mb-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 items-stretch">
            <div class="group flex flex-col h-full bg-slate-50 border border-slate-200 p-5 shadow-sm hover:shadow-md transition-all"
                style="border-radius: 18px;">
                <span class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400">Publicidade</span>
                <div class="grow flex flex-col justify-center items-center text-center space-y-4">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center border border-slate-100">
                        <i class="fa-solid fa-store text-slate-300 text-2xl"></i>
                    </div>
                    <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight">Anuncie Aqui</h4>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-200 text-center">
                    <a href="#"
                        class="block w-full py-2 bg-white border border-slate-200 rounded-lg text-[10px] font-black uppercase text-slate-600 group-hover:bg-slate-800 group-hover:text-white transition-all">Ver
                        Planos</a>
                </div>
            </div>
            @foreach ($postsRestante->skip(2)->take(3) as $item)
                <div class="group flex flex-col border-b border-slate-100 pb-4">
                    <div class="mb-3">
                        <span style="color: {{ $item->category->color ?? '#000' }};"
                            class="text-[18px] font-black tracking-tight">{{ $item->category->name }}</span>
                    </div>
                    <a href="{{ route('site.post', $item->slug) }}" class="relative overflow-hidden mb-4 block"
                        style="border-radius: 18px; height: 200px;">
                        <img src="{{ $item->image }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </a>
                    <h3 class="text-lg font-black text-slate-800 group-hover:text-slate-700 line-clamp-3">
                        <a href="{{ route('site.post', $item->slug) }}">{{ $item->title }}</a>
                    </h3>
                </div>
            @endforeach
        </div>
    </div>

    <section class="max-w-7xl mx-auto px-4 mb-14 mt-12">
        <div class="flex flex-col items-center">
            <div class="flex items-center gap-4 mb-4 w-full" style="max-width: 970px;">
                <span class="text-[9px] text-slate-500 uppercase tracking-[0.3em] font-bold whitespace-nowrap">
                    Espaço Publicitário
                </span>
                <div class="h-px bg-slate-800 grow"></div>
            </div>

            <div style="max-width: 970px; min-height: 90px;"
                class="w-full aspect-970/90 bg-slate-900 border border-slate-800 rounded-2xl flex items-center justify-center overflow-hidden transition-all hover:border-slate-700 group shadow-2xl">

                @if (isset($adFooter))
                    <div class="w-full h-full">
                        {!! $adFooter->code !!}
                    </div>
                @else
                    <div class="flex items-center gap-6 px-8 text-slate-500 group-hover:text-slate-300 transition-colors">
                        <div class="hidden md:block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 opacity-20" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[11px] font-bold tracking-widest uppercase">Anuncie no Diário de
                                Teresina</span>
                            <span class="text-[9px] opacity-40 tracking-normal font-medium mt-0.5 uppercase">
                                Formato Premium 970x90 — Comercial
                            </span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>


    <style>
        @keyframes soft-glow {

            0%,
            100% {
                transform: scale(1);
                filter: brightness(1);
            }

            50% {
                transform: scale(1.02);
                filter: brightness(1.15);
            }
        }

        .animate-soft-glow {
            animation: soft-glow 3s ease-in-out infinite;
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
@endsection
