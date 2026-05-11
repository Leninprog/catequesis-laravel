<h1>Listado de Categorías</h1>

<a href="{{ route('categories.create') }}">
    Nueva Categoría
</a>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
    </tr>

    @foreach($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->nombre }}</td>
    </tr>
    @endforeach
</table>
