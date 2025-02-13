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
            width: 200px;
        }
    </style>

    <div class="container d-flex align-items-center min-height-100">
        <div class="row w-100 align-items-center justify-content-center">
            <div class="col-md-4 d-flex flex-column align-items-center">
                <img class="img" src="{{ asset('images/logo.png') }}" alt="">
                <h3 class="mt-3">Biblioteca</h3>
            </div>
            <div class="col-md-4">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/04661e5245.js" crossorigin="anonymous"></script>
</body>
</html>
