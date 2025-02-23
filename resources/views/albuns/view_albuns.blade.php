@extends('layouts.fo_layout')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Álbuns de {{ $band->name }}</h1>

        @if (Auth::check() && Auth::user()->isAdmin())
            <div class="mb-3">
                <a href="{{ route('albuns.create', $band) }}" class="btn btn-primary">Novo Álbum</a>
            </div>
        @endif

        <div class="mb-3">
            <a href="{{ route('bandas.index') }}" class="btn btn-secondary">Voltar para Bandas</a>
        </div>

        <div class="row">
            @forelse($albuns as $album)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if ($album->image)
                            <img src="{{ asset('storage/' . $album->image) }}" class="card-img-top"
                                alt="{{ $album->name }}" style="height: 200px; object-fit: cover; width: 100%; margin: 0;">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                style="height: 200px;">
                                <i class="fas fa-compact-disc fa-3x text-secondary"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $album->name }}</h5>
                            <p class="card-text">
                                <strong>Lançamento:</strong> {{ date('d/m/Y', strtotime($album->release_date)) }}
                            </p>
                            <div class="d-flex">
                                @if (Auth::check() && Auth::user()->isAdmin())
                                    <a href="{{ route('albuns.edit', $album) }}" class="btn btn-dark me-2">Editar</a>
                                @endif
                                @if (Auth::check() && Auth::user()->isAdmin())
                                    <form action="{{ route('albuns.destroy', $album) }}" method="POST"
                                        onsubmit="return confirm('Tem certeza que deseja excluir este álbum?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Excluir</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="alert alert-info">
                        Nenhum álbum cadastrado para esta banda.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
