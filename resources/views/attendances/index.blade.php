@extends('layouts.app')
@section('content')
    <h1 class="text-3xl font-bold mb-6">Asistencias</h1>

    <a href="{{ route('attendances.create') }}"
        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
        Nueva asistencia
    </a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table class="w-full border border-gray-200 rounded">

        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Persona</th>
                <th class="border px-4 py-2">Evento</th>
                <th class="border px-4 py-2">Estado</th>
                <th class="border px-4 py-2">Fecha</th>
                <th class="border px-4 py-2">Registrado por</th>
                <th class="border px-4 py-2">Acciones</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($attendances as $attendance)
                <tr>

                    <td class="border px-4 py-2">
                        {{ $attendance->enrollment->person->nombres }}
                        {{ $attendance->enrollment->person->apellidos }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $attendance->enrollment->event->nombre }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $attendance->estado }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $attendance->fecha_asistencia }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $attendance->creator->name }}
                    </td>

                    <td class="border px-4 py-2">

                        <a href="{{ route('attendances.edit', $attendance->id) }}"
                            class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
                            Editar
                        </a>

                        <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="inline-block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                Eliminar
                            </button>
                        </form>

                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>
@endsection
