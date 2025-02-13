<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Livro;
use App\Services\LivroService;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    private $livroService;

    public function __construct(LivroService $service)
    {
        $this->livroService = $service;
    }

    public function index(Request $request)
    {
        if ($request->is('api/*')) {
            return response()->json([
                'status' => 200,
                'data' => $this->livroService->getPaginatedLivros($request),
            ]);
        }

        $livros = $this->livroService->getPaginatedLivros($request);
        return view('livros.index', compact('livros'));
    }

    public function store(Request $request)
    {
        if ($request->is('api/*')) {
            $livroCriado = $this->livroService->createLivro($request);
            return response()->json([
                'status' => 201,
                'livro' => $livroCriado
            ]);
        }

        $this->livroService->createLivro($request);
        return redirect()->route('livros.index');
    }

    public function show(Livro $livro)
    {
        if (request()->is('api/*')) {
            $livro = $this->livroService->showLivro($livro->id);
            return response()->json([
                'status' => 200,
                'livro' => $livro
            ]);
        }

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
        if ($request->is('api/*')) {
            $livroAtualizado = $this->livroService->updateLivro($request, $livro->id);
            return response()->json([
                'status' => 200,
                'livro' => $livroAtualizado
            ]);
        }

        $this->livroService->updateLivro($request, $livro->id);
        return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy(Request $request, Livro $livro)
    {
        if ($request->is('api/*')) {
            $livroDeletado = $this->livroService->deletarLivro($livro->id);
            return response()->json([
                'status' => 200,
                'livro' => $livroDeletado
            ]);
        }

        $this->livroService->deletarLivro($livro->id);
        return redirect()->route('livros.index')->with('success', 'Livro excluído com sucesso!');
    }
}
