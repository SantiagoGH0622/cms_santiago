<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'CMS')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <header>
        <nav>
            <a href="{{ route('home') }}">Inicio</a>
            <a href="{{ route('about') }}">Acerca</a>
            <a href="{{ route('contact') }}">Contacto</a>
            <a href="{{ route('posts.index') }}">Publicaciones</a>
            <a href="{{ route('dashboard') }}">Dashboard</a>

            <form method="POST" action="{{ route('logout') }}" class="nav-login">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

</body>

</html>