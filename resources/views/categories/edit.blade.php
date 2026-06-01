@extends('layouts.app')
@section('content')
    <h1 class="text-3xl font-bold mb-6">Editar Categoría</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>
        </div>
    @endif

    <form class="space-y-4" action="{{ route('categories.update', $category->id) }}" method="POST">

        @csrf

        @method('PUT')

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>

            <input type="text" name="nombre" value="{{ old('nombre', $category->nombre) }}" required class="border border-gray-300 rounded px-4 py-2">

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>

            <textarea name="descripcion" class="border border-gray-300 rounded px-4 py-2">{{ old('descripcion', $category->descripcion) }}</textarea>

        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Actualizar
        </button>

    </form>
@endsection
