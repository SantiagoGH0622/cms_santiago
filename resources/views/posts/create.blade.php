@extends('layouts.app')

@section('title', 'Nueva publicación')

@section('content')
<div class="page-container form-container">

    <div class="page-header">
        <h1>Nueva publicación</h1>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">← Volver</a>
    </div>

    <form method="POST" action="{{ route('posts.store') }}">
        @csrf

        <div class="form-group">
            <label for="title">Título</label>
            <input
                id="title"
                type="text"
                name="title"
                value="{{ old('title') }}"
                maxlength="150"
                required
                autofocus
            >
            @error('title')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="body">Contenido</label>
            <textarea
                id="body"
                name="body"
                rows="10"
                maxlength="10000"
                required
            >{{ old('body') }}</textarea>
            @error('body')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Publicar</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>

</div>
@endsection
