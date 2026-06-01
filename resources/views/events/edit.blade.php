@extends('layouts.app')
@section('content')

    <h1 class="text-3xl font-bold mb-6">Editar Evento</h1>

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>
        </div>
    @endif

    <form class="space-y-4" action="{{ route('events.update', $event->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>

            <input type="text" name="nombre" value="{{ old('nombre', $event->nombre) }}" required class="border border-gray-300 rounded px-4 py-2">

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>

            <textarea name="descripcion" class="border border-gray-300 rounded px-4 py-2">{{ old('descripcion', $event->descripcion) }}</textarea>

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>

            <select name="tipo" required>

                <option value="taller" {{ old('tipo', $event->tipo) == 'taller' ? 'selected' : '' }}>
                    Taller
                </option>

                <option value="charla" {{ old('tipo', $event->tipo) == 'charla' ? 'selected' : '' }}>
                    Charla
                </option>

                <option value="brigada" {{ old('tipo', $event->tipo) == 'brigada' ? 'selected' : '' }}>
                    Brigada
                </option>

                <option value="seguimiento" {{ old('tipo', $event->tipo) == 'seguimiento' ? 'selected' : '' }}>
                    Seguimiento
                </option>

            </select>

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Modalidad</label>

            <select name="modalidad" required>

                <option value="presencial" {{ old('modalidad', $event->modalidad) == 'presencial' ? 'selected' : '' }}>
                    Presencial
                </option>

                <option value="virtual" {{ old('modalidad', $event->modalidad) == 'virtual' ? 'selected' : '' }}>
                    Virtual
                </option>

                <option value="hibrido" {{ old('modalidad', $event->modalidad) == 'hibrido' ? 'selected' : '' }}>
                    Híbrido
                </option>

            </select>

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Cupo máximo</label>

            <input type="number" name="cupo_maximo" value="{{ old('cupo_maximo', $event->cupo_maximo) }}" class="border border-gray-300 rounded px-4 py-2">

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Fecha inicio</label>

            <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio', $event->fecha_inicio) }}" required>

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Fecha fin</label>

            <input type="date" name="fecha_fin" value="{{ old('fecha_fin', $event->fecha_fin) }}" required>

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>

            <select name="estado" required>

                <option value="activo" {{ old('estado', $event->estado) == 'activo' ? 'selected' : '' }}>
                    Activo
                </option>

                <option value="inactivo" {{ old('estado', $event->estado) == 'inactivo' ? 'selected' : '' }}>
                    Inactivo
                </option>

                <option value="finalizado" {{ old('estado', $event->estado) == 'finalizado' ? 'selected' : '' }}>
                    Finalizado
                </option>

            </select>

        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Actualizar
        </button>

    </form>

@endsection
