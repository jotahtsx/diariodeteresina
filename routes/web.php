<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = Post::with(['author', 'category'])->latest()->paginate(9);

    return view('site.home', compact('posts'));
})->name('site.home');

Route::get('/noticia/{post:slug}', function (Post $post) {
    $post->load(['author', 'category']);

    return view('site.posts.post', compact('post'));
})->name('site.post');
