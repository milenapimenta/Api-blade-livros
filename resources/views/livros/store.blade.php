@php
    $categorias = App\Models\Categoria::all();
@endphp

@extends('layouts.app')

@section('content')

<!-- Adicionando o link para o CDN do Bootstrap no <head> -->
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

<!-- Formulário para adicionar um livro -->
<form class="container" action="{{ route('livros.store') }}" method="POST" enctype="multipart/form-data">
    <h3 class="pt-2 pb-3">Criar Livro</h3>
    @csrf

    <div class="mb-3">
        <label for="capa" class="form-label fw-bold">Capa</label>
        <input type="file" class="form-control" id="capa" name="capa">
    </div>

    <div class="mb-3">
        <label for="titulo" class="form-label fw-bold">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo" required>
    </div>

    <div class="mb-3">
        <label for="sinopse" class="form-label fw-bold">Sinopse</label>
        <textarea class="form-control" id="sinopse" name="sinopse" required></textarea>
    </div>

    <div class="mb-3">
        <label for="autor" class="form-label fw-bold">Autor</label>
        <input type="text" class="form-control" id="autor" name="autor" required>
    </div>

    <div class="mb-3">
        <label for="editora" class="form-label fw-bold">Editora</label>
        <input type="text" class="form-control" id="editora" name="editora" required>
    </div>

    <div class="mb-3">
        <label for="ano" class="form-label fw-bold">Ano</label>
        <input type="number" class="form-control" id="ano" name="ano" required>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Categorias</label>
        <div class="form-check">
            @foreach ($categorias as $categoria)
                <input type="checkbox" class="form-check-input" id="categoria{{ $categoria->id }}" name="categorias[]" value="{{ $categoria->id }}">
                <label class="form-check-label" for="categoria{{ $categoria->id }}">{{ $categoria->nome }}</label><br>
            @endforeach
        </div>
    </div>

    <button type="submit" class="btn btn-primary fw-bold">Salvar</button>
    <a href="{{ route('livros.index') }}" class="btn btn-secondary fw-bold">Cancelar</a>
</form>

<!-- Adicionando o script do Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/04661e5245.js" crossorigin="anonymous"></script>

@endsection
