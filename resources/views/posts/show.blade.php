@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="page-container">

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <article class="post-detail">

        <header class="post-header">
            <h1>{{ $post->title }}</h1>
            <p class="post-meta">
                Por <strong>{{ $post->user->name }}</strong>
                &mdash;
                {{ $post->created_at->format('d/m/Y H:i') }}
            </p>
        </header>

        <div class="post-body">
            {{-- {{ }} escapa HTML → protección XSS --}}
            {!! nl2br(e($post->body)) !!}
        </div>

        <footer class="post-footer">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">← Volver</a>

            @if (auth()->id() === $post->user_id)
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Editar</a>

                <form method="POST" action="{{ route('posts.destroy', $post) }}"
                      onsubmit="return confirm('¿Eliminar esta publicación?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            @endif
        </footer>

    </article>

</div>
@endsection
