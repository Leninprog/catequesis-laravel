@extends('layouts.app')
@section('content')

    <h1 class="text-3xl font-bold mb-6">Nuevo Objetivo de Evento</h1>

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>
        </div>
    @endif

    <form class="space-y-4" action="{{ route('event-targets.store') }}" method="POST">

        @csrf

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Evento</label>

            <select name="event_id" required class="border border-gray-300 rounded px-4 py-2">

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

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Subcategoría</label>

            <select name="subcategory_id" required class="border border-gray-300 rounded px-4 py-2">

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

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Nivel mínimo</label>

            <input type="number" name="nivel_min" min="1" max="5" required>

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Nivel máximo</label>

            <input type="number" name="nivel_max" min="1" max="5" required>

        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Guardar
        </button>

    </form>
@endsection
