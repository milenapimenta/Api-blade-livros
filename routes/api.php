<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LivroController;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('api/livros', [LivroController::class, 'index']);
Route::get('api/livros/{livro}', [LivroController::class, 'show']);
Route::post('api/livros', [LivroController::class, 'store']);
Route::put('api/livros/{livro}', [LivroController::class, 'update']);
Route::delete('api/livros/{livro}', [LivroController::class, 'destroy']);

Route::get('api/categorias', [CategoriaController::class, 'index']);
Route::get('api/categorias/{categoria}', [CategoriaController::class, 'show']);
Route::post('api/categorias', [CategoriaController::class, 'store']);
Route::put('api/categorias/{categoria}', [CategoriaController::class, 'update']);
Route::delete('api/categorias/{categoria}', [CategoriaController::class, 'destroy']);
