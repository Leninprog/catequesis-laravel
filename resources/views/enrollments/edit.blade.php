@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Editar Inscripción</h1>

    @if ($errors->any())
        <div class="mb-4">

            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>
    @endif

    <form class="space-y-4" action="{{ route('enrollments.update', $enrollment) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Persona</label>

            <select name="person_id" required>

                @foreach ($persons as $person)
                    <option value="{{ $person->id }}" {{ $enrollment->person_id == $person->id ? 'selected' : '' }}>

                        {{ $person->nombres }}
                        {{ $person->apellidos }}

                    </option>
                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Evento</label>

            <select name="event_id" required>

                @foreach ($events as $event)
                    <option value="{{ $event->id }}" {{ $enrollment->event_id == $event->id ? 'selected' : '' }}>

                        {{ $event->nombre }}

                    </option>
                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>

            <select name="estado">

                <option value="pendiente" {{ $enrollment->estado == 'pendiente' ? 'selected' : '' }}>
                    Pendiente
                </option>

                <option value="confirmada" {{ $enrollment->estado == 'confirmada' ? 'selected' : '' }}>
                    Confirmada
                </option>

                <option value="cancelada" {{ $enrollment->estado == 'cancelada' ? 'selected' : '' }}>
                    Cancelada
                </option>

            </select>

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Observaciones</label>

            <textarea name="observaciones" class="border border-gray-300 rounded px-4 py-2">{{ $enrollment->observaciones }}</textarea>

        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">

            Actualizar

        </button>

    </form>
@endsection
