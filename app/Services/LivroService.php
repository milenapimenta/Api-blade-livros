<?php

namespace App\Services;

use App\Repositories\LivroRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'capa' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'titulo' => 'required|string|max:255',
            'sinopse' => 'required|string',
            'autor' => 'required|string|max:255',
            'editora' => 'required|string|max:255',
            'ano' => 'required|integer|min:1000|max:' . date('Y'),
            'categorias' => 'nullable|array|exists:categorias,id',
        ]);

        if ($request->hasFile('capa')) {
            $capaPath = $request->file('capa')->store('public/capas');
            $validated['capa'] = json_encode(['url' => Storage::url($capaPath)]);

            $request->capa->move(public_path('storage/capas'), $capaPath);
        }

        $livro = $this->livroRepository->createLivro($validated);
        $livro->categorias()->sync($request->input('categorias', []));

        return $livro;
    }

    public function showLivro(int $id)
    {
        return $this->livroRepository->showLivro($id);
    }

    public function updateLivro(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'capa' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'titulo' => 'required|string|max:255',
            'sinopse' => 'required|string',
            'autor' => 'required|string|max:255',
            'editora' => 'required|string|max:255',
            'ano' => 'required|integer|min:1000|max:' . date('Y'),
            'categorias' => 'nullable|array',
        ]);

        if ($request->hasFile('capa')) {
            $capaPath = $request->file('capa')->store('public/capas');
            $validatedData['capa'] = json_encode(['url' => Storage::url($capaPath)]);

            $request->capa->move(public_path('storage/capas'), $capaPath);
        }
        
        $livro = $this->livroRepository->updateLivro($validatedData, $id);
        $livro->categorias()->sync($request->input('categorias', []));

        return $livro;

    }

    public function deletarLivro(int $id)
    {
        return $this->livroRepository->deletarLivro($id);
    }
}
