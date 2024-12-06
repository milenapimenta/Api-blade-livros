<?php

namespace App\Repositories;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaRepository
{

    private $model;

    public function __construct(Categoria $model)
    {
        $this->model = $model;
    }

    public function getPaginatedCategorias($columns = ['*'], $perPage = null, $page = null)
    {
        if (!$perPage || !$page) {
            return $this->model->get($columns);
        }

        return $this->model->paginate($perPage, $columns, 'page', $page);
    }
    public function getColumns($columns)
    {
        return $columns ?? ['*'];

        if (is_array($columns)) {
            return array_map('trim', $columns);
        }

        return explode(',', $columns);
    }

    public function createCategoria(array $data)
    {
        return $this->model->create($data);
    }

    public function showCategoria(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function updateCategoria(Request $request, int $id)
    {
        $categoria = $this->model->findOrFail($id);
        $categoria->update($request->all());

        return $categoria;
    }

    public function deletarCategoria(int $id)
    {
        $categoria = $this->model->findOrFail($id);
        $categoria->delete();

        return $categoria;
    }
}
