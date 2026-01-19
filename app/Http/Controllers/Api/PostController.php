<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    use AuthorizesRequests;

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

        return PostResource::collection($query->paginate(10));
    }

    public function show(Post $post)
    {
        $post->load(['author', 'category']);

        return new PostResource($post);
    }

    public function store(PostRequest $request)
    {
        $this->authorize('criar noticias');

        $data = $request->validated();

        // Tratamento de Imagem
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        // Lógica de Slug Único para evitar o erro SQLSTATE[23505]
        $slug = Str::slug($data['title']);
        $count = Post::where('slug', 'LIKE', "{$slug}%")->count();
        $data['slug'] = $count ? "{$slug}-" . ($count + 1) : $slug;

        // Garante que o autor_id seja o usuário logado se não vier no request
        $data['author_id'] = auth()->id();

        $post = Post::create($data);

        return response()->json([
            'message' => 'Post criado com sucesso!',
            'data' => new PostResource($post),
        ], 201);
    }

    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('criar noticias');

        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        // Se o título mudou, atualizamos o slug também
        if (isset($data['title']) && $data['title'] !== $post->title) {
            $slug = Str::slug($data['title']);
            $count = Post::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $post->id)->count();
            $data['slug'] = $count ? "{$slug}-" . ($count + 1) : $slug;
        }

        $post->update($data);

        return response()->json([
            'message' => 'Notícia atualizada com sucesso!',
            'data' => new PostResource($post),
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('criar noticias');

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return response()->json([
            'message' => 'Notícia removida com sucesso!',
        ]);
    }
}
