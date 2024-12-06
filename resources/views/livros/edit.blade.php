@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="my-2 mb-4">Editar Livro</h3>

    <form action="{{ route('livros.update', $livro->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label fw-bold">Título do Livro</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $livro->titulo }}" required>
        </div>

        <div class="mb-3">
            <label for="autor" class="form-label fw-bold">Autor</label>
            <input type="text" class="form-control" id="autor" name="autor" value="{{ $livro->autor }}" required>
        </div>

        <div class="mb-3">
            <label for="editora" class="form-label fw-bold">Editora</label>
            <input type="text" class="form-control" id="editora" name="editora" value="{{ $livro->editora }}" required>
        </div>

        <div class="mb-3">
            <label for="ano" class="form-label fw-bold">Ano</label>
            <input type="number" class="form-control" id="ano" name="ano" value="{{ $livro->ano }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Categorias</label>
            <div class="form-check">
                @foreach ($categorias as $categoria)
                    <input type="checkbox" class="form-check-input"
                        id="categoria{{ $categoria->id }}"
                        name="categorias[]"
                        value="{{ $categoria->id }}"
                        {{ $livro->categorias->contains($categoria->id) ? 'checked' : '' }}>
                    <label class="form-check-label" for="categoria{{ $categoria->id }}">{{ $categoria->nome }}</label><br>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary fw-bold">Salvar</button>
        <a href="{{ route('livros.index') }}" class="btn btn-secondary fw-bold">Cancelar</a>
    </form>
</div>
@endsection
