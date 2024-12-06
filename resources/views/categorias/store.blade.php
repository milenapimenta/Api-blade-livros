@extends('layouts.app')

@section('content')

<!-- Adicionando o link para o CDN do Bootstrap no <head> -->
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

<!-- Formulário para adicionar uma categoria -->
<form class="container" action="{{ route('categorias.store') }}" method="POST">
    <h3 class="pt-2 pb-3">Criar Categoria</h3>
    @csrf

    <div class="mb-3">
        <label for="nome" class="form-label fw-bold">Nome da Categoria</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
    </div>

    <button type="submit" class="btn btn-primary fw-bold">Salvar</button>
    <a href="{{ route('categorias.index') }}" class="btn btn-secondary fw-bold">Cancelar</a>
</form>

<!-- Adicionando o script do Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/04661e5245.js" crossorigin="anonymous"></script>

@endsection
