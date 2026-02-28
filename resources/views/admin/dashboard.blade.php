@extends('admin.master')

@section('content')
<div class="space-y-8 animate-soft-entry">
    {{-- Header --}}
    <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-8">
        <div class="flex items-center gap-4">
            {{-- Barra: Preta no light, Azul no dark --}}
            <div class="h-12 w-1.5 bg-slate-900 dark:bg-portal-blue rounded-full"></div>
            <div>
                <h1 class="text-4xl font-[1000] text-slate-900 dark:text-white tracking-tighter uppercase leading-none">
                    Dashboard
                </h1>
                <p class="text-slate-500 dark:text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mt-2">
                    Painel de Controle Principal
                </p>
            </div>
        </div>

        <div class="text-right hidden sm:block bg-white dark:bg-slate-900 px-6 py-3 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm">
            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest block mb-1">Status do Sistema</span>
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                <span class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-tighter">{{ now()->format('d . m . Y') }}</span>
            </div>
        </div>
    </div>

    {{-- Grid de Stats (Hover Removido) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-sm overflow-hidden rounded-2xl">
        @php
            $cards = [
                ['label' => 'Total de Notícias', 'value' => '1.240', 'icon' => 'fa-newspaper'],
                ['label' => 'Visualizações Totais', 'value' => '85.4k', 'icon' => 'fa-eye'],
                ['label' => 'Cidades Ativas', 'value' => '12', 'icon' => 'fa-location-dot'],
            ];
        @endphp

        @foreach($cards as $card)
            <div class="p-8 {{ !$loop->last ? 'border-r border-slate-200 dark:border-slate-800' : '' }}">
                <div class="flex justify-between items-start">
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-portal-blue">
                        {{ $card['label'] }}
                    </span>
                    <i class="fa-solid {{ $card['icon'] }} text-slate-300 dark:text-slate-700 text-xl"></i>
                </div>
                <div class="mt-4">
                    <span class="text-4xl font-[1000] text-slate-900 dark:text-white tracking-tighter">
                        {{ $card['value'] }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection