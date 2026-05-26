@extends('layouts.app')
@section('content')

    <h1>Editar Asistencia</h1>

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

        <div>

            <label>Inscripción</label>

            <input type="text"
                value="
                {{ $attendance->enrollment->person->nombres }}
                {{ $attendance->enrollment->person->apellidos }}
                -
                {{ $attendance->enrollment->event->nombre }}
            "
                disabled>

        </div>

        <div>

            <label>Estado</label>

            <select name="estado" required>

                <option value="asistio" {{ $attendance->estado == 'asistio' ? 'selected' : '' }}>
                    Asistió
                </option>

                <option value="no_asistio" {{ $attendance->estado == 'no_asistio' ? 'selected' : '' }}>
                    No asistió
                </option>

            </select>

        </div>

        <div>

            <label>Observaciones</label>

            <textarea name="observaciones">
            {{ $attendance->observaciones }}
        </textarea>

        </div>

        <button type="submit">
            Actualizar
        </button>

    </form>

@endsection
