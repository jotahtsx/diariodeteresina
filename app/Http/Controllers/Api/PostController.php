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
        $query = Post::query()
            ->with(['author', 'category'])
            ->latest();

        // FILTRO: Busca por texto
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                  ->orWhere('content', 'like', '%' . $request->q . '%');
            });
        }

        // FILTRO: Categoria por Slug
        if ($request->filled('categoria')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->categoria);
            });
        }

        // NOVIDADE: Filtro por intervalo de datas
        if ($request->filled('data_inicio')) {
            $query->whereDate('created_at', '>=', $request->data_inicio);
        }

        if ($request->filled('data_fim')) {
            $query->whereDate('created_at', '<=', $request->data_fim);
        }

        // FILTRO: Destaques (?destaque=1)
        if ($request->has('destaque')) {
            return PostResource::collection($query->limit(3)->get());
        }

        return PostResource::collection($query->paginate(10));
    }

    public function show($id)
    {
        $post = Post::with(['author', 'category'])->findOrFail($id);
        $post->increment('views');
        return new PostResource($post);
    }

    public function store(PostRequest $request)
    {
        $this->authorize('criar noticias');

        $data = $request->validated();

        // Garante o slug logo no início
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']) . '-' . rand(100, 999);
        }

        // Imagem com nome personalizado (SEO)
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $data['slug'] . '-' . time() . '.' . $file->getClientOriginalExtension();
            $data['image'] = $file->storeAs('posts', $fileName, 'public');
        }

        $data['author_id'] = $request->user()->id;

        $post = Post::create($data);
        $post->load(['author', 'category']);

        return response()->json([
            'message' => 'Post criado com sucesso!',
            'data' => new PostResource($post),
        ], 201);
    }

    public function update(PostRequest $request, $id)
    {
        $this->authorize('criar noticias');
        
        $post = Post::findOrFail($id);
        $data = $request->validated();

        // Atualiza o slug se o título mudar e não houver slug manual
        if (empty($data['slug']) && isset($data['title'])) {
            $data['slug'] = Str::slug($data['title']) . '-' . rand(100, 999);
        }

        // Atualização da Imagem
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            
            $file = $request->file('image');
            $fileName = ($data['slug'] ?? $post->slug) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $data['image'] = $file->storeAs('posts', $fileName, 'public');
        }

        $post->update($data);
        $post->load(['author', 'category']);

        return response()->json([
            'message' => 'Notícia atualizada com sucesso!',
            'data' => new PostResource($post),
        ]);
    }

    public function destroy($id)
    {
        $this->authorize('criar noticias');

        $post = Post::findOrFail($id);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return response()->json([
            'message' => 'Notícia removida com sucesso!',
        ]);
    }

    /**
 * Notícias Relacionadas (Público)
 * Busca posts da mesma categoria, excluindo o atual.
 */
    public function relacionadas($id)
    {
        $post = Post::findOrFail($id);

        $relacionadas = Post::query()
            ->with(['author', 'category'])
            ->where('category_id', $post->category_id) // Mesma categoria
            ->where('id', '!=', $post->id)             // Exclui a notícia atual
            ->latest()
            ->limit(3)                                 // Traz apenas as 3 mais recentes
            ->get();

        return PostResource::collection($relacionadas);
    }

    public function maisLidas()
    {
        $posts = Post::with(['author', 'category'])
            ->orderBy('views', 'desc')
            ->limit(5)
            ->get();

        return PostResource::collection($posts);
    }
}