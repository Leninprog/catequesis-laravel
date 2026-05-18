<?php

namespace App\Http\Controllers;

use App\Models\PersonCondition;
use App\Models\Person;
use App\Models\Subcategory;
use App\Models\Evaluator;
use App\Http\Requests\StorePersonConditionRequest;

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
        PersonCondition::create([
            'person_id' => $request->person_id,
            'subcategory_id' => $request->subcategory_id,
            'evaluator_id' => $request->evaluator_id,
            'nivel' => $request->nivel,
            'prioridad' => $request->prioridad,
            'estado' => $request->estado,
            'observaciones' => $request->observaciones,
            'fecha_inicio' => now(),
            'fecha_actualizacion' => now()
        ]);

        return redirect()
            ->route('person-conditions.index')
            ->with('success', 'Condición registrada correctamente.');
    }
}
