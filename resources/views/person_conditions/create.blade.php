@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Nueva Condición Social</h1>

    @if ($errors->any())
        <div class="mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="space-y-4" action="{{ route('person-conditions.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Persona</label>

            <select name="person_id" required>
                <option value="">Seleccione</option>

                @foreach ($persons as $person)
                    <option value="{{ $person->id }}">
                        {{ $person->nombres }} {{ $person->apellidos }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Subcategoría</label>

            <select name="subcategory_id" required>
                <option value="">Seleccione</option>

                @foreach ($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}">
                        {{ $subcategory->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Evaluador</label>

            <select name="evaluator_id" class="border border-gray-300 rounded px-4 py-2">
                <option value="">Seleccione</option>

                @foreach ($evaluators as $evaluator)
                    <option value="{{ $evaluator->id }}">
                        {{ $evaluator->nombres }} {{ $evaluator->apellidos }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nivel</label>

            <input type="number" name="nivel" min="1" max="5" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Prioridad</label>

            <input type="number" name="prioridad" min="1" max="5" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>

            <select name="estado" required>
                <option value="activa">Activa</option>
                <option value="en_seguimiento">En seguimiento</option>
                <option value="resuelta">Resuelta</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Observaciones</label>

            <textarea name="observaciones" class="border border-gray-300 rounded px-4 py-2"></textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Guardar
        </button>
    </form>
@endsection
