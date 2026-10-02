<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    // Solo title y body son asignables masivamente.
    // user_id se asigna desde el usuario autenticado, nunca desde el formulario.
    protected $fillable = ['title', 'body'];

    /**
     * Propietario de la publicación.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
