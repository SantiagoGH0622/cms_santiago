@extends('layouts.app')

@section('title', 'Editar: ' . $post->title)

@section('content')
<div class="page-container form-container">

    <div class="page-header">
        <h1>Editar publicación</h1>
        <a href="{{ route('posts.show', $post) }}" class="btn btn-secondary">← Volver</a>
    </div>

    <form method="POST" action="{{ route('posts.update', $post) }}">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="title">Título</label>
            <input
                id="title"
                type="text"
                name="title"
                value="{{ old('title', $post->title) }}"
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
            >{{ old('body', $post->body) }}</textarea>
            @error('body')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <a href="{{ route('posts.show', $post) }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>

</div>
@endsection
