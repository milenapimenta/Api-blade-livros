<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Minha Aplicação')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <style>
        .bg-nav-item {
            background-color: #0a478373 !important;
        }

        .bg-blue {
            background-color: #001F3D;
        }

        .text-blue {
            color: #001F3D;
        }
    </style>

    <div class="d-flex">
        <!-- Barra de navegação lateral -->
        <div class="bg-blue border-end" style="width: 250px; min-height: 100vh;">
            <h3 class="mt-4 pt-2 ps-4 text-white">Biblioteca</h3>
            <ul class="nav flex-column p-3">
                <li class="nav-item mb-2 rounded {{ Route::is('livros.index') ? 'bg-nav-item' : '' }}">
                    <a class="nav-link text-white" href="{{ route('livros.index') }}">
                        <i class="fa-solid fa-book me-2"></i> Livros
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white rounded {{ Route::is('categorias.index') ? 'bg-nav-item' : '' }}" href="{{ route('categorias.index') }}">
                        <i class="fa-solid fa-list me-2"></i>Categorias
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white rounded {{ Route::is('home') ? 'bg-nav-item' : '' }}" href="{{ route('home') }}">
                        <i class="fa-solid fa-globe me-2"></i>Website
                    </a>
                </li>
                @auth
                <div class="position-absolute bottom-0">
                    <div class="d-flex w-100 justify-content-between align-items-center me-4 mb-4">
                        <p class="text-white fw-bold mt-3 me-5">Olá, {{ Auth::user()->name }}!</p>
                        <a href="{{ route('logout') }}" class="btn btn-light text-blue fw-bold">Sair</a>
                    </div>
                </div>
                @endauth
            </ul>
        </div>

        <!-- Conteúdo principal -->
        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/04661e5245.js" crossorigin="anonymous"></script>
</body>
</html>
