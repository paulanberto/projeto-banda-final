@extends('layouts.fo_layout')

@section('title', 'Home')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <div class="banner">
        <h1 class="mb-4">Bem-vindo Palco Virtual</h1>

        <a href="{{ route('bandas.index') }}" class="btn btn-dark">Ver Bandas</a>
    </div>
@endsection
