<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        $posts = Post::with(['author', 'category'])
            ->latest()
            ->get()
            ->map(function ($post) {
                return [
                    'id'         => $post->id,
                    'titulo'     => $post->title,
                    'slug'       => $post->slug,
                    'resumo'     => str($post->content)->limit(150),
                    'publicado'  => $post->created_at->format('d/m/Y H:i'),
                    'categoria'  => [
                        'nome' => $post->category->name,
                        'cor'  => $post->category->color,
                    ],
                    'autor'      => [
                        'nome'   => $post->author->name,
                        'origem' => "{$post->author->city}/{$post->author->state}",
                    ],
                    'links' => [
                        'instagram' => $post->instagram_url,
                    ]
                ];
            });

        return response()->json($posts);
    }


    public function show(Post $post): JsonResponse
    {        // Carregamos os relacionamentos para o objeto $post que o Laravel já achou
        $post->load(['author', 'category']);

        return response()->json([
            'titulo'   => $post->title,
            'slug'     => $post->slug,
            'conteudo' => $post->content,
            'autor'    => $post->author->name . " ({$post->author->city}/{$post->author->state})",
            'categoria' => $post->category->name,
            'links'    => [
                'instagram' => $post->instagram_url,
            ]
        ]);
    }
}
