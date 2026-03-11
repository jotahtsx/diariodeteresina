<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Post;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')
            ->latest()
            ->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $states = State::orderBy('name')->get();
        $cities = collect();

        return view('admin.posts.create', compact('categories', 'states', 'cities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|string',
            'eyebrow' => 'nullable|string|max:100',
            'excerpt' => 'nullable|string|max:500',
            'published_at' => 'nullable|date',
        ]);

        try {

            DB::transaction(function () use ($validated, $request) {

                /*
                |---------------------------------------------------
                | Upload da imagem
                |---------------------------------------------------
                */

                $imagePath = null;

                if ($request->hasFile('image')) {

                    $extension = $request->file('image')->getClientOriginalExtension();

                    $fileName = Str::slug($validated['title'])
                        . '-' . time()
                        . '.' . $extension;

                    $imagePath = $request->file('image')
                        ->storeAs('posts', $fileName, 'public');
                }

                /*
                |---------------------------------------------------
                | Gerar slug único
                |---------------------------------------------------
                */

                $slug = Str::slug($validated['title']);

                if (Post::where('slug', $slug)->exists()) {
                    $slug .= '-' . time();
                }

                /*
                |---------------------------------------------------
                | Criar post
                |---------------------------------------------------
                */

                Post::create([
                    'title' => $validated['title'],
                    'slug' => $slug,
                    'content' => $validated['content'],
                    'category_id' => $validated['category_id'],
                    'state_id' => $validated['state_id'] ?? null,
                    'city_id' => $validated['city_id'] ?? null,
                    'author_id' => Auth::id() ?? 1, // fallback caso auth falhe
                    'image' => $imagePath,
                    'status' => $validated['status'],
                    'eyebrow' => $validated['eyebrow'] ?? null,
                    'excerpt' => $validated['excerpt']
                        ?? Str::limit(strip_tags($validated['content']), 160),
                    'is_featured' => $request->boolean('is_featured'),
                    'is_highlight' => $request->boolean('is_highlight'),
                    'views' => 0,
                    'published_at' => $validated['published_at'] ?? now(),
                ]);

            });

            return redirect()
                ->route('admin.posts.index')
                ->with('success', 'Notícia publicada com sucesso!');

        } catch (\Exception $e) {

            Log::error("Erro ao salvar post: " . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Erro ao gravar: ' . $e->getMessage());
        }
    }

    public function getCities($state_id)
    {
        $cities = City::where('state_id', $state_id)
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($cities);
    }
}
