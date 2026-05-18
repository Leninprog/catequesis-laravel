<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvaluatorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'nombres' => 'required|string|max:80',

            'apellidos' => 'required|string|max:80',

            'especialidad' => 'nullable|string|max:100',

            'telefono' => 'nullable|string|max:20',

            'email' => 'nullable|email|max:100|unique:evaluators,email',

            'estado' => 'required|in:activo,inactivo',

            'user_id' => 'nullable|exists:users,id'
        ];
    }

    public function messages(): array
    {
        return [

            'nombres.required' =>
            'Los nombres son obligatorios.',

            'apellidos.required' =>
            'Los apellidos son obligatorios.',

            'email.email' =>
            'Debe ingresar un correo válido.',

            'email.unique' =>
            'Ese correo ya está registrado.',

            'user_id.exists' =>
            'El usuario seleccionado no existe.'
        ];
    }
}
