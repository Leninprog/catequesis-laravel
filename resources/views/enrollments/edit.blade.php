@extends('layouts.app')

@section('content')
    <h1>Editar Inscripción</h1>

    @if ($errors->any())
        <div>

            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>
    @endif

    <form action="{{ route('enrollments.update', $enrollment) }}" method="POST">

        @csrf
        @method('PUT')

        <div>

            <label>Persona</label>

            <select name="person_id" required>

                @foreach ($persons as $person)
                    <option value="{{ $person->id }}" {{ $enrollment->person_id == $person->id ? 'selected' : '' }}>

                        {{ $person->nombres }}
                        {{ $person->apellidos }}

                    </option>
                @endforeach

            </select>

        </div>

        <div>

            <label>Evento</label>

            <select name="event_id" required>

                @foreach ($events as $event)
                    <option value="{{ $event->id }}" {{ $enrollment->event_id == $event->id ? 'selected' : '' }}>

                        {{ $event->nombre }}

                    </option>
                @endforeach

            </select>

        </div>

        <div>

            <label>Estado</label>

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

        <div>

            <label>Observaciones</label>

            <textarea name="observaciones">{{ $enrollment->observaciones }}</textarea>

        </div>

        <button type="submit">

            Actualizar

        </button>

    </form>
@endsection
