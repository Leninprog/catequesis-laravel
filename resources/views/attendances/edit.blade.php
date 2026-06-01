@extends('layouts.app')
@section('content')

    <h1 class="text-3xl font-bold mb-6">Editar Asistencia</h1>

    @if ($errors->any())
        <ul>

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>
    @endif

    <form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Inscripción</label>

            <input type="text"
                value="
                {{ $attendance->enrollment->person->nombres }}
                {{ $attendance->enrollment->person->apellidos }}
                -
                {{ $attendance->enrollment->event->nombre }}
            "
                disabled>

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>

            <select name="estado" required>

                <option value="asistio" {{ $attendance->estado == 'asistio' ? 'selected' : '' }}>
                    Asistió
                </option>

                <option value="no_asistio" {{ $attendance->estado == 'no_asistio' ? 'selected' : '' }}>
                    No asistió
                </option>

            </select>

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Observaciones</label>

            <textarea name="observaciones" class="border border-gray-300 rounded px-4 py-2">
                {{ $attendance->observaciones }}
            </textarea>

        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Actualizar
        </button>

    </form>

@endsection
