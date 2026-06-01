@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Detalle del Seguimiento</h1>

    <p>
        <strong>Persona:</strong>

        {{ $conditionFollowup->condition->person->nombres }}
        {{ $conditionFollowup->condition->person->apellidos }}
    </p>

    <p>
        <strong>Subcategoría:</strong>

        {{ $conditionFollowup->condition->subcategory->nombre }}
    </p>

    <p>
        <strong>Nivel anterior:</strong>

        {{ $conditionFollowup->nivel_anterior }}
    </p>

    <p>
        <strong>Nuevo nivel:</strong>

        {{ $conditionFollowup->nivel_nuevo }}
    </p>

    <p>
        <strong>Observaciones:</strong>

        {{ $conditionFollowup->observaciones }}
    </p>

    <p>
        <strong>Fecha:</strong>

        {{ $conditionFollowup->fecha }}
    </p>
@endsection
