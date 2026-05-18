<h1>Nueva Asignación de Evaluador</h1>

@if ($errors->any())

    <div>

        <ul>

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>

@endif

<form action="{{ route('event-evaluators.store') }}" method="POST">

    @csrf

    <div>

        <label>Evento</label>

        <select name="event_id" required>

            <option value="">
                Seleccione
            </option>

            @foreach ($events as $event)
                <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                    {{ $event->nombre }}
                </option>
            @endforeach

        </select>

    </div>

    <div>

        <label>Evaluador</label>

        <select name="evaluator_id" required>

            <option value="">
                Seleccione
            </option>

            @foreach ($evaluators as $evaluator)
                <option value="{{ $evaluator->id }}" {{ old('evaluator_id') == $evaluator->id ? 'selected' : '' }}>
                    {{ $evaluator->nombres }}
                    {{ $evaluator->apellidos }}
                </option>
            @endforeach

        </select>

    </div>

    <div>

        <label>Rol</label>

        <input type="text" name="rol" value="{{ old('rol') }}">

    </div>

    <div>

        <label>Estado</label>

        <select name="estado" required>

            <option value="activo">
                Activo
            </option>

            <option value="inactivo">
                Inactivo
            </option>

        </select>

    </div>

    <button type="submit">
        Guardar
    </button>

</form>
