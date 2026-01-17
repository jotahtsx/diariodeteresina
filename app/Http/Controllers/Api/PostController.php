<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\PostRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Lista todas as notícias com paginação e filtros.
     */
    public function index(Request $request)
    {
        $query = Post::with(['author', 'category'])->latest();
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                    ->orWhere('content', 'like', '%' . $request->q . '%');
            });
        }
        if ($request->filled('categoria')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->categoria);
            });
        }
        $posts = $query->paginate(10);
        return PostResource::collection($posts);
    }

    /**
     * Exibe uma única notícia detalhada.
     */
    public function show(Post $post)
    {
        $post->load(['author', 'category']);
        return new PostResource($post);
    }


    public function store(PostRequest $request)
    {
        // O Model vai interceptar o 'title' e criar o 'slug' no momento do save!
        $post = Post::create($request->validated());

        return response()->json([
            'message' => 'Post criado com sucesso!',
            'data'    => $post
        ], 201);
    }
}
