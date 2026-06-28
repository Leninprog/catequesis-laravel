<?php

namespace App\Http\Controllers;

use App\Interfaces\EnrollmentServiceInterface;
use App\Models\Evaluator;
use App\Models\Person;
use App\Models\PersonCondition;
use App\Models\Subcategory;
use App\Http\Requests\StorePersonConditionRequest;

/**
 * PersonConditionController — REFACTORIZADO
 *
 * PRINCIPIO SOLID: Single Responsibility Principle (SRP)
 * Antes: este controller creaba la condición Y buscaba targets Y creaba enrollments.
 * Ahora: solo crea la condición y delega la generación de enrollments al servicio.
 *
 * PRINCIPIO SOLID: Dependency Inversion Principle (DIP)
 * Depende de EnrollmentServiceInterface, no de EnrollmentService directamente.
 */
class PersonConditionController extends Controller
{
    public function __construct(
        private readonly EnrollmentServiceInterface $enrollmentService
    ) {}

    public function index()
    {
        $conditions = PersonCondition::with([
            'person',
            'subcategory',
            'evaluator',
        ])->get();

        return view('person_conditions.index', compact('conditions'));
    }

    public function create()
    {
        $persons      = Person::orderBy('nombres')->get();
        $subcategories = Subcategory::orderBy('nombre')->get();
        $evaluators   = Evaluator::orderBy('nombres')->get();

        return view('person_conditions.create', compact(
            'persons',
            'subcategories',
            'evaluators'
        ));
    }

    public function store(StorePersonConditionRequest $request)
    {
        // Verificar condición activa duplicada
        $exists = PersonCondition::where('person_id', $request->person_id)
            ->where('subcategory_id', $request->subcategory_id)
            ->where('estado', '!=', 'resuelta')
            ->exists();

        if ($exists) {
            return back()
                ->withErrors([
                    'person_id' => 'La persona ya tiene una condición activa para esta subcategoría.',
                ])
                ->withInput();
        }

        // Crear la condición (responsabilidad del controller)
        $condition = PersonCondition::create([
            'person_id'         => $request->person_id,
            'subcategory_id'    => $request->subcategory_id,
            'evaluator_id'      => $request->evaluator_id,
            'nivel'             => $request->nivel,
            'prioridad'         => $request->prioridad,
            'estado'            => $request->estado,
            'observaciones'     => $request->observaciones,
            'fecha_inicio'      => now(),
            'fecha_actualizacion' => now(),
        ]);

        // Delegar la generación de inscripciones al servicio (SRP)
        $this->enrollmentService->generarInscripcionesAutomaticas($condition);

        return redirect()
            ->route('person-conditions.index')
            ->with('success', 'Condición registrada correctamente.');
    }

    public function show(PersonCondition $personCondition)
    {
        $personCondition->load([
            'person',
            'subcategory',
            'evaluator',
            'followups',
        ]);

        return view('person_conditions.show', compact('personCondition'));
    }
}
