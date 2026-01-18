<?php

use App\Http\Controllers\Api\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

// Listagem principal de notícias do Diário de Teresina
Route::get('/noticias', function () {
    return Post::with(['author', 'category'])
        ->latest()
        ->get()
        ->map(function ($post) {
            return [
                'id' => $post->id,
                'titulo' => $post->title,
                'slug' => $post->slug,
                'conteudo' => $post->content,
                'categoria' => $post->category->name ?? 'Geral',
                'autor' => [
                    'nome' => $post->author->name ?? 'Redação',
                    'localizacao' => ($post->author->city ?? 'Teresina').'/'.($post->author->state ?? 'PI'),
                ],
                'publicado_em' => $post->created_at->format('d/m/Y H:i'),
                'links_externos' => [
                    'instagram' => $post->instagram_post_url,
                    'telegram' => $post->telegram_message_id,
                ],
                'relacionadas' => Post::where('category_id', $post->category_id)
                    ->where('id', '!=', $post->id)
                    ->limit(3)
                    ->get(['id', 'title', 'slug']),
            ];
        });
});

// Listagem de todas as notícias
Route::get('/noticias', [PostController::class, 'index']);

// Detalhe de uma notícia específica pelo slug
Route::get('/noticia/{post:slug}', [PostController::class, 'show']);

// Cadastra a notícia
Route::post('/noticia', [PostController::class, 'store']);

// Editar a notícia
Route::put('/noticia/{post}', [PostController::class, 'update']);

// Deletando a notícia
Route::delete('/noticia/{post}', [PostController::class, 'destroy']);
