<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LifeEventStoreRequest extends FormRequest
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
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'type' => 'required|string|max:50',
            'images.*' => 'nullable|image|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O título é obrigatório',
            'title.max' => 'O título não pode ter mais de 255 caracteres',
            'event_date.required' => 'A data do evento é obrigatória',
            'event_date.date' => 'A data do evento deve ser uma data válida',
            'type.required' => 'O tipo do evento é obrigatório',
            'type.max' => 'O tipo não pode ter mais de 50 caracteres',
            'images.*.image' => 'O arquivo deve ser uma imagem',
            'images.*.max' => 'A imagem não pode ter mais de 5MB',
        ];
    }
}
