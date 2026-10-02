<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Cualquier usuario autenticado puede ver la lista y el detalle.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Post $post): bool
    {
        return true;
    }

    /**
     * Cualquier usuario autenticado puede crear publicaciones.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Solo el propietario puede editar.
     */
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * Solo el propietario puede eliminar.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }
}
