@extends('layouts.app')

@section('content')

    <h1 class="text-3xl font-bold mb-6">Editar Subcategoría</h1>

    @if ($errors->any())
        <div class="mb-4" style="color: red;">

            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>
    @endif

    <form class="space-y-4" action="{{ route('subcategories.update', $subcategory->id) }}" method="POST">

        @csrf

        @method('PUT')

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>

            <select name="category_id" required class="border border-gray-300 rounded px-4 py-2">

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $subcategory->category_id) == $category->id)>

                        {{ $category->nombre }}

                    </option>
                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>

            <input type="text" name="nombre" value="{{ old('nombre', $subcategory->nombre) }}" required class="border border-gray-300 rounded px-4 py-2">

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>

            <textarea name="descripcion" class="border border-gray-300 rounded px-4 py-2">{{ old('descripcion', $subcategory->descripcion) }}</textarea>

        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Actualizar
        </button>

    </form>

@endsection
