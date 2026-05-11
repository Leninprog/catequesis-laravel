<h1>Listado de Subcategorías</h1>

<a href="{{ route('subcategories.create') }}">
    Nueva Subcategoría
</a>

<table border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Categoría</th>
        <th>Nombre</th>
    </tr>

    @foreach($subcategories as $subcategory)

    <tr>

        <td>{{ $subcategory->id }}</td>

        <td>{{ $subcategory->category->nombre }}</td>

        <td>{{ $subcategory->nombre }}</td>

    </tr>

    @endforeach

</table>
