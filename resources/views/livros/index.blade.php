@php
    $categorias = App\Models\Categoria::all();
@endphp

@extends('layouts.app')

@section('content')
    <!-- Adicionando o link para o CDN do Bootstrap no <head> -->

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show position-fixed end-0 bottom-0 m-3" id="alert-success" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4 pt-2">
        <h3 class="text-center">Lista de Livros</h3>
        <a href="{{ route('livros.create') }}" class="btn btn-primary fw-bold">Criar Livro</a>
    </div>

    <table class="table table-striped border-secondary-subtle">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Título</th>
                <th scope="col">Autor</th>
                <th scope="col">Editora</th>
                <th scope="col">Ano</th>
                <th scope="col">Categorias</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($livros as $livro)
                <tr class="align-middle">
                    <td>{{ $livro->id }}</td>
                    <td>{{ $livro->titulo }}</td>
                    <td>{{ $livro->autor }}</td>
                    <td>{{ $livro->editora }}</td>
                    <td>{{ $livro->ano }}</td>
                    <td>
                        @foreach ($livro->categorias as $categoria)
                            <span class=" text-center badge bg-white text-primary border border-primary mb-1">{{ $categoria->nome }}</span><br>
                        @endforeach
                    </td>
                    <td>
                        <a
                            href="{{ route('livros.show', $livro->id) }}"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Visualizar"
                            class="btn btn-secondary btn-sm"
                        >
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a
                            href="{{ route('livros.edit', $livro->id) }}"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Editar"
                            class="btn btn-primary btn-sm"
                        >
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('livros.destroy', $livro->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Excluir"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Tem certeza de que deseja excluir este livro?');"
                            >
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $livros->links('pagination::bootstrap-5') }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl)
            })
        })
    </script>

    <script>
        setTimeout(() => {
            const alert = document.getElementById('alert-success');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000);
    </script>

    <!-- Adicionando o script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/04661e5245.js" crossorigin="anonymous"></script>
@endsection