@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard">

    <div class="dashboard-header">
        <h1>Bienvenido, {{ auth()->user()->name }}</h1>
        <p>Panel de control — acceso restringido a usuarios autenticados.</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="dashboard-stats">
        <div class="stat-card">
            <span class="stat-number">{{ $totalPosts }}</span>
            <span class="stat-label">Publicaciones</span>
        </div>
        <div class="stat-card">
            <span class="stat-number">{{ $myPosts }}</span>
            <span class="stat-label">Mis publicaciones</span>
        </div>
    </div>

    <div class="dashboard-actions">
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">
            Ver todas las publicaciones
        </a>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">
            Nueva publicación
        </a>
    </div>

    @if ($recentPosts->count())
        <section class="dashboard-recent">
            <h2>Mis publicaciones recientes</h2>

            <table class="table">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentPosts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->created_at->format('d/m/Y') }}</td>
                            <td class="table-actions">
                                <a href="{{ route('posts.show', $post) }}">Ver</a>
                                <a href="{{ route('posts.edit', $post) }}">Editar</a>
                                <form method="POST" action="{{ route('posts.destroy', $post) }}"
                                      onsubmit="return confirm('¿Eliminar esta publicación?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-link btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    @else
        <p class="empty-state">Aún no tienes publicaciones. <a href="{{ route('posts.create') }}">Crea la primera</a>.</p>
    @endif

</div>
@endsection
