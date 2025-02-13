<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Services\CategoriaService;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    private $categoriaService;

    public function __construct(CategoriaService $service)
    {
        $this->categoriaService = $service;
    }

    // Métodos para interface Web e API
    public function index(Request $request)
    {
        // Verificar se a requisição é da API
        if ($request->is('api/*')) {
            return response()->json([
                'status' => 200,
                'data' => $this->categoriaService->getPaginatedCategorias($request),
            ]);
        }

        // Caso não seja API, renderizar a view
        $categorias = $this->categoriaService->getPaginatedCategorias($request);
        return view('categorias.index', compact('categorias'));
    }

    public function store(Request $request)
    {
        // Verificar se é uma requisição da API
        if ($request->is('api/*')) {
            $categoriaCriada = $this->categoriaService->createCategoria($request);
            return response()->json([
                'status' => 201,
                'categoria' => $categoriaCriada
            ]);
        }

        // Caso contrário, processa a criação da categoria e redireciona
        $this->categoriaService->createCategoria($request);
        return redirect()->route('categorias.index');
    }

    public function show(Categoria $categoria)
    {
        // Verificar se é da API
        if (request()->is('api/*')) {
            $categoria = $this->categoriaService->showCategoria($categoria->id);
            return response()->json([
                'status' => 200,
                'categoria' => $categoria
            ]);
        }

        // Caso contrário, renderizar a view
        $categoria = $this->categoriaService->showCategoria($categoria->id);
        return view('categorias.show', compact('categoria'));
    }

    public function create()
    {
        return view('categorias.store');
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        // Verificar se a requisição é da API
        if ($request->is('api/*')) {
            $categoriaAtualizada = $this->categoriaService->updateCategoria($request, $categoria->id);
            return response()->json([
                'status' => 200,
                'categoria' => $categoriaAtualizada
            ]);
        }

        // Caso contrário, atualizar e redirecionar
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
        ]);

        $categoria->update($validatedData);
        return redirect()->route('categorias.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy(Request $request, Categoria $categoria)
    {
        // Verificar se é da API
        if ($request->is('api/*')) {
            $categoriaDeletada = $this->categoriaService->deletarCategoria($categoria->id);
            return response()->json([
                'status' => 200,
                'categoria' => $categoriaDeletada
            ]);
        }

        // Caso contrário, deletar e redirecionar
        $this->categoriaService->deletarCategoria($categoria->id);
        return redirect()->route('categorias.index')->with('success', 'Categoria excluída com sucesso!');
    }
}
