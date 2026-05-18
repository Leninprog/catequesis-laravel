<?php

namespace App\Http\Controllers;

use App\Models\ConditionFollowup;
use App\Models\PersonCondition;
use App\Http\Requests\StoreConditionFollowupRequest;

class ConditionFollowupController extends Controller
{
    public function index()
    {
        $followups = ConditionFollowup::with([
            'condition.person',
            'creator'
        ])->get();

        return view(
            'condition_followups.index',
            compact('followups')
        );
    }

    public function create()
    {
        $conditions = PersonCondition::with([
            'person',
            'subcategory'
        ])->get();

        return view(
            'condition_followups.create',
            compact('conditions')
        );
    }

    public function store(StoreConditionFollowupRequest $request)
    {
        $condition = PersonCondition::findOrFail(
            $request->condition_id
        );

        ConditionFollowup::create([

            'condition_id' =>
            $condition->id,

            'nivel_anterior' =>
            $condition->nivel,

            'nivel_nuevo' =>
            $request->nivel_nuevo,

            'observaciones' =>
            $request->observaciones,

            'fecha' =>
            now(),

            'created_by' =>
            auth()->id()
        ]);

        /*
        |--------------------------------------------------------------------------
        | ACTUALIZAR NIVEL ACTUAL DE LA CONDICIÓN
        |--------------------------------------------------------------------------
        */

        $condition->update([

            'nivel' =>
            $request->nivel_nuevo,

            'fecha_actualizacion' =>
            now()
        ]);

        return redirect()
            ->route('condition-followups.index')
            ->with(
                'success',
                'Seguimiento registrado correctamente.'
            );
    }
}
