<?php

namespace App\Http\Controllers;

use App\Interfaces\EnrollmentServiceInterface;
use App\Models\Event;
use App\Models\EventTarget;
use App\Models\PersonCondition;
use App\Models\Subcategory;
use App\Http\Requests\StoreEventTargetRequest;

/**
 * EventTargetController — REFACTORIZADO
 *
 * PRINCIPIO SOLID: Single Responsibility Principle (SRP)
 * Antes: creaba el target Y buscaba condiciones Y generaba enrollments (60+ líneas en store).
 * Ahora: crea el target y delega la generación de inscripciones al servicio.
 *
 * NOTA: La lógica de "encontrar condiciones compatibles y generar enrollments"
 * es la misma en store() y update(). Con el servicio, se elimina esa duplicación.
 */
class EventTargetController extends Controller
{
    public function __construct(
        private readonly EnrollmentServiceInterface $enrollmentService
    ) {}

    public function index()
    {
        $targets = EventTarget::with(['event', 'subcategory'])->get();

        return view('event_targets.index', compact('targets'));
    }

    public function create()
    {
        $events       = Event::orderBy('nombre')->get();
        $subcategories = Subcategory::orderBy('nombre')->get();

        return view('event_targets.create', compact('events', 'subcategories'));
    }

    public function store(StoreEventTargetRequest $request)
    {
        $target = EventTarget::create([
            'event_id'       => $request->event_id,
            'subcategory_id' => $request->subcategory_id,
            'nivel_min'      => $request->nivel_min,
            'nivel_max'      => $request->nivel_max,
        ]);

        // Generar enrollments para todas las condiciones compatibles (SRP delegado)
        $this->generarEnrollmentsParaTarget($target);

        return redirect()
            ->route('event-targets.index')
            ->with('success', 'Target creado y enrollments generados automáticamente.');
    }

    public function edit(EventTarget $eventTarget)
    {
        $events        = Event::orderBy('nombre')->get();
        $subcategories = Subcategory::orderBy('nombre')->get();

        return view('event_targets.edit', compact('eventTarget', 'events', 'subcategories'));
    }

    public function update(StoreEventTargetRequest $request, EventTarget $eventTarget)
    {
        $eventTarget->update([
            'event_id'       => $request->event_id,
            'subcategory_id' => $request->subcategory_id,
            'nivel_min'      => $request->nivel_min,
            'nivel_max'      => $request->nivel_max,
        ]);

        // Mismo servicio, misma lógica — sin duplicación
        $this->generarEnrollmentsParaTarget($eventTarget->fresh());

        return redirect()
            ->route('event-targets.index')
            ->with('success', 'Objetivo actualizado correctamente.');
    }

    public function destroy(EventTarget $eventTarget)
    {
        $eventTarget->delete();

        return redirect()
            ->route('event-targets.index')
            ->with('success', 'Objetivo eliminado correctamente.');
    }

    /**
     * Busca todas las PersonConditions compatibles con el target
     * y delega la creación de enrollments al EnrollmentService.
     *
     * Este método privado sigue SRP: solo coordina, no ejecuta lógica de negocio.
     */
    private function generarEnrollmentsParaTarget(EventTarget $target): void
    {
        $conditions = PersonCondition::where('subcategory_id', $target->subcategory_id)
            ->whereBetween('nivel', [$target->nivel_min, $target->nivel_max])
            ->whereIn('estado', ['activa', 'en_seguimiento'])
            ->get();

        foreach ($conditions as $condition) {
            $this->enrollmentService->generarInscripcionesAutomaticas($condition);
        }
    }
}
