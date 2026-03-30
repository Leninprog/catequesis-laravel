<h1>Nuevo Estudiante</h1>

<form method="POST" action="{{ route('estudiantes.store') }}">
    @csrf

    <input name="cedula" placeholder="Cédula">
    <input name="nombres" placeholder="Nombres">
    <input name="apellidos" placeholder="Apellidos">
    <input type="date" name="fecha_nacimiento">
    <input name="direccion" placeholder="Dirección">

    <button>Guardar</button>
</form>
