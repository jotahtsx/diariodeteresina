@extends('admin.master')

@section('content')
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-4xl font-[1000] text-slate-900 dark:text-white uppercase tracking-tighter leading-none">
                    Notícias</h2>
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 dark:text-slate-400 mt-2">
                    Gerencie o conteúdo do portal
                </p>
            </div>

            <a href="{{ route('admin.posts.create') }}"
                class="px-6 py-3 bg-slate-900 dark:bg-portal-blue text-white rounded-lg font-black uppercase tracking-widest text-xs shadow-md active:scale-95 flex items-center gap-2 transition-transform">
                <i class="fa-solid fa-plus"></i> Nova Notícia
            </a>
        </div>

        {{-- Alerts --}}
        @if (session('success'))
            <div
                class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-lg"></i>
                {{ session('success') }}
            </div>
        @endif

        <div
            class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden rounded-2xl">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="text-[10px] uppercase tracking-widest text-slate-400 border-b border-slate-100 dark:border-slate-800">
                        <th class="px-6 py-4 font-black">Título / Slug</th>
                        <th class="px-6 py-4 font-black text-center">Categoria</th>
                        <th class="px-6 py-4 font-black text-center">Status</th>
                        <th class="px-6 py-4 font-black text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($posts as $post)
                        <tr
                            class="text-sm transition-colors border-b border-slate-50 dark:border-slate-800/50 last:border-none hover:bg-slate-50/10">
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span
                                        class="font-[1000] text-slate-900 dark:text-white uppercase tracking-tighter leading-tight">
                                        {{ Str::limit($post->title, 50) }}
                                    </span>
                                    <span class="text-[10px] font-mono text-slate-400 lowercase">
                                        /{{ $post->slug }}
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if ($post->category)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter"
                                        style="background-color: {{ $post->category->color }}20; color: {{ $post->category->color }}; border: 1px solid {{ $post->category->color }}40">
                                        {{ $post->category->name }}
                                    </span>
                                @else
                                    <span class="text-slate-300 italic text-[10px]">Sem Categoria</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center">
                                    @if (in_array(trim($post->status), ['published', 'postado']))
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter bg-emerald-500/10 text-emerald-600 border border-emerald-500/20">
                                            Postado
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter bg-slate-100 dark:bg-slate-800 text-slate-400 border border-slate-200 dark:border-slate-700">
                                            Rascunho
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.posts.edit', $post->id) }}"
                                        class="p-2 text-slate-400 hover:text-portal-blue transition-colors">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Tem certeza?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-slate-400 hover:text-red-500 transition-colors">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-20 text-center text-slate-400 italic text-sm">Nenhuma notícia
                                encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if ($posts->hasPages())
                <div class="px-6 pt-8 pb-6 bg-white dark:bg-slate-900 flex flex-col items-center gap-6">

                    <div class="flex items-center gap-3 py-2">

                        {{-- Voltar --}}
                        @if ($posts->onFirstPage())
                            <span
                                class="w-10 h-10 flex items-center justify-center text-slate-300 dark:text-slate-600 cursor-not-allowed">
                                <i class="fa-solid fa-chevron-left text-[10px]"></i>
                            </span>
                        @else
                            <a href="{{ $posts->previousPageUrl() }}"
                                class="w-10 h-10 flex items-center justify-center text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-800 rounded-lg shadow-[0_1px_2px_rgba(0,0,0,0.05)] hover:bg-slate-50 dark:hover:bg-slate-700 active:scale-95 transition-all">
                                <i class="fa-solid fa-chevron-left text-[10px]"></i>
                            </a>
                        @endif

                        @foreach ($posts->getUrlRange(max(1, $posts->currentPage() - 2), min($posts->lastPage(), $posts->currentPage() + 2)) as $page => $url)
                            @if ($page == $posts->currentPage())
                                <span
                                    class="w-10 h-10 flex items-center justify-center bg-slate-900 dark:bg-portal-blue text-white rounded-lg shadow-sm font-bold text-xs ring-2 ring-slate-900/10 dark:ring-portal-blue/20">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="w-10 h-10 flex items-center justify-center text-slate-500 dark:text-slate-400 bg-white dark:bg-slate-800 rounded-lg shadow-[0_1px_2px_rgba(0,0,0,0.05)] hover:text-slate-900 dark:hover:text-white transition-all text-xs font-bold">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach

                        @if ($posts->hasMorePages())
                            <a href="{{ $posts->nextPageUrl() }}"
                                class="w-10 h-10 flex items-center justify-center text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-800 rounded-lg shadow-[0_1px_2px_rgba(0,0,0,0.05)] hover:bg-slate-50 dark:hover:bg-slate-700 active:scale-95 transition-all">
                                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </a>
                        @else
                            <span
                                class="w-10 h-10 flex items-center justify-center text-slate-300 dark:text-slate-600 cursor-not-allowed">
                                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </span>
                        @endif
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
