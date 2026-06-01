@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Listado de Subcategorías</h1>

    <a href="{{ route('subcategories.create') }}"
        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
        Nueva Subcategoría
    </a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table class="w-full border border-gray-200 rounded">

        <tr>

            <th class="border px-4 py-2">ID</th>

            <th class="border px-4 py-2">Categoría</th>

            <th class="border px-4 py-2">Nombre</th>

            <th class="border px-4 py-2">Descripción</th>

            <th class="border px-4 py-2">Acciones</th>

        </tr>

        @foreach ($subcategories as $subcategory)
            <tr>

                <td class="border px-4 py-2">
                    {{ $subcategory->id }}
                </td>

                <td class="border px-4 py-2">
                    {{ $subcategory->category->nombre }}
                </td>

                <td class="border px-4 py-2">
                    {{ $subcategory->nombre }}
                </td>

                <td class="border px-4 py-2">
                    {{ $subcategory->descripcion }}
                </td>

                <td class="border px-4 py-2">

                    <a href="{{ route('subcategories.edit', $subcategory->id) }}"
                        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
                        Editar
                    </a>

                    <form class="inline" action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST"
                        style="display:inline;">

                        @csrf

                        @method('DELETE')

                        <button type="submit" class="inline-block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                            Eliminar
                        </button>

                    </form>

                </td>

            </tr>
        @endforeach

    </table>
@endsection
