<h1>Nueva Subcategoría</h1>

<form action="{{ route('subcategories.store') }}" method="POST">
    @csrf

    <!-- RELACIÓN CONTROLADA -->
    <label>Categoría</label>

    <select name="category_id" required>

        <option value="">
            Seleccione una categoría
        </option>

        @foreach($categories as $category)

            <option value="{{ $category->id }}">
                {{ $category->nombre }}
            </option>

        @endforeach

    </select>

    <br><br>

    <input type="text" name="nombre" placeholder="Nombre">

    <input type="text" name="descripcion" placeholder="Descripción">

    <button type="submit">
        Guardar
    </button>
</form>
