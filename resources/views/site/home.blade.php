@extends('site.master')

@section('title', 'Diário de Teresina')

@section('content')
    <h1>Lista de Notícias</h1>
    @foreach($posts as $post)
        <p>{{ $post->title }}</p>
    @endforeach
@endsection