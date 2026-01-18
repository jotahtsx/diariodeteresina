<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
                $q->where('title', 'like', '%'.$request->q.'%')
                    ->orWhere('content', 'like', '%'.$request->q.'%');
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
        $data = $request->validated();

        // Se vier uma imagem, a gente salva ela no disco 'public'
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post = Post::create($data);

        return response()->json([
            'message' => 'Post criado com sucesso!',
            'data' => new PostResource($post), // Usando o Resource aqui também!
        ], 201);
    }

    public function update(PostRequest $request, Post $post)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return response()->json([
            'message' => 'Notícia atualizada com sucesso!',
            'data' => new PostResource($post)
        ]);
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return response()->json([
            'message' => 'Post deletado com sucesso!'
        ], 200);
    }
}
