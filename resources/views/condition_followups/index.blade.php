@extends('layouts.app')
@section('content')
    <h1>Seguimientos</h1>

    <a href="{{ route('condition-followups.create') }}">
        Nuevo Seguimiento
    </a>

    <table border="1">

        <thead>

            <tr>

                <th>Persona</th>
                <th>Subcategoría</th>
                <th>Nivel Anterior</th>
                <th>Nuevo Nivel</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>

        </thead>

        <tbody>

            @foreach ($followups as $followup)
                <tr>

                    <td>
                        {{ $followup->condition->person->nombres }}
                    </td>

                    <td>
                        {{ $followup->condition->subcategory->nombre }}
                    </td>

                    <td>
                        {{ $followup->nivel_anterior }}
                    </td>

                    <td>
                        {{ $followup->nivel_nuevo }}
                    </td>

                    <td>
                        {{ $followup->fecha }}
                    </td>

                    <td>

                        <a href="{{ route('condition-followups.show', $followup->id) }}">
                            Ver
                        </a>

                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>
@endsection
