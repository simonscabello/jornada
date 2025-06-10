<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SelfCareQuestionUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('question')->user_id === auth()->id() && !$this->route('question')->is_default;
    }

    public function rules(): array
    {
        return [
            'question' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'question.required' => 'A pergunta é obrigatória',
            'question.max' => 'A pergunta não pode ter mais de 255 caracteres',
        ];
    }
}
