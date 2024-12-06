<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;

    protected $table = 'categorias';
    protected $fillable = [
        'nome'
    ];

    public function livros()
    {
        return $this->belongsToMany(
            Livro::class,
            'livro_categoria',
            'categoria_id',
            'livro_id'
        );
    }
}
