@extends('layouts.app')
@section('content')
    <h1 class="text-3xl font-bold mb-6">Listado de Personas</h1>

    <a href="{{ route('persons.create') }}"
        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
        Nueva Persona
    </a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table class="w-full border border-gray-200 rounded">
        <tr>
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Nombres</th>
            <th class="border px-4 py-2">Documento</th>
            <th class="border px-4 py-2">Estado</th>
            <th class="border px-4 py-2">Acciones</th>
        </tr>

        @foreach ($persons as $person)
            <tr>
                <td class="border px-4 py-2">{{ $person->id }}</td>
                <td class="border px-4 py-2">{{ $person->nombres }} {{ $person->apellidos }}</td>
                <td class="border px-4 py-2">{{ $person->documento }}</td>
                <td class="border px-4 py-2">{{ $person->estado }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('persons.edit', $person) }}"
                        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
                        Editar
                    </a>

                    <form class="inline" action="{{ route('persons.destroy', $person) }}" method="POST">
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
