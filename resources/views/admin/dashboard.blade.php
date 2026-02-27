@extends('admin.master')

@section('content')
<div class="space-y-8 animate-soft-entry">
    <div>
        <h1 class="text-2xl font-[950] text-slate-900 dark:text-white tracking-tight">Dashboard</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Bem-vindo ao painel do Diário de Teresina.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @php
            $cards = [
                ['label' => 'Total de Notícias', 'value' => '1.240'],
                ['label' => 'Visualizações Totais', 'value' => '85.4k'],
                ['label' => 'Cidades Ativas', 'value' => '12'],
            ];
        @endphp

        @foreach($cards as $card)
            <div class="bg-white dark:bg-slate-900 p-6 rounded-[25px] border border-slate-100 dark:border-slate-800 shadow-sm transition-all">
                {{-- Label com cor forte no light --}}
                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">
                    {{ $card['label'] }}
                </span>
                <div class="flex items-end gap-2 mt-2">
                    {{-- Valor forçado em slate-900 no light --}}
                    <span class="text-3xl font-[950] text-slate-900 dark:text-white">
                        {{ $card['value'] }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Lista de Recentes --}}
    <div class="bg-white dark:bg-slate-900 rounded-[30px] border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden transition-colors">
        <div class="p-6 border-b border-slate-50 dark:border-slate-800 flex justify-between items-center">
            <h2 class="text-sm font-black uppercase tracking-widest text-slate-800 dark:text-white">Postagens Recentes</h2>
            <a href="#" class="text-xs font-bold text-portal-blue dark:text-blue-400 hover:underline">Ver todas</a>
        </div>
        <div class="p-12 text-center">
            <div class="w-16 h-16 bg-slate-50 dark:bg-slate-800 rounded-2xl mx-auto mb-4 flex items-center justify-center">
                <span class="text-2xl">📁</span>
            </div>
            <p class="text-slate-400 dark:text-slate-500 text-sm font-bold">Nenhum post encontrado para exibição.</p>
        </div>
    </div>
</div>
@endsection