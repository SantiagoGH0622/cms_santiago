<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * GET /posts — lista todas las publicaciones.
     */
    public function index()
    {
        $posts = Post::with('user')
            ->latest()
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * GET /posts/create — formulario de nueva publicación.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * POST /posts — guardar nueva publicación.
     * El user_id viene del usuario autenticado, nunca del formulario.
     */
    public function store(StorePostRequest $request)
    {
        $post = $request->user()->posts()->create(
            $request->validated()
        );

        return redirect()
            ->route('posts.show', $post)
            ->with('status', 'Publicación creada correctamente.');
    }

    /**
     * GET /posts/{post} — detalle de una publicación.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * GET /posts/{post}/edit — formulario de edición.
     * Solo el propietario puede editar.
     */
    public function edit(Post $post)
    {
        Gate::authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * PUT/PATCH /posts/{post} — actualizar publicación.
     * Solo el propietario puede actualizar.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        Gate::authorize('update', $post);

        $post->update($request->validated());

        return redirect()
            ->route('posts.show', $post)
            ->with('status', 'Publicación actualizada correctamente.');
    }

    /**
     * DELETE /posts/{post} — eliminar publicación.
     * Solo el propietario puede eliminar.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('status', 'Publicación eliminada correctamente.');
    }
}
