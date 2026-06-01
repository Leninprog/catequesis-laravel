@extends('layouts.app')
@section('content')
    <h1 class="text-3xl font-bold mb-6">Categorías</h1>

    <a href="{{ route('categories.create') }}"
        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
        Nueva categoría
    </a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table class="w-full border border-gray-200 rounded">

        <thead>

            <tr class="bg-gray-100">

                <th class="border px-4 py-2">ID</th>

                <th class="border px-4 py-2">Nombre</th>

                <th class="border px-4 py-2">Descripción</th>

                <th class="border px-4 py-2">Acciones</th>

            </tr>

        </thead>

        <tbody>

            @foreach ($categories as $category)
                <tr>

                    <td class="border px-4 py-2">
                        {{ $category->id }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $category->nombre }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $category->descripcion }}
                    </td>

                    <td class="border px-4 py-2">

                        <a href="{{ route('categories.edit', $category->id) }}"
                            class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
                            Editar
                        </a>

                        <form class="inline" action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">

                            @csrf

                            @method('DELETE')

                            <button type="submit" class="inline-block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                Eliminar
                            </button>

                        </form>

                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>
@endsection
