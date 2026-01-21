<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use AuthorizesRequests;

    /**
     * Listar todas as categorias (Público)
     */
    public function index()
    {
        // Traz as categorias com a contagem de notícias vinculadas
        $categories = Category::withCount('posts')->orderBy('name')->get();
        
        return CategoryResource::collection($categories);
    }

    /**
     * Criar nova categoria (Admin)
     */
    public function store(Request $request)
    {
        $this->authorize('criar noticias');

        $data = $request->validate([
            'name'  => 'required|string|unique:categories,name',
            'color' => 'nullable|string|max:7',
        ]);

        $category = Category::create([
            'name'  => $data['name'],
            'slug'  => Str::slug($data['name']),
            'color' => $data['color'] ?? null,
        ]);

        return response()->json([
            'message' => 'Categoria criada com sucesso!',
            'data'    => new CategoryResource($category)
        ], 201);
    }

    /**
     * Atualizar categoria existente
     */
    public function update(Request $request, $id)
    {
        $this->authorize('criar noticias');

        $category = Category::findOrFail($id);

        $data = $request->validate([
            // O 'unique' ignora o ID atual para permitir salvar o mesmo nome se mudar só a cor
            'name'  => 'required|string|unique:categories,name,' . $id,
            'color' => 'nullable|string|max:7',
        ]);

        // Atualizamos o nome, a cor e geramos um novo slug baseado no novo nome
        $category->update([
            'name'  => $data['name'],
            'slug'  => Str::slug($data['name']),
            'color' => $data['color'] ?? $category->color,
        ]);

        return response()->json([
            'message' => 'Categoria atualizada com sucesso!',
            'data'    => new CategoryResource($category)
        ]);
    }

    /**
     * Remover categoria (Com trava de integridade)
     */
    public function destroy($id)
    {
        $this->authorize('criar noticias');

        $category = Category::findOrFail($id);

        // Impede a remoção se houver posts para não quebrar o site
        if ($category->posts()->exists()) {
            return response()->json([
                'message' => 'Não é possível remover: esta categoria possui notícias vinculadas.'
            ], 422);
        }

        $category->delete();

        return response()->json([
            'message' => 'Categoria removida com sucesso!'
        ]);
    }
}