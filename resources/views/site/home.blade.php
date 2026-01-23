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

    {{-- 2. BANNER PUBLICIDADE TOPO --}}
    <div class="mb-12 flex justify-center px-4">
        <div class="w-full" style="max-width: 970px;">
            <div style="height: 90px;"
                class="w-full bg-[#1E293B] border border-slate-700 flex items-center justify-between px-10 group hover:bg-[#0F172A] transition-all duration-500 shadow-xl text-center">
                <span
                    class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-500 group-hover:text-slate-400 transition-colors">Publicidade</span>
                <div class="flex items-center space-x-2">
                    <span
                        class="text-white/20 group-hover:text-white/60 font-bold text-sm font-mono tracking-tighter transition-all">970
                        x 90</span>
                </div>
                <div class="text-slate-500 group-hover:text-white transition-colors">
                    <i class="fa-solid fa-circle-info text-xs"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. NOTÍCIA DE DESTAQUE CENTRALIZADA --}}
    <section class="mb-14 mt-10 flex justify-center px-4">
        <div class="max-w-4xl w-full flex flex-col items-center text-center group cursor-pointer">

            {{-- Badge Dark --}}
            <div class="mb-5 flex items-center gap-4">
                <span
                    class="bg-slate-950 text-white font-black text-[11px] px-3 py-1.5 uppercase tracking-[0.2em] border-l-4 border-red-700">
                    Polícia
                </span>
                <span class="text-slate-500 font-black text-[10px] uppercase tracking-[0.3em]">
                    Destaque do Dia
                </span>
            </div>

            <a href="#" class="block px-2 group">
                {{-- Trocado leading-[1.0] por leading-none para remover o warning --}}
                <h2
                    class="text-3xl md:text-5xl lg:text-5xl font-[950] text-slate-950 leading-none tracking-[-0.03em] transition-colors duration-500 group-hover:text-slate-700">
                    Polícia Civil indicia funcionários da Cacique Pneus por furto
                </h2>
            </a>

            {{-- Linha de Separação (Sutil) --}}
            <div class="mt-6">
                <div class="w-12 h-1 bg-slate-950 transition-all duration-700 group-hover:w-28 group-hover:bg-slate-700">
                </div>
            </div>

            {{-- Subtítulo: Dark Soft (Slate-600) --}}
            <p class="mt-5 text-slate-600 text-sm md:text-base max-w-lg font-bold leading-relaxed tracking-tight">
                Investigações apontam esquema interno que causou prejuízo superior a R$ 200 mil à empresa.
            </p>
        </div>
    </section>

    {{-- 4. GRID PRINCIPAL --}}
    <div class="max-w-6xl mx-auto px-4 mb-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
            <div class="group cursor-pointer flex flex-col border-b border-slate-100 pb-6">
                <div class="flex items-center space-x-3 mb-3">
                    <span class="text-[18px] font-black text-slate-800 tracking-tight">Novo cargo</span>
                    <i class="fa-solid fa-link text-slate-300 group-hover:text-slate-800 transition-colors text-sm"></i>
                </div>
                <div class="relative overflow-hidden mb-5 grow" style="border-radius: 18px;">
                    <div class="w-full h-full bg-slate-200 group-hover:scale-105 transition-transform duration-700 flex items-center justify-center"
                        style="min-height: 500px;">
                        <i class="fa-regular fa-image text-slate-400 text-6xl"></i>
                    </div>
                </div>
                <h2
                    class="text-2xl md:text-3xl font-black text-slate-900 leading-tight tracking-tight group-hover:text-slate-700">
                    Chico Lucas é confirmado como Secretário Nacional de Segurança
                </h2>
                <p class="mt-2 text-slate-500 text-sm leading-relaxed">
                    A indicação foi feita pelo Conselho Nacional de Secretários de Segurança Pública.
                </p>
            </div>

            <div class="flex flex-col justify-between">
                @php
                    $tops = [
                        [
                            'cat' => 'Entrevista',
                            'title' => 'DHPP concluiu 114 inquéritos com indiciamento em 2025, diz delegado',
                        ],
                        [
                            'cat' => 'Instrução',
                            'title' => 'Justiça marca audiência do acusado de matar filho de vice-prefeito',
                        ],
                    ];
                @endphp
                @foreach ($tops as $t)
                    <div class="group cursor-pointer flex flex-col border-b border-slate-100 pb-6 mb-6">
                        <div class="flex items-center space-x-3 mb-3">
                            <span class="text-[18px] font-black text-slate-800 tracking-tight">{{ $t['cat'] }}</span>
                            <i
                                class="fa-solid fa-link text-slate-300 group-hover:text-slate-800 transition-colors text-sm"></i>
                        </div>
                        <div class="relative overflow-hidden mb-4" style="border-radius: 18px; height: 240px;">
                            <div
                                class="w-full h-full bg-slate-200 group-hover:scale-105 transition-transform duration-700 flex items-center justify-center">
                                <i class="fa-regular fa-image text-slate-400 text-4xl"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-black text-slate-800 leading-tight group-hover:text-slate-700">
                            {{ $t['title'] }}</h3>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- HORIZONTAIS --}}
    <div class="max-w-6xl mx-auto px-4 mb-20 space-y-12">
        @php
            $horizontals = [
                [
                    'cat' => 'Economia',
                    'title' => 'PIB do Piauí cresce acima da média nacional e atrai novos investimentos',
                    'desc' => 'Dados recentes mostram que a economia local tem se diversificado.',
                ],
                [
                    'cat' => 'Cultura',
                    'title' => 'Festival de Inverno em Teresina confirma atrações nacionais para 2026',
                    'desc' => 'O evento promete movimentar o setor hoteleiro e cultural da capital.',
                ],
            ];
        @endphp
        @foreach ($horizontals as $h)
            <div class="group cursor-pointer flex flex-col md:flex-row gap-8 border-b border-slate-100 pb-12">
                <div class="md:w-5/12">
                    <div class="relative overflow-hidden" style="border-radius: 18px; height: 320px;">
                        <div
                            class="w-full h-full bg-slate-200 group-hover:scale-105 transition-transform duration-1000 flex items-center justify-center">
                            <i class="fa-regular fa-image text-slate-400 text-5xl"></i>
                        </div>
                    </div>
                </div>
                <div class="md:w-7/12 flex flex-col justify-center">
                    <div class="flex items-center space-x-3 mb-4">
                        <span class="text-[18px] font-black text-slate-800 tracking-tight">{{ $h['cat'] }}</span>
                        <i class="fa-solid fa-link text-slate-300 group-hover:text-slate-800 transition-colors text-sm"></i>
                    </div>
                    <h2
                        class="text-3xl md:text-4xl font-black text-slate-900 leading-[1.1] tracking-tighter group-hover:text-slate-700">
                        {{ $h['title'] }}</h2>
                    <p class="mt-4 text-slate-500 text-lg leading-relaxed line-clamp-3">{{ $h['desc'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    {{-- 5. BLOCO 4 COLUNAS (PUB + NOTÍCIAS) --}}
    <div class="max-w-6xl mx-auto px-4 mb-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 items-stretch">
            <div class="group cursor-pointer flex flex-col h-full bg-slate-50 border border-slate-200 p-5 shadow-sm hover:shadow-md transition-all"
                style="border-radius: 18px;">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400">Publicidade</span>
                    <i class="fa-solid fa-circle-info text-slate-300 text-[10px]"></i>
                </div>
                <div class="grow flex flex-col justify-center items-center text-center space-y-4">
                    <div
                        class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-sm border border-slate-100">
                        <i class="fa-solid fa-store text-slate-300 text-2xl"></i>
                    </div>
                    <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight">Anuncie Aqui</h4>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-200">
                    <span
                        class="block w-full text-center py-2 bg-white border border-slate-200 rounded-lg text-[10px] font-black uppercase tracking-widest text-slate-600 group-hover:bg-slate-800 group-hover:text-white transition-all">Ver
                        Planos</span>
                </div>
            </div>

            @php
                $newsGrid = [
                    [
                        'cat' => 'Serviço',
                        'title' => 'Detran-PI alerta para prazos de renovação da CNH em março de 2026',
                    ],
                    [
                        'cat' => 'Meio Ambiente',
                        'title' => 'Nível do Rio Poti segue estável e monitoramento da Defesa Civil continua',
                    ],
                    [
                        'cat' => 'Entretenimento',
                        'title' => 'Teatro 4 de Setembro recebe espetáculo premiado neste final de semana',
                    ],
                ];
            @endphp
            @foreach ($newsGrid as $item)
                <div class="group cursor-pointer flex flex-col border-b border-slate-100 pb-4">
                    <div class="flex items-center space-x-3 mb-3">
                        <span class="text-[18px] font-black text-slate-800 tracking-tight">{{ $item['cat'] }}</span>
                        <i class="fa-solid fa-link text-slate-300 group-hover:text-slate-800 transition-colors text-xs"></i>
                    </div>
                    <div class="relative overflow-hidden mb-4" style="border-radius: 18px; height: 200px;">
                        <div
                            class="w-full h-full bg-slate-200 group-hover:scale-110 transition-transform duration-700 flex items-center justify-center">
                            <i class="fa-regular fa-image text-slate-400 text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="text-lg font-black text-slate-800 leading-tight group-hover:text-slate-700 line-clamp-3">
                        {{ $item['title'] }}</h3>
                </div>
            @endforeach
        </div>
    </div>

    {{-- 7. BLOCO DUPLO PREMIUM --}}
    <div class="max-w-6xl mx-auto px-4 mb-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-stretch">
            @php
                $premium = [
                    [
                        'cat' => 'Inovação',
                        'title' => 'Energia Solar: Piauí se consolida como líder na geração de energia limpa',
                    ],
                    [
                        'cat' => 'Gastronomia',
                        'title' => 'Festival Gastronômico de Teresina celebra a culinária regional',
                    ],
                ];
            @endphp
            @foreach ($premium as $p)
                <div class="group cursor-pointer flex flex-col border-b border-slate-100 pb-8">
                    <div class="flex items-center space-x-3 mb-3">
                        <span class="text-[18px] font-black text-slate-800 tracking-tight">{{ $p['cat'] }}</span>
                        <i class="fa-solid fa-link text-slate-300 group-hover:text-slate-800 transition-colors text-sm"></i>
                    </div>
                    <div class="relative overflow-hidden mb-5" style="border-radius: 18px; height: 280px;">
                        <div
                            class="w-full h-full bg-slate-200 group-hover:scale-105 transition-transform duration-1000 flex items-center justify-center">
                            <i class="fa-regular fa-image text-slate-400 text-5xl"></i>
                        </div>
                    </div>
                    <h2
                        class="text-xl md:text-2xl font-black text-slate-900 leading-tight tracking-tight group-hover:text-slate-700 line-clamp-2 min-h-14">
                        {{ $p['title'] }}</h2>
                </div>
            @endforeach
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 mb-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 items-stretch">
            <div class="group cursor-pointer flex flex-col h-full bg-slate-50 border border-slate-200 p-5 shadow-sm hover:shadow-md transition-all"
                style="border-radius: 18px;">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400">Publicidade</span>
                    <i class="fa-solid fa-circle-info text-slate-300 text-[10px]"></i>
                </div>
                <div class="grow flex flex-col justify-center items-center text-center space-y-4">
                    <div
                        class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-sm border border-slate-100">
                        <i class="fa-solid fa-store text-slate-300 text-2xl"></i>
                    </div>
                    <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight">Anuncie Aqui</h4>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-200">
                    <span
                        class="block w-full text-center py-2 bg-white border border-slate-200 rounded-lg text-[10px] font-black uppercase tracking-widest text-slate-600 group-hover:bg-slate-800 group-hover:text-white transition-all">Ver
                        Planos</span>
                </div>
            </div>

            @php
                $newsGrid = [
                    [
                        'cat' => 'Serviço',
                        'title' => 'Detran-PI alerta para prazos de renovação da CNH em março de 2026',
                    ],
                    [
                        'cat' => 'Meio Ambiente',
                        'title' => 'Nível do Rio Poti segue estável e monitoramento da Defesa Civil continua',
                    ],
                    [
                        'cat' => 'Entretenimento',
                        'title' => 'Teatro 4 de Setembro recebe espetáculo premiado neste final de semana',
                    ],
                ];
            @endphp
            @foreach ($newsGrid as $item)
                <div class="group cursor-pointer flex flex-col border-b border-slate-100 pb-4">
                    <div class="flex items-center space-x-3 mb-3">
                        <span class="text-[18px] font-black text-slate-800 tracking-tight">{{ $item['cat'] }}</span>
                        <i
                            class="fa-solid fa-link text-slate-300 group-hover:text-slate-800 transition-colors text-xs"></i>
                    </div>
                    <div class="relative overflow-hidden mb-4" style="border-radius: 18px; height: 200px;">
                        <div
                            class="w-full h-full bg-slate-200 group-hover:scale-110 transition-transform duration-700 flex items-center justify-center">
                            <i class="fa-regular fa-image text-slate-400 text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="text-lg font-black text-slate-800 leading-tight group-hover:text-slate-700 line-clamp-3">
                        {{ $item['title'] }}</h3>
                </div>
            @endforeach
        </div>
    </div>

    {{-- 8. CIDADES --}}
    <div class="max-w-6xl mx-auto px-4 mb-20">
        <div class="flex items-center justify-between mb-8 border-b-2 border-slate-900 pb-4">
            <h2 class="text-xl font-black uppercase tracking-tighter text-slate-800">Notícias das Cidades</h2>
            <a href="#"
                class="text-[10px] font-black text-slate-400 hover:text-slate-900 uppercase tracking-[0.2em] transition-colors">Ver
                todas</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 items-stretch">
            @php
                $cities = [
                    [
                        'n' => 'Piauí',
                        'i' => 'fa-map-location-dot',
                        't' => 'Estado anuncia novos investimentos em infraestrutura',
                        'd' => 'Obras devem iniciar no primeiro semestre contemplando rodovias.',
                    ],
                    [
                        'n' => 'Esperantina',
                        'i' => 'fa-city',
                        't' => 'Festival do Peixe confirma datas e atrações',
                        'd' => 'Evento tradicional movimenta a economia do norte do estado.',
                    ],
                    [
                        'n' => 'Corrente',
                        'i' => 'fa-tractor',
                        't' => 'Agronegócio: Safra 2026 deve bater novos recordes',
                        'd' => 'Produtores do extremo sul celebram condições climáticas favoráveis.',
                    ],
                    [
                        'n' => 'Parnaíba',
                        'i' => 'fa-umbrella-beach',
                        't' => 'Porto de Parnaíba recebe novos investimentos',
                        'd' => 'Novos terminais devem ampliar a capacidade de exportação da região.',
                    ],
                ];
            @endphp
            @foreach ($cities as $c)
                <div class="group cursor-pointer flex flex-col border-b border-slate-100 pb-6">
                    <div class="flex items-center space-x-3 mb-3">
                        <span class="text-[18px] font-black text-slate-800 tracking-tight">{{ $c['n'] }}</span>
                        <i
                            class="fa-solid fa-link text-slate-300 group-hover:text-slate-800 transition-colors text-xs"></i>
                    </div>
                    <div class="relative overflow-hidden mb-4" style="border-radius: 18px; height: 180px;">
                        <div
                            class="w-full h-full bg-slate-200 group-hover:scale-105 transition-transform duration-1000 flex items-center justify-center">
                            <i class="fa-solid {{ $c['i'] }} text-slate-400 text-3xl"></i>
                        </div>
                    </div>
                    <h2
                        class="text-base font-black text-slate-900 leading-tight tracking-tight group-hover:text-slate-700 line-clamp-2">
                        {{ $c['t'] }}
                    </h2>
                    <p class="mt-2 text-slate-500 text-xs leading-relaxed line-clamp-2">
                        {{ $c['d'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mb-12 flex justify-center px-4">
        <div class="w-full" style="max-width: 970px;">
            <div style="height: 90px;"
                class="w-full bg-[#1E293B] border border-slate-700 flex items-center justify-between px-10 group hover:bg-[#0F172A] transition-all duration-500 shadow-xl text-center">
                <span
                    class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-500 group-hover:text-slate-400 transition-colors">Publicidade</span>
                <div class="flex items-center space-x-2">
                    <span
                        class="text-white/20 group-hover:text-white/60 font-bold text-sm font-mono tracking-tighter transition-all">970
                        x 90</span>
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
