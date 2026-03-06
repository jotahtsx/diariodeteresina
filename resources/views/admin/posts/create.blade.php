@extends('admin.master')

@section('content')
    <div class="space-y-6">
        {{-- Topo --}}
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-slate-800 dark:text-white uppercase tracking-tighter">Nova Notícia</h2>
                <p class="text-sm text-slate-500">Publique um novo conteúdo no portal Pebas 40º</p>
            </div>
            <a href="{{ route('admin.posts.index') }}"
                class="px-5 py-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 rounded-lg font-black uppercase tracking-widest text-[10px] hover:bg-slate-50 transition-all flex items-center gap-2 shadow-sm">
                <i class="fa-solid fa-arrow-left"></i> Voltar para Listagem
            </a>
        </div>

        {{-- Container do Formulário --}}
        <div
            class="bg-white dark:bg-slate-900 rounded-none border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-slate-100 dark:border-slate-800 bg-slate-50/30 dark:bg-transparent">
                <h2 class="font-bold text-slate-800 dark:text-white text-sm uppercase tracking-wider">
                    Redação da Matéria</h2>
            </div>

            <div class="p-8">
                <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data"
                    class="w-full space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                        {{-- Coluna Principal (Conteúdo) --}}
                        <div class="lg:col-span-2 space-y-6">
                            <div class="w-full">
                                <label
                                    class="text-[10px] font-black text-slate-500 dark:text-slate-400 mb-2 block uppercase tracking-widest">Título
                                    da Matéria</label>
                                <input type="text" name="title" value="{{ old('title') }}" required
                                    placeholder="Ex: Inauguração da nova praça em Parauapebas..."
                                    class="w-full px-5 py-4 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg focus:ring-4 focus:ring-portal-blue/5 focus:border-portal-blue outline-none text-lg text-slate-900 dark:text-white transition-all font-bold shadow-sm">
                                @error('title')
                                    <span class="text-red-500 text-[10px] font-bold uppercase mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Conteúdo (Textarea por enquanto, depois podemos por um Editor) --}}
                            <div class="w-full">
                                <label
                                    class="text-[10px] font-black text-slate-500 dark:text-slate-400 mb-2 block uppercase tracking-widest">Corpo
                                    da Notícia</label>
                                <textarea name="content" rows="12" required placeholder="Escreva aqui o conteúdo da sua matéria..."
                                    class="w-full px-5 py-4 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg focus:ring-4 focus:ring-portal-blue/5 focus:border-portal-blue outline-none text-base text-slate-900 dark:text-white transition-all shadow-sm">{{ old('content') }}</textarea>
                                @error('content')
                                    <span class="text-red-500 text-[10px] font-bold uppercase mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Coluna Lateral (Configurações) --}}
                        <div class="space-y-6">
                            {{-- Imagem de Capa --}}
                            <div class="w-full">
                                <label
                                    class="text-[10px] font-black text-slate-500 dark:text-slate-400 mb-2 block uppercase tracking-widest">Imagem
                                    de Capa (Destaque)</label>
                                <div
                                    class="relative w-full overflow-hidden bg-slate-100 dark:bg-slate-800 border-2 border-dashed border-slate-300 dark:border-slate-700 rounded-xl p-4 text-center">
                                    <input type="file" name="image" required
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                    <i class="fa-solid fa-cloud-arrow-up text-3xl text-slate-400 mb-2"></i>
                                    <p class="text-[10px] text-slate-500 font-bold uppercase">Clique ou arraste a foto aqui
                                    </p>
                                </div>
                                @error('image')
                                    <span class="text-red-500 text-[10px] font-bold uppercase mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Categoria --}}
                            <div class="w-full">
                                <label
                                    class="text-[10px] font-black text-slate-500 dark:text-slate-400 mb-2 block uppercase tracking-widest">Seção
                                    / Categoria</label>
                                <select name="category_id" required
                                    class="w-full px-4 py-4 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg outline-none focus:border-portal-blue text-slate-900 dark:text-white font-bold transition-all shadow-sm appearance-none cursor-pointer">
                                    <option value="">Selecione uma categoria...</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Status da Postagem --}}
                            <div class="w-full">
                                <label
                                    class="text-[10px] font-black text-slate-500 dark:text-slate-400 mb-2 block uppercase tracking-widest">Status
                                    de Publicação</label>
                                <select name="status" required
                                    class="w-full px-4 py-4 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg outline-none focus:border-portal-blue text-slate-900 dark:text-white font-bold transition-all shadow-sm cursor-pointer">
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Publicar
                                        Imediatamente</option>
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Salvar como
                                        Rascunho</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Rodapé --}}
                    <div
                        class="pt-8 border-t border-slate-100 dark:border-slate-800 flex flex-col md:flex-row items-center gap-4">
                        <button type="submit"
                            class="w-full md:w-auto px-12 py-4 bg-portal-blue text-white rounded-lg font-black uppercase tracking-widest text-xs hover:opacity-90 transition-all shadow-xl shadow-portal-blue/20 active:scale-95 flex items-center justify-center gap-2">
                            <i class="fa-solid fa-paper-plane"></i> Finalizar e Postar
                        </button>

                        <a href="{{ route('admin.posts.index') }}"
                            class="w-full md:w-auto px-12 py-4 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 rounded-lg font-black uppercase tracking-widest text-[10px] text-center hover:bg-slate-200 transition-all">
                            Descartar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
