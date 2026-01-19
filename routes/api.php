<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// --- ROTAS PÚBLICAS ---
// Usamos o Controller para manter as rotas limpas
Route::get('/categorias', function () {
    return CategoryResource::collection(Category::all());
});
Route::get('/noticias', [PostController::class, 'index']);
Route::get('/noticia/{post:slug}', [PostController::class, 'show']);
Route::post('/login', [AuthController::class, 'login']);

// --- ROTAS PROTEGIDAS ---
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/noticia', [PostController::class, 'store']);

    // DICA: Se for enviar IMAGEM no update, use POST com _method=PUT
    Route::match(['post', 'put'], '/noticia/{post}', [PostController::class, 'update']);

    Route::delete('/noticia/{post}', [PostController::class, 'destroy']);

    Route::get('/me', function (Request $request) {
        return response()->json([
            'user' => $request->user(),
            'permissions' => $request->user()->getAllPermissions()->pluck('name'),
        ]);
    });
});
