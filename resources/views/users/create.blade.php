@extends('layouts.login')

@section('content')

<h2 class="text-center mb-4">Cadastre-se</h2>
<form method="POST">
    @csrf
    <div class="form-group mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" name="email" id="email" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label for="password" class="form-label">Senha</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>

    <div class="d-flex align-items-center justify-content-center">
        <button class="btn btn-primary mt-3 pe-4 ps-4">
            Cadastrar
        </button>
    </div>

</form>

@endsection