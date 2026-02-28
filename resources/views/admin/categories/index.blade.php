@extends('admin.master')

@section('content')
<div class="space-y-6">
    {{-- Topo com Título e Botão de Criar --}}
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-4xl font-[1000] text-slate-900 dark:text-white uppercase tracking-tighter leading-none">Categorias</h2>
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 dark:text-slate-400 mt-2">Gerencie as seções do seu portal</p>
        </div>
        
        <a href="{{ route('admin.categories.create') }}" class="px-6 py-3 bg-slate-900 dark:bg-portal-blue text-white rounded-lg font-black uppercase tracking-widest text-xs shadow-md active:scale-95 flex items-center gap-2 transition-transform">
            <i class="fa-solid fa-plus"></i> Nova Categoria
        </a>
    </div>

    {{-- Sistema de Alertas (Informa por que não deletou) --}}
    @if(session('success'))
        <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-3">
            <i class="fa-solid fa-circle-check text-lg"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 bg-red-500/10 border border-red-500/20 text-red-600 dark:text-red-400 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-3 animate-pulse">
            <i class="fa-solid fa-triangle-exclamation text-lg"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- Tabela --}}
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden rounded-2xl">
        <div class="p-5 border-b border-slate-100 dark:border-slate-800 bg-white dark:bg-transparent">
            <h2 class="font-black text-slate-800 dark:text-white text-sm uppercase tracking-wider">Categorias Existentes</h2>
        </div>

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-[10px] uppercase tracking-widest text-slate-400 border-b border-slate-100 dark:border-slate-800">
                    <th class="px-6 py-4 font-black w-20 text-center">Nº</th>
                    <th class="px-6 py-4 font-black">Nome da Categoria</th>
                    <th class="px-6 py-4 font-black text-center">Postagens</th>
                    <th class="px-6 py-4 font-black text-center">Ordem</th>
                    <th class="px-6 py-4 font-black">Cor</th>
                    <th class="px-6 py-4 font-black text-right">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($categories as $cat)
                <tr class="text-sm group hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                    <td class="px-6 py-4 text-slate-400 italic text-center font-medium">
                        #{{ $loop->iteration }}
                    </td>
                    
                    <td class="px-6 py-4 font-[1000] text-slate-900 dark:text-white uppercase tracking-tighter">
                        {{ $cat->name }}
                    </td>

                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-[1000] bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400">
                            {{ $cat->posts_count }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-center">
                        <span class="px-3 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 rounded-md text-xs font-bold">
                            {{ $cat->order }}º
                        </span>
                    </td>
                    
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-2 rounded-full shadow-sm" style="background-color: {{ $cat->color }}"></div>
                            <span class="text-[10px] font-mono text-slate-400 uppercase">{{ $cat->color }}</span>
                        </div>
                    </td>
                    
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.categories.edit', $cat->id) }}" class="p-2 text-slate-400 hover:text-portal-blue transition-colors">
                                <i class="fa-solid fa-edit"></i>
                            </a>

                            <form action="{{ route('admin.categories.destroy', $cat->id) }}" 
                                  method="POST" 
                                  class="inline" 
                                  onsubmit="return confirm('Deseja realmente excluir? Se houver notícias vinculadas, o Pebas 40º bloqueará a ação para proteger seus dados.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition-colors">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-20 text-center">
                        <i class="fa-solid fa-folder-open text-slate-200 dark:text-slate-800 text-4xl mb-4 block"></i>
                        <span class="text-slate-400 italic text-sm font-medium">Nenhuma categoria cadastrada ainda.</span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection