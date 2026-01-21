<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
// Importe o novo Controller
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ====================
// ROTAS PÚBLICAS
// ====================

// Categorias
Route::get('/categorias', [CategoryController::class, 'index']);

// Notícias
Route::get('/noticias', [PostController::class, 'index']);
Route::get('/noticia/{id}', [PostController::class, 'show']);
Route::get('/noticia/{id}/relacionadas', [PostController::class, 'relacionadas']);
Route::get('/noticias/mais-lidas', [PostController::class, 'maisLidas']);

// Widget Copa / Eventos Especiais
Route::get('/banner-especial', function () {
    try {
        $banner = \App\Models\TopBanner::where('is_active', true)->first();
        if (! $banner) {
            return response()->json(['visible' => false]);
        }

        return response()->json([
            'visible' => true,
            'id' => $banner->id,
            'texto' => "{$banner->titulo}: {$banner->confronto}",
            'estilo' => [
                'fundo' => $banner->cor_fundo,
                'arredondamento' => '25px',
            ],
        ]);
    } catch (\Exception $e) {
        return response()->json(['visible' => false]);
    }
});

// Auth
Route::post('/login', [AuthController::class, 'login']);

// ====================
// ROTAS PROTEGIDAS (Admin)
// ====================
Route::middleware('auth:sanctum')->group(function () {

    // --- Notícias ---
    Route::post('/noticia', [PostController::class, 'store']);
    Route::match(['post', 'put'], '/noticia/{id}', [PostController::class, 'update']);
    Route::delete('/noticia/{id}', [PostController::class, 'destroy']);

    // --- Categorias ---
    Route::post('/categoria', [CategoryController::class, 'store']);
    Route::match(['post', 'put'], '/categoria/{id}', [CategoryController::class, 'update']);
    Route::delete('/categoria/{id}', [CategoryController::class, 'destroy']);

    // --- Banner Especial (Admin) ---
    // Rota para você atualizar o jogo e ligar/desligar o banner
    Route::post('/banner-especial', function (Request $request) {
        $data = $request->validate([
            'titulo' => 'string',
            'confronto' => 'required|string',
            'is_active' => 'required|boolean',
            'cor_fundo' => 'string',
        ]);

        $banner = \App\Models\TopBanner::updateOrCreate(['id' => 1], $data);

        return response()->json([
            'message' => 'Banner atualizado!',
            'data' => $banner,
        ]);
    });

    // --- Perfil e Permissões ---
    Route::get('/me', function (Request $request) {
        return response()->json([
            'user' => $request->user(),
            'permissions' => $request->user()->getAllPermissions()->pluck('name'),
        ]);
    });
});
