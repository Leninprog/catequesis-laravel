<h1>Estudiantes</h1>

<a href="{{ route('estudiantes.create') }}">Nuevo Estudiante</a>

@foreach($estudiantes as $e)
    <p>
        {{ $e->nombres }} {{ $e->apellidos }}
        <a href="{{ route('estudiantes.edit', $e) }}">Editar</a>

        <form method="POST" action="{{ route('estudiantes.destroy', $e) }}">
            @csrf
            @method('DELETE')
            <button>Eliminar</button>
        </form>
    </p>
@endforeach
