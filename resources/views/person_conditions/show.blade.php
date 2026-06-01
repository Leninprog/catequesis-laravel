@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Detalle de Condición</h1>

    <p>
        Persona:
        {{ $personCondition->person->nombres }}
        {{ $personCondition->person->apellidos }}
    </p>

    <p>
        Subcategoría:
        {{ $personCondition->subcategory->nombre }}
    </p>

    <p>
        Nivel actual:
        {{ $personCondition->nivel }}
    </p>

    <p>
        Prioridad:
        {{ $personCondition->prioridad }}
    </p>

    <p>
        Estado:
        {{ $personCondition->estado }}
    </p>

    <h2>Seguimientos</h2>

    <table class="w-full border border-gray-200 rounded">

        <tr>
            <th class="border px-4 py-2">Fecha</th>
            <th class="border px-4 py-2">Nivel anterior</th>
            <th class="border px-4 py-2">Nivel nuevo</th>
            <th class="border px-4 py-2">Observaciones</th>
        </tr>

        @foreach ($personCondition->followups as $followup)
            <tr>

                <td class="border px-4 py-2">
                    {{ $followup->fecha }}
                </td>

                <td class="border px-4 py-2">
                    {{ $followup->nivel_anterior }}
                </td>

                <td class="border px-4 py-2">
                    {{ $followup->nivel_nuevo }}
                </td>

                <td class="border px-4 py-2">
                    {{ $followup->observaciones }}
                </td>

            </tr>
        @endforeach

    </table>
@endsection
