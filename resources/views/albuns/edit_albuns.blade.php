@extends('layouts.fo_layout')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Editar Álbum de {{ $band->name }}</h1>

        <form action="{{ route('albuns.update', $album) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nome do Álbum</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $album->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="release_date" class="form-label">Data de Lançamento</label>
                <input type="date" class="form-control @error('release_date') is-invalid @enderror" id="release_date"
                    name="release_date" value="{{ old('release_date', $album->release_date->format('Y-m-d')) }}" required>
                @error('release_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Imagem</label>
                @if ($album->image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($album->image) }}" alt="{{ $album->name }}"
                            style="height: 100px; object-fit: cover;">
                    </div>
                @endif
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                    name="image">
                <small class="form-text text-muted">Deixe em branco para manter a imagem atual.</small>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="{{ route('albuns.view', $album->id) }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
