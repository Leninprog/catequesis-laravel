@extends('layouts.app')

@section('content')
    <h1>Listado de Subcategorías</h1>

    <a href="{{ route('subcategories.create') }}">
        Nueva Subcategoría
    </a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10">

        <tr>

            <th>ID</th>

            <th>Categoría</th>

            <th>Nombre</th>

            <th>Descripción</th>

            <th>Acciones</th>

        </tr>

        @foreach ($subcategories as $subcategory)
            <tr>

                <td>
                    {{ $subcategory->id }}
                </td>

                <td>
                    {{ $subcategory->category->nombre }}
                </td>

                <td>
                    {{ $subcategory->nombre }}
                </td>

                <td>
                    {{ $subcategory->descripcion }}
                </td>

                <td>

                    <a href="{{ route('subcategories.edit', $subcategory->id) }}">
                        Editar
                    </a>

                    <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST"
                        style="display:inline;">

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
@endsection
