<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Livro;
use App\Services\LivroService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LivrosController extends Controller
{
    private $livroService;

    public function __construct(LivroService $service)
    {
        $this->livroService = $service;
    }

    public function index(Request $request)
    {
        $livros = $this->livroService->getPaginatedLivros($request);
        return view('livros.index', compact('livros'));
    }
    public function store(Request $request)
    {
        $this->livroService->createLivro($request);

        return redirect()->route('livros.index');
    }

    public function show(Livro $livro)
    {
        $livro = $this->livroService->showLivro($livro->id);

        return view('livros.show', compact('livro'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('livros.store', compact('categorias'));
    }

    public function edit(Livro $livro)
    {
        $categorias = Categoria::all();
        return view('livros.edit', compact('livro', 'categorias'));
    }
    public function update(Request $request, Livro $livro)
    {
        $this->livroService->updateLivro($request, $livro->id);

        return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy(Livro $livro)
    {
        $this->livroService->deletarLivro($livro->id);

        return redirect()->route('livros.index')->with('success', 'Livro excluído com sucesso!');
    }
}
