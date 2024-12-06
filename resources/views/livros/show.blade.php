@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <div class="d-flex align-items-center">
            <a href="{{ route('livros.index') }}" class="btn btn-secondary fw-bold me-4">
                <i class="fa-solid fa-arrow-left me-1"></i>
                Voltar
            </a>
            <h3 class="text-center my-2">Detalhes do Livro</h3>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('livros.edit', $livro->id) }}" class="btn btn-primary fw-bold"><i class="fa-solid fa-pen-to-square me-1"></i> Editar</a>
            <form action="{{ route('livros.destroy', $livro->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button
                    type="submit"
                    class="btn btn-danger fw-bold"
                    onclick="return confirm('Tem certeza de que deseja excluir este livro?');"
                >
                    <i class="fa-solid fa-trash me-1"></i> Excluir
                </button>
            </form>
        </div>
    </div>

    <p><span class="fw-bold me-1">Título:</span> {{ $livro->titulo }}</p>
    <p><span class="fw-bold me-1">Autor:</span> {{ $livro->autor }}</p>
    <p><span class="fw-bold me-1">Editora:</span> {{ $livro->editora }}</p>
    <p><span class="fw-bold me-1">Ano:</span> {{ $livro->ano }}</p>
    <p><span class="fw-bold me-1">Categorias:</span>
        @foreach ($livro->categorias as $categoria)
            <span class="badge bg-primary ms-1">{{ $categoria->nome }}</span>
        @endforeach
    </p>
</div>

<script src="https://kit.fontawesome.com/04661e5245.js" crossorigin="anonymous"></script>
@endsection
