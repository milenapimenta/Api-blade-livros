<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    public function index(Request $request)
    {
        return response()->json([
            'status' => 200,
            'data' => $this->categoriaService->getPaginatedCategorias($request),
        ]);
    }

    public function store(Request $request)
    {
        $categoriaCriada = $this->categoriaService->createCategoria($request);

        return response()->json([
            'status' => 201,
            'categoria' => $categoriaCriada
        ]);
    }

    public function show(Categoria $categoria)
    {
        $categoria = $this->categoriaService->showCategoria($categoria->id);

        return response()->json([
            'status' => 200,
            'categoria' => $categoria
        ]);
    }

    public function update(Request $request, Categoria $categoria)
    {
        $categoria = $this->categoriaService->updateCategoria($request, $categoria->id);

        return response()->json([
            'status' => 200,
            'categoria' => $categoria
        ]);
    }

    public function destroy(Categoria $categoria)
    {
        $categoria = $this->categoriaService->deletarCategoria($categoria->id);

        return response()->json([
            'status' => 200,
            'categoria' => $categoria
        ]);
    }
}
