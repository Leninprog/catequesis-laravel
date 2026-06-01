@extends('layouts.app')
@section('content')

    <h1 class="text-3xl font-bold mb-6">Nueva Asistencia</h1>

    @if ($errors->any())
        <ul>

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>
    @endif

    <form action="{{ route('attendances.store') }}" method="POST">
        @csrf

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Inscripción</label>

            <select name="enrollment_id" required>

                <option value="">
                    Seleccione
                </option>

                @foreach ($enrollments as $enrollment)
                    <option value="{{ $enrollment->id }}">

                        {{ $enrollment->person->nombres }}
                        {{ $enrollment->person->apellidos }}

                        -

                        {{ $enrollment->event->nombre }}

                    </option>
                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>

            <select name="estado" required>

                <option value="asistio">
                    Asistió
                </option>

                <option value="no_asistio">
                    No asistió
                </option>

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
