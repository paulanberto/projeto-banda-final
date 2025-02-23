@extends('layouts.fo_layout')
@section('content')
    <div class="home mt-4">
        <div class="text-center">
            @auth
                <h1 class="mb-4">Olá, {{ Auth::user()->name }}</h1>

                @if (Auth::check() && Auth::user()->isAdmin())
                    <div class="alert alert-light" role="alert">
                        <h4 class="alert-heading">Atenção!</h4>
                        <p>Esta é uma conta de administrador</p>
                    </div>
                @endif
            @endauth
        </div>
    </div>
@endsection
