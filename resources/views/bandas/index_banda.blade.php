@extends('layouts.fo_layout')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Bandas</h1>

        @if (Auth::check() && Auth::user()->isAdmin())
            <a class="btn btn-primary mb-5" href="{{ route('bandas.create') }}">Criar Nova Banda</a>
        @endif

        <div class="row">
            @forelse($bandas as $band)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if ($band->image)
                            <img src="{{ asset('storage/' . $band->image) }}" class="card-img-top"
                                style="height: 200px; object-fit: cover; width: 100%; margin: 0;" alt="{{ $band->name }}">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="fas fa-music fa-3x text-secondary"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $band->name }}</h5>
                            <p class="card-text">
                                <strong>Álbuns:</strong> {{ $band->albuns_count ? $band->albuns_count : 'Nenhum álbum' }}
                            </p>
                            <div class="text-center">
                                @if (Auth::check())
                                    <a href="{{ route('bandas.edit', $band) }}" class="btn btn-dark me-2">
                                        Editar</a>
                                @endif
                                <a href="{{ route('albuns.view', $band) }}" class="btn btn-dark me-2">Álbuns</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="alert alert-info">
                        Nenhuma banda cadastrada.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
