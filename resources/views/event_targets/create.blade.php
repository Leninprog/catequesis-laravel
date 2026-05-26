@extends('layouts.app')
@section('content')

    <h1>Nuevo Objetivo de Evento</h1>

    @if ($errors->any())
        <div>
            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>
        </div>
    @endif

    <form action="{{ route('event-targets.store') }}" method="POST">

        @csrf

        <div>

            <label>Evento</label>

            <select name="event_id" required>

                <option value="">
                    Seleccione
                </option>

                @foreach ($events as $event)
                    <option value="{{ $event->id }}">

                        {{ $event->nombre }}

                    </option>
                @endforeach

            </select>

        </div>

        <div>

            <label>Subcategoría</label>

            <select name="subcategory_id" required>

                <option value="">
                    Seleccione
                </option>

                @foreach ($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}">

                        {{ $subcategory->nombre }}

                    </option>
                @endforeach

            </select>

        </div>

        <div>

            <label>Nivel mínimo</label>

            <input type="number" name="nivel_min" min="1" max="5" required>

        </div>

        <div>

            <label>Nivel máximo</label>

            <input type="number" name="nivel_max" min="1" max="5" required>

        </div>

        <button type="submit">
            Guardar
        </button>

    </form>
@endsection
