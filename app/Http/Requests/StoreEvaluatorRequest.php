<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEvaluatorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $evaluatorId = $this->route('evaluator')?->id;

        return [

            'nombres' => 'required|max:80',

            'apellidos' => 'required|max:80',

            'especialidad' => 'nullable|max:100',

            'telefono' => 'nullable|max:20',

            'email' => [

                'nullable',
                'email',

                Rule::unique('evaluators', 'email')
                    ->ignore($evaluatorId)

            ],

            'estado' => 'required|in:activo,inactivo',

            'user_id' => 'nullable|exists:users,id'
        ];
    }
}
