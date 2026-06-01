@extends('layouts.app')
@section('content')

    <h1 class="text-3xl font-bold mb-6">Nuevo Evento</h1>

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="space-y-4" action="{{ route('events.store') }}" method="POST">

        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>

            <input type="text" name="nombre" required class="border border-gray-300 rounded px-4 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>

            <textarea name="descripcion" class="border border-gray-300 rounded px-4 py-2"></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>

            <select name="tipo" required>
                <option value="taller">Taller</option>
                <option value="charla">Charla</option>
                <option value="brigada">Brigada</option>
                <option value="seguimiento">Seguimiento</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Modalidad</label>

            <select name="modalidad" required>
                <option value="presencial">Presencial</option>
                <option value="virtual">Virtual</option>
                <option value="hibrido">Híbrido</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Cupo máximo</label>

            <input type="number" name="cupo_maximo" class="border border-gray-300 rounded px-4 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Fecha inicio</label>

            <input type="date" name="fecha_inicio" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Fecha fin</label>

            <input type="date" name="fecha_fin" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>

            <select name="estado" required>
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
                <option value="finalizado">Finalizado</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Guardar
        </button>

    </form>

@endsection
