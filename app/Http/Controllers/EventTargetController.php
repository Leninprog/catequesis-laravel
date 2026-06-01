<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Subcategory;
use App\Models\EventTarget;
use App\Http\Requests\StoreEventTargetRequest;
use App\Models\Enrollment;
use App\Models\PersonCondition;

class EventTargetController extends Controller
{
    public function index()
    {
        $targets = EventTarget::with([
            'event',
            'subcategory'
        ])->get();

        return view('event_targets.index', compact('targets'));
    }

    public function create()
    {
        $events = Event::orderBy('nombre')->get();

        $subcategories = Subcategory::orderBy('nombre')->get();

        return view('event_targets.create', compact(
            'events',
            'subcategories'
        ));
    }

    public function store(StoreEventTargetRequest $request)
    {
        $target = EventTarget::create([

            'event_id' => $request->event_id,

            'subcategory_id' => $request->subcategory_id,

            'nivel_min' => $request->nivel_min,

            'nivel_max' => $request->nivel_max
        ]);

        /*
    |------------------------------------------------------------------
    | BUSCAR CONDICIONES COMPATIBLES
    |------------------------------------------------------------------
    */

        $conditions = PersonCondition::where(
            'subcategory_id',
            $target->subcategory_id
        )
            ->whereBetween('nivel', [
                $target->nivel_min,
                $target->nivel_max
            ])
            ->whereIn('estado', [
                'activa',
                'en_seguimiento'
            ])
            ->get();

        /*
    |------------------------------------------------------------------
    | GENERAR ENROLLMENTS AUTOMÁTICOS
    |------------------------------------------------------------------
    */

        foreach ($conditions as $condition) {

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
            ->route('event-targets.index')
            ->with(
                'success',
                'Target creado y enrollments generados automáticamente.'
            );
    }

    public function edit(EventTarget $eventTarget)
    {
        $events = Event::orderBy('nombre')->get();

        $subcategories = Subcategory::orderBy('nombre')->get();

        return view('event_targets.edit', compact(
            'eventTarget',
            'events',
            'subcategories'
        ));
    }

    public function update(
        StoreEventTargetRequest $request,
        EventTarget $eventTarget
    ) {
        $eventTarget->update([

            'event_id' => $request->event_id,

            'subcategory_id' => $request->subcategory_id,

            'nivel_min' => $request->nivel_min,

            'nivel_max' => $request->nivel_max
        ]);

        $conditions = PersonCondition::where(
            'subcategory_id',
            $eventTarget->subcategory_id
        )
            ->whereBetween('nivel', [
                $eventTarget->nivel_min,
                $eventTarget->nivel_max
            ])
            ->whereIn('estado', [
                'activa',
                'en_seguimiento'
            ])
            ->get();

        foreach ($conditions as $condition) {

            $exists = Enrollment::where(
                'person_id',
                $condition->person_id
            )
                ->where(
                    'event_id',
                    $eventTarget->event_id
                )
                ->exists();

            if (!$exists) {

                Enrollment::create([

                    'person_id' =>
                    $condition->person_id,

                    'event_id' =>
                    $eventTarget->event_id,

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
            ->route('event-targets.index')
            ->with(
                'success',
                'Objetivo actualizado correctamente.'
            );
    }

    public function destroy(EventTarget $eventTarget)
    {
        $eventTarget->delete();

        return redirect()
            ->route('event-targets.index')
            ->with('success', 'Objetivo eliminado correctamente.');
    }
}
