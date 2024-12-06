@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <div class="d-flex align-items-center">
            <a href="{{ route('categorias.index') }}" class="btn btn-secondary fw-bold me-4">
                <i class="fa-solid fa-arrow-left me-1"></i>
                Voltar
            </a>
            <h3 class="text-center my-4">Detalhes da Categoria</h3>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-primary fw-bold"><i class="fa-solid fa-pen-to-square me-1"></i> Editar</a>
            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button
                    type="submit"
                    class="btn btn-danger fw-bold"
                    onclick="return confirm('Tem certeza de que deseja excluir esta categoria?');"
                >
                    <i class="fa-solid fa-trash me-1"></i> Excluir
                </button>
            </form>
        </div>
    </div>

    <p><span class="fw-bold me-1">Nome:</span> {{ $categoria->nome }}</p>
    <p><span class="fw-bold me-1">Livros nesta categoria:</span>
        @if ($categoria->livros->isNotEmpty())
            @foreach ($categoria->livros as $livro)
                <span class="badge bg-primary ms-1">{{ $livro->titulo }}</span>
            @endforeach
        @else
            <span class="text-muted">Nenhum livro associado</span>
        @endif
    </p>
</div>

<script src="https://kit.fontawesome.com/04661e5245.js" crossorigin="anonymous"></script>
@endsection
