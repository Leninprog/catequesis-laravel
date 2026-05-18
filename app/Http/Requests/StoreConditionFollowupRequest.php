<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConditionFollowupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'condition_id' =>
            'required|exists:person_conditions,id',

            'nivel_nuevo' =>
            'required|integer|min:1|max:5',

            'observaciones' =>
            'nullable|string|max:500'
        ];
    }

    public function messages(): array
    {
        return [

            'condition_id.required' =>
            'Debe seleccionar una condición.',

            'condition_id.exists' =>
            'La condición seleccionada no existe.',

            'nivel_nuevo.required' =>
            'Debe ingresar el nuevo nivel.',

            'nivel_nuevo.min' =>
            'El nivel mínimo es 1.',

            'nivel_nuevo.max' =>
            'El nivel máximo es 5.'
        ];
    }
}
