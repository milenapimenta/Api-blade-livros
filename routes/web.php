<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\LivrosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('livros')->group(function () {
    Route::get('', [LivrosController::class, 'index'])->name('livros.index');

    // Rota GET para exibir o formulário de criação de livro
    Route::get('create', [LivrosController::class, 'create'])->name('livros.create');

    // Rota POST para salvar o livro
    Route::post('', [LivrosController::class, 'store'])->name('livros.store');

    Route::get('/{livro}', [LivrosController::class, 'show'])->name('livros.show');

    Route::get('/{livro}/editar', [LivrosController::class, 'edit'])->name('livros.edit');

    Route::put('/{livro}', [LivrosController::class, 'update'])->name('livros.update');

    Route::delete('/{livro}', [LivrosController::class, 'destroy'])->name('livros.destroy');
});

Route::prefix('categorias')->group(function () {
    Route::get('', [CategoriasController::class, 'index'])->name('categorias.index');

    // Rota GET para exibir o formulário de criação de livro
    Route::get('create', [CategoriasController::class, 'create'])->name('categorias.create');

    // Rota POST para salvar o livro
    Route::post('', [CategoriasController::class, 'store'])->name('categorias.store');

    Route::get('/{categoria}', [CategoriasController::class, 'show'])->name('categorias.show');

    Route::get('/{categoria}/editar', [CategoriasController::class, 'edit'])->name('categorias.edit');

    Route::put('/{categoria}', [CategoriasController::class, 'update'])->name('categorias.update');

    Route::delete('/{categoria}', [CategoriasController::class, 'destroy'])->name('categorias.destroy');
});
