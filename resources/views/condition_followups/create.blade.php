@extends('layouts.app')

@section('content')
    <h1>Nuevo Seguimiento</h1>

    @if ($errors->any())
        <div>
            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>
        </div>
    @endif

    <form action="{{ route('condition-followups.store') }}" method="POST">
        @csrf

        <div>

            <label>Condición</label>

            <select name="condition_id" required>

                <option value="">
                    Seleccione
                </option>

                @foreach ($conditions as $condition)
                    <option value="{{ $condition->id }}">

                        {{ $condition->person->nombres }}

                        {{ $condition->person->apellidos }}

                        -

                        {{ $condition->subcategory->nombre }}

                    </option>
                @endforeach

            </select>

        </div>

        <div>

            <label>Nuevo Nivel</label>

            <input type="number" name="nivel_nuevo" min="1" max="5" required>

        </div>

        <div>

            <label>Observaciones</label>

            <textarea name="observaciones"></textarea>

        </div>

        <button type="submit">

            Guardar

        </button>

    </form>
@endsection
