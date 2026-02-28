@extends('admin.master')

@section('content')
<div class="space-y-6">
    {{-- Topo --}}
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white uppercase tracking-tighter">Editar Categoria</h2>
            <p class="text-sm text-slate-500">Alterando registro: <span class="font-bold text-portal-blue">{{ $category->name }}</span></p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="px-5 py-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 rounded-lg font-black uppercase tracking-widest text-[10px] hover:bg-slate-50 transition-all flex items-center gap-2 shadow-sm">
            <i class="fa-solid fa-arrow-left"></i> Voltar para Listagem
        </a>
    </div>

    {{-- Container do Formulário (Mantivemos rounded-none para o bloco principal, ou prefere arredondar o card também?) --}}
    <div class="bg-white dark:bg-slate-900 rounded-none border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-100 dark:border-slate-800 bg-slate-50/30 dark:bg-transparent">
            <h2 class="font-bold text-slate-800 dark:text-white text-sm uppercase tracking-wider text-portal-blue">Formulário de Edição</h2>
        </div>

        <div class="p-8">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="w-full space-y-8">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    {{-- Nome da Categoria (Agora com rounded-lg) --}}
                    <div class="w-full">
                        <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 mb-2 block uppercase tracking-widest">Nome da Categoria</label>
                        <input type="text" name="name" value="{{ $category->name }}" required 
                               class="w-full px-5 py-4 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg focus:ring-4 focus:ring-portal-blue/5 focus:border-portal-blue outline-none text-base text-slate-900 dark:text-white transition-all font-bold shadow-sm">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Ordem (Agora com rounded-lg) --}}
                        <div class="w-full">
                            <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 mb-2 block uppercase tracking-widest">Ordem de Exibição</label>
                            <input type="number" name="order" value="{{ $category->order }}" 
                                   class="w-full px-5 py-4 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-base outline-none focus:border-portal-blue text-slate-900 dark:text-white font-bold transition-all shadow-sm">
                        </div>

                        {{-- Cor (Agora com rounded-lg) --}}
                        <div class="w-full">
                            <label class="text-[10px] font-black text-slate-500 dark:text-slate-400 mb-2 block uppercase tracking-widest">Cor de Identificação</label>
                            <div class="relative w-full h-14">
                                <input type="color" name="color" value="{{ $category->color }}" 
                                       class="absolute inset-0 w-full h-full p-1 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg cursor-pointer shadow-inner appearance-none">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Rodapé --}}
                <div class="pt-8 border-t border-slate-100 dark:border-slate-800 flex flex-col md:flex-row items-center gap-4">
                    <button type="submit" class="w-full md:w-auto px-12 py-4 bg-portal-blue text-white rounded-lg font-black uppercase tracking-widest text-xs hover:opacity-90 transition-all shadow-xl shadow-portal-blue/20 active:scale-95">
                        Salvar Alterações
                    </button>
                    
                    <a href="{{ route('admin.categories.index') }}" class="w-full md:w-auto px-12 py-4 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 rounded-lg font-black uppercase tracking-widest text-[10px] text-center hover:bg-slate-200 transition-all">
                        Descartar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection