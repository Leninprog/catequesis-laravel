<?php

namespace App\Http\Controllers;

use App\Models\Evaluator;
use App\Models\User;
use App\Http\Requests\StoreEvaluatorRequest;

class EvaluatorController extends Controller
{
    public function index()
    {
        $evaluators = Evaluator::with('user')->get();

        return view('evaluators.index', compact('evaluators'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('evaluators.create', compact('users'));
    }

    public function store(StoreEvaluatorRequest $request)
    {
        Evaluator::create([

            'nombres' => $request->nombres,

            'apellidos' => $request->apellidos,

            'especialidad' => $request->especialidad,

            'telefono' => $request->telefono,

            'email' => $request->email,

            'estado' => $request->estado,

            'user_id' => $request->user_id
        ]);

        return redirect()
            ->route('evaluators.index')
            ->with('success', 'Evaluador creado correctamente.');
    }
}
