<h1>Objetivos de Eventos</h1>

@if (session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('event-targets.create') }}">
    Nuevo Objetivo
</a>

<table border="1" cellpadding="10">

    <thead>

        <tr>

            <th>ID</th>

            <th>Evento</th>

            <th>Subcategoría</th>

            <th>Nivel Mínimo</th>

            <th>Nivel Máximo</th>

            <th>Acciones</th>

        </tr>

    </thead>

    <tbody>

        @forelse($targets as $target)
            <tr>

                <td>{{ $target->id }}</td>

                <td>
                    {{ $target->event->nombre ?? 'Sin evento' }}
                </td>

                <td>
                    {{ $target->subcategory->nombre ?? 'Sin subcategoría' }}
                </td>

                <td>{{ $target->nivel_min }}</td>

                <td>{{ $target->nivel_max }}</td>

                <td>

                    <a href="{{ route('event-targets.edit', $target->id) }}">
                        Editar
                    </a>

                    <form action="{{ route('event-targets.destroy', $target->id) }}" method="POST"
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
                    No existen objetivos registrados.
                </td>

            </tr>
        @endforelse

    </tbody>

</table>
