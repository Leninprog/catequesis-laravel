<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'nombre' =>
            'required|string|max:100',

            'descripcion' =>
            'nullable|string|max:250',

            'tipo' =>
            'required|in:taller,charla,brigada,seguimiento',

            'modalidad' =>
            'required|in:presencial,virtual,hibrido',

            'cupo_maximo' =>
            'nullable|integer|min:1',

            'fecha_inicio' =>
            'required|date',

            'fecha_fin' =>
            'required|date|after_or_equal:fecha_inicio',

            'estado' =>
            'required|in:activo,inactivo,finalizado'
        ];
    }

    public function messages(): array
    {
        return [

            'nombre.required' =>
            'El nombre del evento es obligatorio.',

            'tipo.in' =>
            'El tipo seleccionado no es válido.',

            'modalidad.in' =>
            'La modalidad seleccionada no es válida.',

            'fecha_fin.after_or_equal' =>
            'La fecha fin no puede ser menor a la fecha inicio.'
        ];
    }
}
