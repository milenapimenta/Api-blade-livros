<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Autenticador;
use App\Services\LivroService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $livroService = app()->make(LivroService::class);
    $livros = $livroService->getPaginatedLivros(request());

    return view('welcome', ['livros' => $livros]);
})->name('home')->middleware(Autenticador::class);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('signin');
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/register', [UsersController::class, 'create'])->name('users.create');
Route::post('/register', [UsersController::class, 'store'])->name('users.store');

Route::prefix('livros')->group(function () {
    Route::get('', [LivroController::class, 'index'])->name('livros.index');

    // Rota GET para exibir o formulário de criação de livro
    Route::get('create', [LivroController::class, 'create'])->name('livros.create');

    // Rota POST para salvar o livro
    Route::post('', [LivroController::class, 'store'])->name('livros.store');

    Route::get('/{livro}', [LivroController::class, 'show'])->name('livros.show');

    Route::get('/{livro}/editar', [LivroController::class, 'edit'])->name('livros.edit');

    Route::put('/{livro}', [LivroController::class, 'update'])->name('livros.update');

    Route::delete('/{livro}', [LivroController::class, 'destroy'])->name('livros.destroy');
});

Route::prefix('categorias')->group(function () {
    Route::get('', [CategoriaController::class, 'index'])->name('categorias.index');

    // Rota GET para exibir o formulário de criação de livro
    Route::get('create', [CategoriaController::class, 'create'])->name('categorias.create');

    // Rota POST para salvar o livro
    Route::post('', [CategoriaController::class, 'store'])->name('categorias.store');

    Route::get('/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');

    Route::get('/{categoria}/editar', [CategoriaController::class, 'edit'])->name('categorias.edit');

    Route::put('/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');

    Route::delete('/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
});
