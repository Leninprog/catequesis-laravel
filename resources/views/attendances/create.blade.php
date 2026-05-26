@extends('layouts.app')
@section('content')

    <h1>Nueva Asistencia</h1>

    @if ($errors->any())
        <ul>

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>
    @endif

    <form action="{{ route('attendances.store') }}" method="POST">
        @csrf

        <div>

            <label>Inscripción</label>

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

        <div>

            <label>Estado</label>

            <select name="estado" required>

                <option value="asistio">
                    Asistió
                </option>

                <option value="no_asistio">
                    No asistió
                </option>

            </select>

        </div>

        <div>

            <label>Observaciones</label>

            <textarea name="observaciones"></textarea>

        </div>

        <button type="submit">
            Guardar
        </button>

    </form>

@endsection
