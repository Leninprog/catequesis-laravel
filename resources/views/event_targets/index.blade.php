@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Objetivos de Eventos</h1>

    @if (session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('event-targets.create') }}"
        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
        Nuevo Objetivo
    </a>

    <table class="w-full border border-gray-200 rounded">

        <thead>

            <tr>

                <th class="border px-4 py-2">ID</th>

                <th class="border px-4 py-2">Evento</th>

                <th class="border px-4 py-2">Subcategoría</th>

                <th class="border px-4 py-2">Nivel Mínimo</th>

                <th class="border px-4 py-2">Nivel Máximo</th>

                <th class="border px-4 py-2">Acciones</th>

            </tr>

        </thead>

        <tbody>

            @forelse($targets as $target)
                <tr>

                    <td class="border px-4 py-2">{{ $target->id }}</td>

                    <td class="border px-4 py-2">
                        {{ $target->event->nombre ?? 'Sin evento' }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $target->subcategory->nombre ?? 'Sin subcategoría' }}
                    </td>

                    <td class="border px-4 py-2">{{ $target->nivel_min }}</td>

                    <td class="border px-4 py-2">{{ $target->nivel_max }}</td>

                    <td class="border px-4 py-2">

                        <a href="{{ route('event-targets.edit', $target->id) }}"
                            class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
                            Editar
                        </a>

                        <form class="inline" action="{{ route('event-targets.destroy', $target->id) }}" method="POST"
                            style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="inline-block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                Eliminar
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6">
                        No existen objetivos registrados.
                    </td>

                </tr>
            @endforelse

        </tbody>

    </table>
@endsection
