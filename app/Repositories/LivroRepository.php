<?php

namespace App\Repositories;

use App\Models\Livro;
use Illuminate\Http\Request;

class LivroRepository
{
    private $model;

    public function __construct(Livro $model)
    {
        $this->model = $model;
    }

    public function getPaginatedLivros($columns, $perPage, $page)
    {
        return $this->model->paginate($perPage, $columns, 'page', $page)->withQueryString();
    }

    public function createLivro(array $data)
    {
        return $this->model->create($data);
    }

    public function showLivro(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function updateLivro(Request $request, int $id)
    {
        $livro = $this->model->findOrFail($id);
        $livro->update($request->all());

        return $livro;
    }

    public function deletarLivro(int $id)
    {
        $livro = $this->model->findOrFail($id);
        $livro->delete();

        return $livro;
    }
}
