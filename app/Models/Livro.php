<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Livro extends Model
{
    use SoftDeletes;

    protected $table = 'livros';
    protected $fillable = ['titulo', 'autor', 'editora', 'ano'];

    public function categorias()
    {
        return $this->belongsToMany(
            Categoria::class,
            'livro_categoria',
            'livro_id',
            'categoria_id'
        );
    }

    protected static function booted()
    {
        static::addGlobalScope('ordered', function (EloquentBuilder $queryBuilder) {
            $queryBuilder->orderBy('id', 'desc');
        });
    }
}
