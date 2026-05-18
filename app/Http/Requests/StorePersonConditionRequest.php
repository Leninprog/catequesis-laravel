<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonConditionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'person_id' =>
            'required|exists:persons,id',

            'subcategory_id' =>
            'required|exists:subcategories,id',

            'evaluator_id' =>
            'nullable|exists:evaluators,id',

            'nivel' =>
            'required|integer|min:1|max:5',

            'prioridad' =>
            'required|integer|min:1|max:5',

            'estado' =>
            'required|in:activa,en_seguimiento,resuelta',

            'observaciones' =>
            'nullable|string|max:500'
        ];
    }

    public function messages(): array
    {
        return [

            'person_id.required' =>
            'Debe seleccionar una persona.',

            'person_id.exists' =>
            'La persona seleccionada no existe.',

            'subcategory_id.required' =>
            'Debe seleccionar una subcategoría.',

            'subcategory_id.exists' =>
            'La subcategoría seleccionada no existe.',

            'nivel.min' =>
            'El nivel mínimo es 1.',

            'nivel.max' =>
            'El nivel máximo es 5.',

            'prioridad.min' =>
            'La prioridad mínima es 1.',

            'prioridad.max' =>
            'La prioridad máxima es 5.'
        ];
    }
}
