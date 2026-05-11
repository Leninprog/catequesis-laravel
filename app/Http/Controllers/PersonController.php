<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use App\Services\PersonService;
use App\Rules\ValidDocument;

class PersonController extends Controller
{
    protected $personService;

    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    public function index()
    {
        $persons = $this->personService->listar();

        return view('persons.index', compact('persons'));
    }

    public function create()
    {
        return view('persons.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombres' => 'required|max:80',
            'apellidos' => 'required|max:80',
            'documento' => [
                'required',
                'unique:persons,documento',
                new ValidDocument
            ],
            'telefono' => 'nullable|max:20',
            'email' => 'nullable|email',
            'direccion' => 'nullable|max:150',
        ]);

        $validated['created_by'] = auth()->id();

        $this->personService->crear($validated);

        return redirect()
            ->route('persons.index')
            ->with('success', 'Persona registrada correctamente');
    }

    public function edit(Person $person)
    {
        return view('persons.edit', compact('person'));
    }

    public function update(Request $request, Person $person)
    {
        $validated = $request->validate([
            'nombres' => 'required|max:80',
            'apellidos' => 'required|max:80',
            'documento' => [
                'required',
                'unique:persons,documento,' . $person->id,
                new ValidDocument
            ],
            'telefono' => 'nullable|max:20',
            'email' => 'nullable|email',
            'direccion' => 'nullable|max:150',
            'estado' => 'required'
        ]);

        $this->personService->actualizar($person, $validated);

        return redirect()
            ->route('persons.index')
            ->with('success', 'Persona actualizada correctamente');
    }

    public function destroy(Person $person)
    {
        $this->personService->eliminar($person);

        return redirect()
            ->route('persons.index')
            ->with('success', 'Persona eliminada correctamente');
    }
}
