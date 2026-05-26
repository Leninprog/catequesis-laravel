@extends('layouts.app')

@section('content')
    <h1>Editar Objetivo de Evento</h1>

    @if ($errors->any())
        <div>

            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>
    @endif

    <form action="{{ route('event-targets.update', $eventTarget->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div>

            <label>Evento</label>

            <select name="event_id" required>

                <option value="">
                    Seleccione
                </option>

                @foreach ($events as $event)
                    <option value="{{ $event->id }}"
                        {{ old('event_id', $eventTarget->event_id) == $event->id ? 'selected' : '' }}>
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
                    <option value="{{ $subcategory->id }}"
                        {{ old('subcategory_id', $eventTarget->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                        {{ $subcategory->nombre }}
                    </option>
                @endforeach

            </select>

        </div>

        <div>

            <label>Nivel Mínimo</label>

            <input type="number" name="nivel_min" min="1" max="5"
                value="{{ old('nivel_min', $eventTarget->nivel_min) }}" required>

        </div>

        <div>

            <label>Nivel Máximo</label>

            <input type="number" name="nivel_max" min="1" max="5"
                value="{{ old('nivel_max', $eventTarget->nivel_max) }}" required>

        </div>

        <button type="submit">
            Actualizar
        </button>

    </form>

@endsection
