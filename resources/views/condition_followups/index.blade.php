@extends('layouts.app')
@section('content')
    <h1 class="text-3xl font-bold mb-6">Seguimientos</h1>

    <a href="{{ route('condition-followups.create') }}"
        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
        Nuevo Seguimiento
    </a>

    <table class="w-full border border-gray-200 rounded">

        <thead>

            <tr class="bg-gray-100">

                <th class="border px-4 py-2">Persona</th>
                <th class="border px-4 py-2">Subcategoría</th>
                <th class="border px-4 py-2">Nivel Anterior</th>
                <th class="border px-4 py-2">Nuevo Nivel</th>
                <th class="border px-4 py-2">Fecha</th>
                <th class="border px-4 py-2">Acciones</th>
            </tr>

        </thead>

        <tbody>

            @foreach ($followups as $followup)
                <tr>

                    <td class="border px-4 py-2">
                        {{ $followup->condition->person->nombres }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $followup->condition->subcategory->nombre }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $followup->nivel_anterior }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $followup->nivel_nuevo }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $followup->fecha }}
                    </td>

                    <td class="border px-4 py-2">

                        <a href="{{ route('condition-followups.show', $followup->id) }}"
                            class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
                            Ver
                        </a>

                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>
@endsection
