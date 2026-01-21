<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
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

    // --- Perfil e Permissões ---
    Route::get('/me', function (Request $request) {
        return response()->json([
            'user' => $request->user(),
            'permissions' => $request->user()->getAllPermissions()->pluck('name'),
        ]);
    });
});