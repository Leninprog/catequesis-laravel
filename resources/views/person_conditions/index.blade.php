@extends('layouts.app')
@section('content')
    <h1 class="text-3xl font-bold mb-6">Condiciones Sociales</h1>

    <a href="{{ route('person-conditions.create') }}"
        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
        Nueva condición
    </a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table class="w-full border border-gray-200 rounded">

        <tr>
            <th class="border px-4 py-2">Persona</th>
            <th class="border px-4 py-2">Subcategoría</th>
            <th class="border px-4 py-2">Evaluador</th>
            <th class="border px-4 py-2">Nivel</th>
            <th class="border px-4 py-2">Prioridad</th>
            <th class="border px-4 py-2">Estado</th>
            <th class="border px-4 py-2">Acciones</th>
        </tr>

        @foreach ($conditions as $condition)
            <tr>
                <td class="border px-4 py-2">
                    {{ $condition->person->nombres }}
                    {{ $condition->person->apellidos }}
                </td>

                <td class="border px-4 py-2">
                    {{ $condition->subcategory->nombre }}
                </td>

                <td class="border px-4 py-2">
                    {{ $condition->evaluator?->nombres }}
                    {{ $condition->evaluator?->apellidos }}
                </td>

                <td class="border px-4 py-2">{{ $condition->nivel }}</td>

                <td class="border px-4 py-2">{{ $condition->prioridad }}</td>

                <td class="border px-4 py-2">{{ $condition->estado }}</td>

                <td class="border px-4 py-2">

                    <a href="{{ route('person-conditions.show', $condition) }}"
                        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
                        Ver
                    </a>

                </td>
            </tr>
        @endforeach

    </table>
@endsection
