<?php

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $posts = Post::with(['author', 'category'])
        ->latest()
        ->paginate(9);

    return view('site.home', compact('posts'));
})->name('site.home');

/*
|--------------------------------------------------------------------------
| POSTS
|--------------------------------------------------------------------------
*/
Route::get('/noticia/{post:slug}', function (Post $post) {
    $post->load(['author', 'category']);

    return view('site.posts.post', compact('post'));
})->name('site.post');

/*
|--------------------------------------------------------------------------
| CATEGORIAS
|--------------------------------------------------------------------------
*/
Route::get('/categoria/{category:slug}', function (Category $category) {

    // carrega os posts da categoria
    $posts = Post::with(['author', 'category'])
        ->where('category_id', $category->id)
        ->latest()
        ->paginate(9);

    return view('site.category.index', compact('category', 'posts'));

})->name('site.categoria');
