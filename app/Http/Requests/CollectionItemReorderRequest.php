<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollectionItemReorderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('collection')->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'items' => 'required|array',
            'items.*.id' => 'required|exists:collection_items,id',
            'items.*.position' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'items.required' => 'Os itens são obrigatórios',
            'items.array' => 'Os itens devem ser enviados em formato de array',
            'items.*.id.required' => 'O ID do item é obrigatório',
            'items.*.id.exists' => 'Um dos itens não existe',
            'items.*.position.required' => 'A posição é obrigatória',
            'items.*.position.integer' => 'A posição deve ser um número inteiro',
            'items.*.position.min' => 'A posição não pode ser negativa',
        ];
    }
}
