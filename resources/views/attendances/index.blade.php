@extends('layouts.app')
@section('content')
    <h1>Asistencias</h1>

    <a href="{{ route('attendances.create') }}">
        Nueva asistencia
    </a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10">

        <thead>
            <tr>
                <th>Persona</th>
                <th>Evento</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Registrado por</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($attendances as $attendance)
                <tr>

                    <td>
                        {{ $attendance->enrollment->person->nombres }}
                        {{ $attendance->enrollment->person->apellidos }}
                    </td>

                    <td>
                        {{ $attendance->enrollment->event->nombre }}
                    </td>

                    <td>
                        {{ $attendance->estado }}
                    </td>

                    <td>
                        {{ $attendance->fecha_asistencia }}
                    </td>

                    <td>
                        {{ $attendance->creator->name }}
                    </td>

                    <td>

                        <a href="{{ route('attendances.edit', $attendance->id) }}">
                            Editar
                        </a>

                        <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit">
                                Eliminar
                            </button>
                        </form>

                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>
@endsection
