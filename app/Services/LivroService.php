<?php

namespace App\Services;

use App\Repositories\LivroRepository;
use Illuminate\Http\Request;

class LivroService
{
    private $livroRepository;

    public function __construct(LivroRepository $repository)
    {
        $this->livroRepository = $repository;
    }

    public function getPaginatedLivros(Request $request)
    {
        if ($request->has('titulo')) {
            return $this->livroRepository->searchLivros($request->get('titulo'));
        }

        $perPage = $request->get('perPage') ?? 5;
        $page = $request->get('page') ?? 1;
        $columns = $this->getColumns($request->get('columns')) ?? ['*'];

        return $this->livroRepository->getPaginatedLivros($columns, $perPage, $page);
    }

    private function getColumns($col)
    {
        if (!$col) {
            return ['*'];
        }

        if (is_array($col)) {
            return array_map('trim', $col);
        }

        if (is_string($col)) {
            return array_map('trim', explode(',', $col));
        }

        return ['*'];
    }

    public function createLivro(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'editora' => 'required|string|max:255',
            'ano' => 'required|integer|min:1000|max:' . date('Y'),
            'categorias' => 'array|exists:categorias,id',
        ]);

        $livro = $this->livroRepository->createLivro($validated);

        if (!empty($validated['categorias'])) {
            $livro->categorias()->sync($validated['categorias']);
        }

        return $livro;
    }

    public function showLivro(int $id)
    {
        return $this->livroRepository->showLivro($id);
    }

    public function updateLivro(Request $request, int $id)
    {
        return $this->livroRepository->updateLivro($request, $id);
    }

    public function deletarLivro(int $id)
    {
        return $this->livroRepository->deletarLivro($id);
    }
}
