<?php

namespace App\Http\Controllers;

use App\Models\ConditionFollowup;
use App\Models\PersonCondition;
use App\Http\Requests\StoreConditionFollowupRequest;
use App\Models\EventTarget;
use App\Models\Enrollment;

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

        $targets = EventTarget::where(
            'subcategory_id',
            $condition->subcategory_id
        )
            ->where(
                'nivel_min',
                '<=',
                $condition->nivel
            )
            ->where(
                'nivel_max',
                '>=',
                $condition->nivel
            )
            ->get();

        foreach ($targets as $target) {

            $exists = Enrollment::where(
                'person_id',
                $condition->person_id
            )
                ->where(
                    'event_id',
                    $target->event_id
                )
                ->exists();

            if (!$exists) {

                Enrollment::create([

                    'person_id' =>
                    $condition->person_id,

                    'event_id' =>
                    $target->event_id,

                    'fecha_inscripcion' =>
                    now(),

                    'estado' =>
                    'pendiente',

                    'observaciones' =>
                    'Generado automáticamente por compatibilidad.',

                    'created_by' =>
                    auth()->id()
                ]);
            }
        }

        return redirect()
            ->route('condition-followups.index')
            ->with(
                'success',
                'Seguimiento registrado correctamente.'
            );
    }

    public function show(
        ConditionFollowup $conditionFollowup
    ) {
        $conditionFollowup->load([
            'condition.person',
            'condition.subcategory',
            'creator'
        ]);

        return view(
            'condition_followups.show',
            compact('conditionFollowup')
        );
    }
}
