@extends('layouts.app')

@section('title', 'Publicaciones')

@section('content')
<div class="page-container">

    <div class="page-header">
        <h1>Publicaciones</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Nueva publicación</a>
    </div>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @if ($posts->count())
        <table class="table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>
                            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                        </td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->created_at->format('d/m/Y') }}</td>
                        <td class="table-actions">
                            <a href="{{ route('posts.show', $post) }}">Ver</a>

                            @if (auth()->id() === $post->user_id)
                                <a href="{{ route('posts.edit', $post) }}">Editar</a>

                                <form method="POST" action="{{ route('posts.destroy', $post) }}"
                                      onsubmit="return confirm('¿Eliminar esta publicación?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-link btn-danger">Eliminar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination-wrapper">
            {{ $posts->links() }}
        </div>
    @else
        <p class="empty-state">
            No hay publicaciones todavía.
            <a href="{{ route('posts.create') }}">Crea la primera</a>.
        </p>
    @endif

</div>
@endsection
