@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Nuevo Seguimiento</h1>

    @if ($errors->any())
        <div class="mb-4">
            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>
        </div>
    @endif

    <form class="space-y-4" action="{{ route('condition-followups.store') }}" method="POST">
        @csrf

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Condición</label>

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

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Nuevo Nivel</label>

            <input type="number" name="nivel_nuevo" min="1" max="5" required>

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Observaciones</label>

            <textarea name="observaciones" class="border border-gray-300 rounded px-4 py-2"></textarea>

        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">

            Guardar

        </button>

    </form>
@endsection
