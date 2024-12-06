<?php

use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\LivroController;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/livros', [LivroController::class, 'index']);
Route::get('/livros/{livro}', [LivroController::class, 'show']);
Route::post('/livros', [LivroController::class, 'store']);
Route::put('/livros/{livro}', [LivroController::class, 'update']);
Route::delete('/livros/{livro}', [LivroController::class, 'destroy']);

Route::get('/categorias', [CategoriaController::class, 'index']);
Route::get('/categorias/{categoria}', [CategoriaController::class, 'show']);
Route::post('/categorias', [CategoriaController::class, 'store']);
Route::put('/categorias/{categoria}', [CategoriaController::class, 'update']);
Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy']);
