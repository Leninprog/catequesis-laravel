<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnrollmentRequest extends FormRequest
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

            'event_id' =>
            'required|exists:events,id',

            'estado' =>
            'required|in:pendiente,aprobada,rechazada,cancelada',

            'observaciones' =>
            'nullable|string|max:500'
        ];
    }

    public function messages(): array
    {
        return [

            'person_id.required' =>
            'Debe seleccionar una persona.',

            'event_id.required' =>
            'Debe seleccionar un evento.',

            'estado.required' =>
            'Debe seleccionar un estado.'
        ];
    }
}
