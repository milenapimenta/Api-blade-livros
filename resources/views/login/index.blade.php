@extends('layouts.login')

@section('content')

<h2 class="text-center mb-4">Login</h2>

<form method="POST">
    @csrf
    <div class="form-group mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" name="email" id="email" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label for="password" class="form-label">Senha</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>

    <!-- Exibindo as mensagens de erro -->
    @if($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="d-flex align-items-center justify-content-center mt-5">
        <button class="btn btn-primary w-25">
            Entrar
        </button>
    
        <a href="{{ route('users.create') }}" class="btn btn-outline-primary ms-3">Cadastre-se</a>
    </div>
</form>

@endsection
