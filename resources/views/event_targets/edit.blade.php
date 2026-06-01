@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Editar Objetivo de Evento</h1>

    @if ($errors->any())
        <div class="mb-4 text-red-600">

            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>
    @endif

    <form class="space-y-4" action="{{ route('event-targets.update', $eventTarget->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Evento</label>

            <select name="event_id" required class="border border-gray-300 rounded px-4 py-2">

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

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Subcategoría</label>

            <select name="subcategory_id" required class="border border-gray-300 rounded px-4 py-2">

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

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Nivel Mínimo</label>

            <input type="number" name="nivel_min" min="1" max="5"
                value="{{ old('nivel_min', $eventTarget->nivel_min) }}" required>

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Nivel Máximo</label>

            <input type="number" name="nivel_max" min="1" max="5"
                value="{{ old('nivel_max', $eventTarget->nivel_max) }}" required>

        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Actualizar
        </button>

    </form>

@endsection
