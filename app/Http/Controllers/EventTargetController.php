<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Subcategory;
use App\Models\EventTarget;
use App\Http\Requests\StoreEventTargetRequest;

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
        EventTarget::create([

            'event_id' => $request->event_id,

            'subcategory_id' => $request->subcategory_id,

            'nivel_min' => $request->nivel_min,

            'nivel_max' => $request->nivel_max
        ]);

        return redirect()
            ->route('event-targets.index')
            ->with('success', 'Objetivo del evento creado correctamente.');
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
}
