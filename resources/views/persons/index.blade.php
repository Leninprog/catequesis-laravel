<h1>Listado de Personas</h1>

<a href="{{ route('persons.create') }}">
    Nueva Persona
</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nombres</th>
        <th>Documento</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>

    @foreach($persons as $person)
    <tr>
        <td>{{ $person->id }}</td>
        <td>{{ $person->nombres }} {{ $person->apellidos }}</td>
        <td>{{ $person->documento }}</td>
        <td>{{ $person->estado }}</td>
        <td>
            <a href="{{ route('persons.edit', $person) }}">
                Editar
            </a>

            <form action="{{ route('persons.destroy', $person) }}" method="POST">
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
