@extends('layouts.app')
@section('content')
    <h1>Categorías</h1>

    <a href="{{ route('categories.create') }}">
        Nueva categoría
    </a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10">

        <thead>

            <tr>

                <th>ID</th>

                <th>Nombre</th>

                <th>Descripción</th>

                <th>Acciones</th>

            </tr>

        </thead>

        <tbody>

            @foreach ($categories as $category)
                <tr>

                    <td>
                        {{ $category->id }}
                    </td>

                    <td>
                        {{ $category->nombre }}
                    </td>

                    <td>
                        {{ $category->descripcion }}
                    </td>

                    <td>

                        <a href="{{ route('categories.edit', $category->id) }}">
                            Editar
                        </a>

                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">

                            @csrf

                            @method('DELETE')

                            <button type="submit">
                                Eliminar
                            </button>

                        </form>

                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>
@endsection
