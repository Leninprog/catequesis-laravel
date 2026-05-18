<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(StoreEventRequest $request)
    {
        Event::create([

            'nombre' => $request->nombre,

            'descripcion' => $request->descripcion,

            'tipo' => $request->tipo,

            'modalidad' => $request->modalidad,

            'cupo_maximo' => $request->cupo_maximo,

            'fecha_inicio' => $request->fecha_inicio,

            'fecha_fin' => $request->fecha_fin,

            'estado' => $request->estado,

            'created_by' => 1
        ]);

        return redirect()
            ->route('events.index')
            ->with('success', 'Evento creado correctamente.');
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(StoreEventRequest $request, Event $event)
    {
        $event->update([

            'nombre' => $request->nombre,

            'descripcion' => $request->descripcion,

            'tipo' => $request->tipo,

            'modalidad' => $request->modalidad,

            'cupo_maximo' => $request->cupo_maximo,

            'fecha_inicio' => $request->fecha_inicio,

            'fecha_fin' => $request->fecha_fin,

            'estado' => $request->estado
        ]);

        return redirect()
            ->route('events.index')
            ->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()
            ->route('events.index')
            ->with('success', 'Evento eliminado correctamente.');
    }
}
