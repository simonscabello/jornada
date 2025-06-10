<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DailyLogStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => 'required|string',
            'mood' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'O conteúdo é obrigatório',
            'mood.max' => 'O humor não pode ter mais de 255 caracteres',
        ];
    }
}
