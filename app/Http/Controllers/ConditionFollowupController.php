<?php

namespace App\Http\Controllers;

use App\Interfaces\EnrollmentServiceInterface;
use App\Models\ConditionFollowup;
use App\Models\PersonCondition;
use App\Http\Requests\StoreConditionFollowupRequest;

/**
 * ConditionFollowupController — REFACTORIZADO
 *
 * PRINCIPIO SOLID: Single Responsibility Principle (SRP)
 * Antes: registraba el followup, actualizaba la condición Y generaba enrollments.
 * Ahora: registra el followup, actualiza la condición, y delega los enrollments.
 *
 * PRINCIPIO SOLID: Dependency Inversion Principle (DIP)
 * Depende de EnrollmentServiceInterface (interfaz), no de la clase concreta.
 */
class ConditionFollowupController extends Controller
{
    public function __construct(
        private readonly EnrollmentServiceInterface $enrollmentService
    ) {}

    public function index()
    {
        $followups = ConditionFollowup::with([
            'condition.person',
            'creator',
        ])->get();

        return view('condition_followups.index', compact('followups'));
    }

    public function create()
    {
        $conditions = PersonCondition::with(['person', 'subcategory'])->get();

        return view('condition_followups.create', compact('conditions'));
    }

    public function store(StoreConditionFollowupRequest $request)
    {
        $condition = PersonCondition::findOrFail($request->condition_id);

        // Registrar el seguimiento
        ConditionFollowup::create([
            'condition_id'   => $condition->id,
            'nivel_anterior' => $condition->nivel,
            'nivel_nuevo'    => $request->nivel_nuevo,
            'observaciones'  => $request->observaciones,
            'fecha'          => now(),
            'created_by'     => auth()->id(),
        ]);

        // Actualizar nivel de la condición
        $condition->update([
            'nivel'              => $request->nivel_nuevo,
            'fecha_actualizacion' => now(),
        ]);

        // Recargar para que el servicio use el nivel actualizado (SRP)
        $condition->refresh();
        $this->enrollmentService->generarInscripcionesAutomaticas($condition);

        return redirect()
            ->route('condition-followups.index')
            ->with('success', 'Seguimiento registrado correctamente.');
    }

    public function show(ConditionFollowup $conditionFollowup)
    {
        $conditionFollowup->load([
            'condition.person',
            'condition.subcategory',
            'creator',
        ]);

        return view('condition_followups.show', compact('conditionFollowup'));
    }
}
