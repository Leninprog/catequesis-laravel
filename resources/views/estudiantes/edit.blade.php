<h1>Editar</h1>

<form method="POST" action="{{ route('estudiantes.update', $estudiante) }}">
    @csrf
    @method('PUT')

    <input name="cedula" value="{{ $estudiante->cedula }}">
    <input name="nombres" value="{{ $estudiante->nombres }}">
    <input name="apellidos" value="{{ $estudiante->apellidos }}">
    <input type="date" name="fecha_nacimiento" value="{{ $estudiante->fecha_nacimiento }}">
    <input name="direccion" value="{{ $estudiante->direccion }}">

    <button>Actualizar</button>
</form>
