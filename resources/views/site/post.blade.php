<x-app-layout>
    <article class="container mx-auto px-4 max-w-4xl py-10">
        <header class="mb-8">
            <div class="flex items-center gap-2 text-sm font-bold mb-4">
                <a href="{{ route('site.home') }}" class="text-red-600 hover:underline">HOME</a>
                <span class="text-gray-300">/</span>
                <span class="text-gray-500 uppercase">{{ $post->category->name }}</span>
            </div>

            <h1 class="text-4xl md:text-6xl font-black leading-none mb-6 text-gray-900 tracking-tight">
                {{ $post->title }}
            </h1>

            <div
                class="flex flex-col md:flex-row md:items-center justify-between text-gray-500 text-sm border-y border-gray-100 py-4 gap-4">
                <div class="flex items-center gap-2">
                    <div
                        class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-400">
                        {{ substr($post->author->name ?? 'R', 0, 1) }}
                    </div>
                    <span>Por <strong>{{ $post->author->name ?? 'Redação' }}</strong></span>
                </div>
                <div class="flex items-center gap-4 italic">
                    <span>{{ $post->created_at->format('d/m/Y \à\s H:i') }}</span>
                    <span>👁️ {{ $post->views }} visualizações</span>
                </div>
            </div>
        </header>

        @if ($post->image)
            <img src="{{ $post->image }}" class="w-full rounded-2xl shadow-2xl mb-10 object-cover max-h-[500px]">
        @endif

        <div class="prose prose-xl prose-red max-w-none text-gray-800 leading-relaxed font-serif">
            {!! nl2br($post->content) !!}
        </div>

        <div class="mt-20 p-8 bg-gray-100 rounded-2xl text-center">
            <h4 class="font-bold mb-2">Gostou da notícia?</h4>
            <p class="text-gray-600 mb-6">Compartilhe com seus amigos de {{ $post->city->name }}!</p>
            <a href="{{ route('site.home') }}"
                class="inline-block bg-red-600 text-white px-8 py-3 rounded-full font-bold hover:bg-red-700 transition">
                Voltar para a Home
            </a>
        </div>
    </article>
</x-app-layout>
