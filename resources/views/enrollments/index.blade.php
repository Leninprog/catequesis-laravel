@extends('layouts.app')
@section('content')
    <h1 class="text-3xl font-bold mb-6">Inscripciones</h1>

    @if (session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border border-gray-200 rounded">

        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Persona</th>
                <th class="border px-4 py-2">Evento</th>
                <th class="border px-4 py-2">Fecha</th>
                <th class="border px-4 py-2">Estado</th>
            </tr>
        </thead>

        <tbody>

            @forelse($enrollments as $enrollment)
                <tr>

                    <td class="border px-4 py-2">
                        {{ $enrollment->id }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $enrollment->person->nombres }}
                        {{ $enrollment->person->apellidos }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $enrollment->event->nombre }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $enrollment->fecha_inscripcion }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $enrollment->estado }}
                    </td>

                    {{-- <td>

                        <a href="{{ route('enrollments.edit', $enrollment) }}">
                            Editar
                        </a>

                        <form action="{{ route('enrollments.destroy', $enrollment) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="border px-4 py-2">
                                Eliminar
                            </button>
                        </form>

                    </td> --}}

                </tr>

            @empty

                <tr>
                    <td colspan="6" class="border px-4 py-2">
                        No hay inscripciones registradas.
                    </td>
                </tr>
            @endforelse

        </tbody>

    </table>
@endsection
