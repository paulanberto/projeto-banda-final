@extends('layouts.fo_layout')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">{{ isset($band) ? 'Editar' : 'Criar' }} Banda</h1>

        <form action="{{ isset($band) ? route('bandas.update', $band->id) : route('bandas.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @if (isset($band))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="image" class="form-label">Imagem</label>
                @if (isset($band) && $band->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $band->image) }}" alt="{{ $band->name }}"
                            style="height: 100px; object-fit: cover;">
                    </div>
                @endif
                @if (Auth::check())
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                        name="image">
                    @if (isset($band))
                        <small class="form-text text-muted">Deixe em branco para manter a imagem atual.</small>
                    @endif
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                @endif
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nome da Banda</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                    {{ Auth::check() ? '' : 'disabled' }} id="name" name="name"
                    value="{{ old('name', $band->name ?? '') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                @if (Auth::check())
                    <button type="submit" class="btn btn-primary">
                        {{ isset($band) ? 'Atualizar' : 'Criar' }}
                    </button>
                @endif
                <a href="{{ route('bandas.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>



        @if (Auth::check() && Auth::user()->isAdmin())
            @if (isset($band))
                <form action="{{ route('bandas.destroy', $band->id) }}" method="POST"
                    onsubmit="return confirm('Tem certeza que deseja deletar esta banda?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Deletar</button>
                </form>
            @endif
        @endif
    </div>
@endsection
