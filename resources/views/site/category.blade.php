@extends('site.master')

@section('title', $category->name . ' - Pebas 40 Graus')

@section('content')
    <main class="container mx-auto px-4 max-w-5xl py-12">

        <header class="mb-12">
            <div class="flex items-center gap-3 mb-2">
                <span class="w-10 h-1 bg-[#EA2027] rounded-full"></span>
                <span class="text-xs font-black uppercase tracking-widest text-gray-400">Editoria</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-[950] text-gray-900 tracking-tighter">
                {{ $category->name }}
            </h1>
        </header>

        {{-- Listagem de Notícias --}}
        <div class="space-y-8">
            @forelse ($posts as $post)
                <article
                    class="group bg-white border border-gray-100 p-5 rounded-[32px] transition-all hover:shadow-xl hover:border-transparent">
                    <a href="{{ route('site.post', $post->slug) }}" class="flex flex-col md:flex-row gap-8">

                        @if ($post->image)
                            <div class="w-full md:w-64 h-44 shrink-0 overflow-hidden rounded-[24px]">
                                <img src="{{ $post->image }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                    alt="{{ $post->title }}">
                            </div>
                        @endif

                        <div class="flex flex-col justify-center">
                            <time class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                                {{ $post->created_at->format('d/m/Y') }}
                            </time>
                            <h2
                                class="text-2xl md:text-3xl font-[950] leading-tight text-gray-900 group-hover:text-[#EA2027] transition-colors">
                                {{ $post->title }}
                            </h2>
                            <p class="text-gray-500 mt-3 font-light line-clamp-2">
                                {{ Str::limit(strip_tags($post->content), 150) }}
                            </p>
                        </div>
                    </a>
                </article>
            @empty
                <div class="text-center py-20 bg-gray-50 rounded-[32px]">
                    <p class="text-gray-400 font-medium">Nenhuma notícia encontrada nesta categoria.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12 flex justify-center">
            {{ $posts->links() }}
        </div>

    </main>
@endsection
