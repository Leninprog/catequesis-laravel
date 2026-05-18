<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventEvaluatorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'event_id' =>
            'required|exists:events,id',

            'evaluator_id' =>
            'required|exists:evaluators,id',

            'rol' =>
            'nullable|string|max:80',

            'estado' =>
            'required|in:activo,inactivo'
        ];
    }

    public function messages(): array
    {
        return [

            'event_id.required' =>
            'Debe seleccionar un evento.',

            'evaluator_id.required' =>
            'Debe seleccionar un evaluador.'
        ];
    }
}
