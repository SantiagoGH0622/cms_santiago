<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Solo usuarios autenticados pueden crear publicaciones.
     */
    public function authorize(): bool
    {
        return true; // el middleware 'auth' de la ruta ya garantiza la autenticación
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:150'],
            'body'  => ['required', 'string', 'max:10000'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'El título es obligatorio.',
            'title.max'      => 'El título no puede superar 150 caracteres.',
            'body.required'  => 'El contenido es obligatorio.',
            'body.max'       => 'El contenido no puede superar 10 000 caracteres.',
        ];
    }
}
