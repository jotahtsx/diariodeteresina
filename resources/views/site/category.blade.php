@extends('site.master')

@section('content')
    <div class="container mx-auto px-4 py-8">

        <h1 class="text-2xl font-black mb-6">
            Categoria: {{ $category->name }}
        </h1>

        @forelse ($posts as $post)
            <div class="mb-4 border-b pb-4">
                <a href="{{ route('site.post', $post->slug) }}" class="text-lg font-bold text-[#EA2027] hover:underline">
                    {{ $post->title }}
                </a>
            </div>
        @empty
            <p>Nenhuma notícia nessa categoria.</p>
        @endforelse

        <div class="mt-6">
            {{ $posts->links() }}
        </div>

    </div>
@endsection
