<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // IMPORTANTE: Adicione esta linha

class PostController extends Controller
{
    use AuthorizesRequests; // IMPORTANTE: Adicione esta linha para habilitar o $this->authorize()

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
        // Agora o 'authorize' vai funcionar perfeitamente!
        $this->authorize('criar noticias');

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post = Post::create($data);

        return response()->json([
            'message' => 'Post criado com sucesso!',
            'data' => new PostResource($post),
        ], 201);
    }

    public function update(PostRequest $request, Post $post) // Usei Route Model Binding aqui para ficar mais soft
    {
        $this->authorize('criar noticias'); // Também protegendo o update

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
            'data' => new PostResource($post) // Padronizei para usar o seu Resource
        ]);
    }

    public function destroy(Post $post) // Simplificado com Model Binding
    {
        $this->authorize('criar noticias'); // Só quem tem poder apaga notícia no Diário

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return response()->json([
            'message' => 'Notícia removida com sucesso!'
        ]);
    }
}
