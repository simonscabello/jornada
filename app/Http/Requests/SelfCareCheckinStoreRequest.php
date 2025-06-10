<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SelfCareCheckinStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'answers' => 'required|array',
            'answers.*' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'answers.required' => 'As respostas são obrigatórias',
            'answers.array' => 'As respostas devem ser enviadas em formato de array',
            'answers.*.required' => 'Todas as perguntas devem ser respondidas',
            'answers.*.boolean' => 'As respostas devem ser verdadeiro ou falso',
        ];
    }
}
