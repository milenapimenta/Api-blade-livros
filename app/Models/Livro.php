<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Livro extends Model
{
    use SoftDeletes;

    protected $table = 'livros';
    protected $fillable = ['capa', 'titulo', 'sinopse', 'autor', 'editora', 'ano'];
    protected $appends = ['limited_sinopse'];

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

    public function getLimitedTituloAttribute()
    {
        return Str::limit($this->titulo, 18);
    }

    public function getLimitedSinopseAttribute()
    {
        return Str::limit($this->sinopse, 50);
    }
}
