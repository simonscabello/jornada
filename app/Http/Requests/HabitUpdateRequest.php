<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HabitUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('habit')->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome do hábito é obrigatório',
            'name.max' => 'O nome não pode ter mais de 255 caracteres',
        ];
    }
}
