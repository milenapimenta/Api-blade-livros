@extends('layouts.web')

@section('content')

<div class="container mt-4">
    <h3 class="mb-5">Lista de livros</h3>
    <div class="row">
        @foreach ($livros as $livro)
            <div class="col-2 col-md-2 col-sm-6 col-12 mb-4">
                <div class="card">
                    @if ($livro->capa)
                        @php
                            $capa = json_decode($livro->capa, true);
                            $url = $capa['url'];
                        @endphp
                        <img src="{{ asset($url) }}" class="card-img-top" alt="Capa do Livro" style="object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Capa do Livro">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $livro->limited_titulo }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Autor: {{ $livro->autor }}</h6>
                        <h6 class="card-subtitle mb-2 text-muted">Editora: {{ $livro->editora }} - {{ $livro->ano }}</h6>
                        <p class="card-text">{{ $livro->limited_sinopse }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/04661e5245.js" crossorigin="anonymous"></script>

@endsection
