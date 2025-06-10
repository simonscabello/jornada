<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoalStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_date' => 'required|date|after_or_equal:today',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O título é obrigatório',
            'title.max' => 'O título não pode ter mais de 255 caracteres',
            'target_date.required' => 'A data alvo é obrigatória',
            'target_date.date' => 'A data alvo deve ser uma data válida',
            'target_date.after_or_equal' => 'A data alvo deve ser igual ou posterior a hoje',
        ];
    }
}
