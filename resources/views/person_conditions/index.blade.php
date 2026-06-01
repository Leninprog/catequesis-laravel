@extends('layouts.app')
@section('content')
    <h1>Condiciones Sociales</h1>

    <a href="{{ route('person-conditions.create') }}">
        Nueva condición
    </a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10">

        <tr>
            <th>Persona</th>
            <th>Subcategoría</th>
            <th>Evaluador</th>
            <th>Nivel</th>
            <th>Prioridad</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>

        @foreach ($conditions as $condition)
            <tr>
                <td>
                    {{ $condition->person->nombres }}
                    {{ $condition->person->apellidos }}
                </td>

                <td>
                    {{ $condition->subcategory->nombre }}
                </td>

                <td>
                    {{ $condition->evaluator?->nombres }}
                    {{ $condition->evaluator?->apellidos }}
                </td>

                <td>{{ $condition->nivel }}</td>

                <td>{{ $condition->prioridad }}</td>

                <td>{{ $condition->estado }}</td>

                <td>

                    <a href="{{ route('person-conditions.show', $condition) }}">
                        Ver
                    </a>

                </td>
            </tr>
        @endforeach

    </table>
@endsection
