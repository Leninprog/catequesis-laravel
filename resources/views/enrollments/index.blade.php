@extends('layouts.app')
@section('content')
    <h1>Inscripciones</h1>

    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <table border="1" cellpadding="10">

        <thead>
            <tr>
                <th>ID</th>
                <th>Persona</th>
                <th>Evento</th>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
        </thead>

        <tbody>

            @forelse($enrollments as $enrollment)
                <tr>

                    <td>
                        {{ $enrollment->id }}
                    </td>

                    <td>
                        {{ $enrollment->person->nombres }}
                        {{ $enrollment->person->apellidos }}
                    </td>

                    <td>
                        {{ $enrollment->event->nombre }}
                    </td>

                    <td>
                        {{ $enrollment->fecha_inscripcion }}
                    </td>

                    <td>
                        {{ $enrollment->estado }}
                    </td>

                    {{-- <td>

                        <a href="{{ route('enrollments.edit', $enrollment) }}">
                            Editar
                        </a>

                        <form action="{{ route('enrollments.destroy', $enrollment) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit">
                                Eliminar
                            </button>
                        </form>

                    </td> --}}

                </tr>

            @empty

                <tr>
                    <td colspan="6">
                        No hay inscripciones registradas.
                    </td>
                </tr>
            @endforelse

        </tbody>

    </table>
@endsection
