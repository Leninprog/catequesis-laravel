<?php

namespace App\Http\Controllers;
use App\Services\EstudianteService;
use App\Models\Estudiante;
use App\Http\Requests\StoreEstudianteRequest;
use App\Http\Requests\UpdateEstudianteRequest;

class EstudianteController extends Controller
{
    protected $service;

    public function __construct(EstudianteService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $estudiantes = $this->service->listar();
        return view('estudiantes.index', compact('estudiantes'));
    }

    public function create()
    {
        return view('estudiantes.create');
    }

    public function store(StoreEstudianteRequest $request)
    {
        $this->service->crear($request->validated());
        return redirect()->route('estudiantes.index');
    }

    public function edit(Estudiante $estudiante)
    {
        return view('estudiantes.edit', compact('estudiante'));
    }

    public function update(UpdateEstudianteRequest $request, Estudiante $estudiante)
    {
        $this->service->actualizar($estudiante, $request->validated());
        return redirect()->route('estudiantes.index');
    }

    public function destroy(Estudiante $estudiante)
    {
        $this->service->eliminar($estudiante);
        return redirect()->route('estudiantes.index');
    }
}
