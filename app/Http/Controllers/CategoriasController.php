<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Services\CategoriaService;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    private $categoriaService;

    public function __construct(CategoriaService $service)
    {
        $this->categoriaService = $service;
    }

    public function index(Request $request)
    {
        $categorias = $this->categoriaService->getPaginatedCategorias($request);
        return view('categorias.index', compact('categorias'));
    }
    public function store(Request $request)
    {
        $this->categoriaService->createCategoria($request);

        return redirect()->route('categorias.index');
    }

    public function show(Categoria $categoria)
    {
        $categoria = $this->categoriaService->showCategoria($categoria->id);

        return view('categorias.show', compact('categoria'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('categorias.store', compact('categorias'));
    }

    public function edit(Categoria $categoria)
    {
        $categorias = Categoria::all();
        return view('categorias.edit', compact('categoria'));
    }
    public function update(Request $request, Categoria $categoria)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'editora' => 'required|string|max:255',
            'ano' => 'required|integer|min:1000|max:' . date('Y'),
            'categorias' => 'nullable|array',
        ]);

        $categoria->update($validatedData);
        $categoria->categorias()->sync($request->input('categorias', []));

        return redirect()->route('categorias.index')->with('success', 'categoria atualizada com sucesso!');
    }

    public function destroy(Categoria $categoria)
    {
        $this->categoriaService->deletarCategoria($categoria->id);

        return redirect()->route('categorias.index')->with('success', 'categoria excluída com sucesso!');
    }
}
