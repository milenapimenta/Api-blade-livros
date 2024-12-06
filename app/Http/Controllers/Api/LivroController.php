<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        return response()->json([
            'status' => 200,
            'data' => $this->livroService->getPaginatedLivros($request),
        ]);
    }

    public function store(Request $request)
    {
        $livroCriado = $this->livroService->createLivro($request);

        return response()->json([
            'status' => 201,
            'livro' => $livroCriado
        ]);
    }

    public function show(Livro $livro)
    {
        $livro = $this->livroService->showLivro($livro->id);

        return response()->json([
            'status' => 200,
            'livro' => $livro
        ]);
    }

    public function update(Request $request, Livro $livro)
    {
        $livro = $this->livroService->updateLivro($request, $livro->id);

        return response()->json([
            'status' => 200,
            'livro' => $livro
        ]);
    }

    public function destroy(Livro $livro)
    {
        $livro = $this->livroService->deletarLivro($livro->id);

        return response()->json([
            'status' => 200,
            'livro' => $livro
        ]);
    }
}
