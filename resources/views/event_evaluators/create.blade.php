@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Nueva Asignación de Evaluador</h1>

    @if ($errors->any())
        <div class="mb-4 text-red-600">

            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>
    @endif

    <form class="space-y-4" action="{{ route('event-evaluators.store') }}" method="POST">

        @csrf

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Evento</label>

            <select name="event_id" required class="border border-gray-300 rounded px-4 py-2">

                <option value="">
                    Seleccione
                </option>

                @foreach ($events as $event)
                    <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                        {{ $event->nombre }}
                    </option>
                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Evaluador</label>

            <select name="evaluator_id" required class="border border-gray-300 rounded px-4 py-2">

                <option value="">
                    Seleccione
                </option>

                @foreach ($evaluators as $evaluator)
                    <option value="{{ $evaluator->id }}" {{ old('evaluator_id') == $evaluator->id ? 'selected' : '' }}>
                        {{ $evaluator->nombres }}
                        {{ $evaluator->apellidos }}
                    </option>
                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Rol</label>

            <input type="text" name="rol" value="{{ old('rol') }}" class="border border-gray-300 rounded px-4 py-2">

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>

            <select name="estado" required class="border border-gray-300 rounded px-4 py-2">

                <option value="activo">
                    Activo
                </option>

                <option value="inactivo">
                    Inactivo
                </option>

            </select>

        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Guardar
        </button>

    </form>
@endsection
