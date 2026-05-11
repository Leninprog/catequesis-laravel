<h1>Nueva Categoría</h1>

<form action="{{ route('categories.store') }}" method="POST">
    @csrf

    <input type="text" name="nombre" placeholder="Nombre">

    <input type="text" name="descripcion" placeholder="Descripción">

    <button type="submit">
        Guardar
    </button>
</form>
