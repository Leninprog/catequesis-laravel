@extends('layouts.app')

@section('content')
    <h1>Detalle de Condición</h1>

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

    <table border="1">

        <tr>
            <th>Fecha</th>
            <th>Nivel anterior</th>
            <th>Nivel nuevo</th>
            <th>Observaciones</th>
        </tr>

        @foreach ($personCondition->followups as $followup)
            <tr>

                <td>
                    {{ $followup->fecha }}
                </td>

                <td>
                    {{ $followup->nivel_anterior }}
                </td>

                <td>
                    {{ $followup->nivel_nuevo }}
                </td>

                <td>
                    {{ $followup->observaciones }}
                </td>

            </tr>
        @endforeach

    </table>
@endsection
