<h1>Evaluadores por Evento</h1>

@if (session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('event-evaluators.create') }}">
    Nueva Asignación
</a>

<table border="1" cellpadding="10">

    <thead>

        <tr>

            <th>ID</th>

            <th>Evento</th>

            <th>Evaluador</th>

            <th>Rol</th>

            <th>Estado</th>

            <th>Acciones</th>

        </tr>

    </thead>

    <tbody>

        @forelse($eventEvaluators as $eventEvaluator)
            <tr>

                <td>{{ $eventEvaluator->id }}</td>

                <td>
                    {{ $eventEvaluator->event->nombre ?? 'Sin evento' }}
                </td>

                <td>
                    {{ $eventEvaluator->evaluator->nombres ?? '' }}
                    {{ $eventEvaluator->evaluator->apellidos ?? '' }}
                </td>

                <td>
                    {{ $eventEvaluator->rol }}
                </td>

                <td>
                    {{ $eventEvaluator->estado }}
                </td>

                <td>

                    <a href="{{ route('event-evaluators.edit', $eventEvaluator->id) }}">
                        Editar
                    </a>

                    <form action="{{ route('event-evaluators.destroy', $eventEvaluator->id) }}" method="POST"
                        style="display:inline;">

                        @csrf
                        @method('DELETE')

                        <button type="submit">
                            Eliminar
                        </button>

                    </form>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="6">
                    No existen asignaciones registradas.
                </td>

            </tr>
        @endforelse

    </tbody>

</table>
