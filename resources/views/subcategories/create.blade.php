@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Nueva Subcategoría</h1>

    <form class="space-y-4" action="{{ route('subcategories.store') }}" method="POST">
        @csrf

        <!-- RELACIÓN CONTROLADA -->
        <label>Categoría</label>

        <select name="category_id" required>

            <option value="">
                Seleccione una categoría
            </option>

            @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->nombre }}
                </option>
            @endforeach

        </select>

        <br><br>

        <input type="text" name="nombre" placeholder="Nombre">

        <input type="text" name="descripcion" placeholder="Descripción">

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Guardar
        </button>
    </form>
@endsection
