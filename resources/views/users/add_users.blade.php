@extends('layouts.fo_layout')
@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Registar Usuário</h1>
        <form method="POST" action="{{ route('users.create') }}">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nome</label>
                <input type="text" name="name" class="form-control" aria-describedby="emailHelp">
                @error('name')
                    name inválido
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                @error('email')
                    email inválido
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                @error('password')
                    password inválida
                @enderror
            </div>

            <button type="submit" class="btn btn-dark">Salvar</button>
        </form>
    </div>
@endsection
