<?php

namespace App\Services;

use App\Repositories\CategoriaRepository;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaService
{
    private $categoriaRepository;

    public function __construct(CategoriaRepository $repository)
    {
        $this->categoriaRepository = $repository;
    }

    public function getPaginatedCategorias(Request $request)
    {
        $perPage = $request->get('perPage') ?? 5;
        $page = $request->get('page') ?? 1;
        $columns = $this->getColumns($request->get('columns'));

        return $this->categoriaRepository->getPaginatedCategorias($columns, $perPage, $page);
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

    public function createCategoria(Request $request)
    {
        $data = $request->all();

        return $this->categoriaRepository->createCategoria($data);
    }

    public function showCategoria(int $id)
    {
        return $this->categoriaRepository->showCategoria($id);
    }

    public function updateCategoria(Request $request, int $id)
    {
        return $this->categoriaRepository->updateCategoria($request, $id);
    }

    public function deletarCategoria(int $id)
    {
        return $this->categoriaRepository->deletarCategoria($id);
    }
}
