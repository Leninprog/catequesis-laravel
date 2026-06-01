@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Eventos</h1>

    <a href="{{ route('events.create') }}"
        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
        Nuevo Evento
    </a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table class="w-full border border-gray-200 rounded">

        <tr>
            <th class="border px-4 py-2">Nombre</th>
            <th class="border px-4 py-2">Tipo</th>
            <th class="border px-4 py-2">Modalidad</th>
            <th class="border px-4 py-2">Estado</th>
            <th class="border px-4 py-2">Acciones</th>
        </tr>

        @foreach ($events as $event)
            <tr>

                <td class="border px-4 py-2">{{ $event->nombre }}</td>

                <td class="border px-4 py-2">{{ $event->tipo }}</td>

                <td class="border px-4 py-2">{{ $event->modalidad }}</td>

                <td class="border px-4 py-2">{{ $event->estado }}</td>

                <td class="border px-4 py-2">

                    <a href="{{ route('events.edit', $event->id) }}"
                        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
                        Editar
                    </a>

                    <form class="inline" action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">

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
