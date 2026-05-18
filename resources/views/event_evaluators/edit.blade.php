<h1>Editar Asignación</h1>

@if ($errors->any())

    <div>

        <ul>

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>

@endif

<form action="{{ route('event-evaluators.update', $eventEvaluator->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div>

        <label>Evento</label>

        <select name="event_id" required>

            <option value="">
                Seleccione
            </option>

            @foreach ($events as $event)
                <option value="{{ $event->id }}"
                    {{ old('event_id', $eventEvaluator->event_id) == $event->id ? 'selected' : '' }}>
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
                <option value="{{ $evaluator->id }}"
                    {{ old('evaluator_id', $eventEvaluator->evaluator_id) == $evaluator->id ? 'selected' : '' }}>
                    {{ $evaluator->nombres }}
                    {{ $evaluator->apellidos }}
                </option>
            @endforeach

        </select>

    </div>

    <div>

        <label>Rol</label>

        <input type="text" name="rol" value="{{ old('rol', $eventEvaluator->rol) }}">

    </div>

    <div>

        <label>Estado</label>

        <select name="estado" required>

            <option value="activo" {{ old('estado', $eventEvaluator->estado) == 'activo' ? 'selected' : '' }}>
                Activo
            </option>

            <option value="inactivo" {{ old('estado', $eventEvaluator->estado) == 'inactivo' ? 'selected' : '' }}>
                Inactivo
            </option>

        </select>

    </div>

    <button type="submit">
        Actualizar
    </button>

</form>
