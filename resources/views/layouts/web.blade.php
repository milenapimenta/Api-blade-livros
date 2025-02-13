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

        .min-height-100 {
            min-height: 100vh;
        }

        .img {
            width: 50px;
        }
    </style>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a href="{{ route('home') }}" class="d-flex align-items-center navbar-brand">
                <img class="img" src="{{ asset('images/logo.png') }}" alt="">
                <h5 class="ms-2 mt-2">Biblioteca</h5>
            </a>
            @auth
                <a href="{{ route('logout') }}" class="btn btn-primary fw-bold">Sair</a>
            @endauth
        </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/04661e5245.js" crossorigin="anonymous"></script>
</body>
</html>
