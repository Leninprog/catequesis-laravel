@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Nueva Categoría</h1>

    <form class="space-y-4" action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
            <input type="text" name="nombre" placeholder="Nombre" class="border border-gray-300 rounded px-4 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
            <input type="text" name="descripcion" placeholder="Descripción" class="border border-gray-300 rounded px-4 py-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Guardar
        </button>
    </form>
@endsection
