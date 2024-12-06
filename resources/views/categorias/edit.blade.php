@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="my-2 mb-4">Editar Categoria</h3>

    <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label fw-bold">Nome da Categoria</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $categoria->nome }}" required>
        </div>

        <button type="submit" class="btn btn-primary fw-bold">Salvar</button>
        <a href="{{ route('categorias.index') }}" class="btn btn-secondary fw-bold">Cancelar</a>
    </form>
</div>
@endsection
