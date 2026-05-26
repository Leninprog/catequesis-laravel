<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Evaluator;
use App\Models\EventEvaluator;
use App\Http\Requests\StoreEventEvaluatorRequest;

class EventEvaluatorController extends Controller
{
    public function index()
    {
        $eventEvaluators = EventEvaluator::with([
            'event',
            'evaluator'
        ])->get();

        return view(
            'event_evaluators.index',
            compact('eventEvaluators')
        );
    }

    public function create()
    {
        $events = Event::orderBy('nombre')->get();

        $evaluators = Evaluator::orderBy('nombres')->get();

        return view(
            'event_evaluators.create',
            compact('events', 'evaluators')
        );
    }

    public function store(StoreEventEvaluatorRequest $request)
    {
        EventEvaluator::create([

            'event_id' =>
            $request->event_id,

            'evaluator_id' =>
            $request->evaluator_id,

            'rol' =>
            $request->rol,

            'activo' =>
            $request->activo
        ]);

        return redirect()
            ->route('event-evaluators.index')
            ->with(
                'success',
                'Evaluador asignado correctamente.'
            );
    }

    public function edit(EventEvaluator $eventEvaluator)
    {
        $events = Event::orderBy('nombre')->get();

        $evaluators = Evaluator::orderBy('nombres')->get();

        return view(
            'event_evaluators.edit',
            compact(
                'eventEvaluator',
                'events',
                'evaluators'
            )
        );
    }

    public function update(
        StoreEventEvaluatorRequest $request,
        EventEvaluator $eventEvaluator
    ) {

        $eventEvaluator->update([

            'event_id' =>
            $request->event_id,

            'evaluator_id' =>
            $request->evaluator_id,

            'rol' =>
            $request->rol,

            'activo' =>
            $request->activo
        ]);

        return redirect()
            ->route('event-evaluators.index')
            ->with(
                'success',
                'Asignación actualizada correctamente.'
            );
    }

    public function destroy(EventEvaluator $eventEvaluator)
    {
        $eventEvaluator->delete();

        return redirect()
            ->route('event-evaluators.index')
            ->with(
                'success',
                'Asignación eliminada correctamente.'
            );
    }
}
