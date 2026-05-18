<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventTargetRequest extends FormRequest
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

            'subcategory_id' =>
            'required|exists:subcategories,id',

            'nivel_min' =>
            'required|integer|min:1|max:5',

            'nivel_max' =>
            'required|integer|min:1|max:5|gte:nivel_min'
        ];
    }

    public function messages(): array
    {
        return [

            'event_id.required' =>
            'Debe seleccionar un evento.',

            'subcategory_id.required' =>
            'Debe seleccionar una subcategoría.',

            'nivel_max.gte' =>
            'El nivel máximo no puede ser menor al mínimo.'
        ];
    }
}
