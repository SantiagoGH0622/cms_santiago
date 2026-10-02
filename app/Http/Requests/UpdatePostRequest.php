<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Solo el propietario puede actualizar (la Policy lo verifica en el controlador).
     */
    public function authorize(): bool
    {
        return true; // autorización delegada a PostPolicy via Gate::authorize en el controlador
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
