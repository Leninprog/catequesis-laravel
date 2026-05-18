<h1>Eventos</h1>

<a href="{{ route('events.create') }}">
    Nuevo Evento
</a>

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

<table border="1">

    <tr>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Modalidad</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>

    @foreach ($events as $event)
        <tr>

            <td>{{ $event->nombre }}</td>

            <td>{{ $event->tipo }}</td>

            <td>{{ $event->modalidad }}</td>

            <td>{{ $event->estado }}</td>

            <td>

                <a href="{{ route('events.edit', $event->id) }}">
                    Editar
                </a>

                <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">

                    @csrf
                    @method('DELETE')

                    <button type="submit">
                        Eliminar
                    </button>

                </form>

            </td>

        </tr>
    @endforeach

</table>
