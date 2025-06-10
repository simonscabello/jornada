<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollectionItemUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('collection')->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'content' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'done' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'O conteúdo é obrigatório',
            'content.max' => 'O conteúdo não pode ter mais de 255 caracteres',
            'done.boolean' => 'O status deve ser verdadeiro ou falso',
        ];
    }
}
