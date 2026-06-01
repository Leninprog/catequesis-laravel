<?php

namespace App\Http\Controllers;

use App\Models\PersonCondition;
use App\Models\Person;
use App\Models\Subcategory;
use App\Models\Evaluator;
use App\Http\Requests\StorePersonConditionRequest;
use App\Models\EventTarget;
use App\Models\Enrollment;

class PersonConditionController extends Controller
{
    public function index()
    {
        $conditions = PersonCondition::with([
            'person',
            'subcategory',
            'evaluator'
        ])->get();

        return view('person_conditions.index', compact('conditions'));
    }

    public function create()
    {
        $persons = Person::orderBy('nombres')->get();

        $subcategories = Subcategory::orderBy('nombre')->get();

        $evaluators = Evaluator::orderBy('nombres')->get();

        return view('person_conditions.create', compact(
            'persons',
            'subcategories',
            'evaluators'
        ));
    }

    public function store(StorePersonConditionRequest $request)
    {
        $exists = PersonCondition::where(
            'person_id',
            $request->person_id
        )
            ->where(
                'subcategory_id',
                $request->subcategory_id
            )
            ->where(
                'estado',
                '!=',
                'resuelta'
            )
            ->exists();

        if ($exists) {

            return back()
                ->withErrors([
                    'person_id' =>
                    'La persona ya tiene una condición activa para esta subcategoría.'
                ])
                ->withInput();
        }

        $condition = PersonCondition::create([

            'person_id' =>
            $request->person_id,

            'subcategory_id' =>
            $request->subcategory_id,

            'evaluator_id' =>
            $request->evaluator_id,

            'nivel' =>
            $request->nivel,

            'prioridad' =>
            $request->prioridad,

            'estado' =>
            $request->estado,

            'observaciones' =>
            $request->observaciones,

            'fecha_inicio' =>
            now(),

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
            ->route('person-conditions.index')
            ->with(
                'success',
                'Condición registrada correctamente.'
            );
    }

    public function show(PersonCondition $personCondition)
    {
        $personCondition->load([
            'person',
            'subcategory',
            'evaluator',
            'followups'
        ]);

        return view(
            'person_conditions.show',
            compact('personCondition')
        );
    }
}
