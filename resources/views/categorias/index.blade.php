@extends('layouts.app')

@section('content')
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
        <h3 class="text-center">Lista de Categorias</h3>
        <a href="{{ route('categorias.create') }}" class="btn btn-primary fw-bold">Criar Categoria</a>
    </div>

    <table class="table table-striped border-secondary-subtle">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
                <tr class="align-middle">
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->nome }}</td>
                    <td>
                        <a
                            href="{{ route('categorias.show', $categoria->id) }}"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Visualizar"
                            class="btn btn-secondary btn-sm"
                        >
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a
                            href="{{ route('categorias.edit', $categoria->id) }}"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Editar"
                            class="btn btn-primary btn-sm"
                        >
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Excluir"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Tem certeza de que deseja excluir esta categoria?');"
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
        {{ $categorias->links('pagination::bootstrap-5') }}
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/04661e5245.js" crossorigin="anonymous"></script>
@endsection
