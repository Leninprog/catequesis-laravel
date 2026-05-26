@extends('layouts.app')

@section('content')

    <h1>Editar Subcategoría</h1>

    @if ($errors->any())
        <div>

            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>
    @endif

    <form action="{{ route('subcategories.update', $subcategory->id) }}" method="POST">

        @csrf

        @method('PUT')

        <div>

            <label>Categoría</label>

            <select name="category_id" required>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $subcategory->category_id) == $category->id)>

                        {{ $category->nombre }}

                    </option>
                @endforeach

            </select>

        </div>

        <div>

            <label>Nombre</label>

            <input type="text" name="nombre" value="{{ old('nombre', $subcategory->nombre) }}" required>

        </div>

        <div>

            <label>Descripción</label>

            <textarea name="descripcion">{{ old('descripcion', $subcategory->descripcion) }}</textarea>

        </div>

        <button type="submit">
            Actualizar
        </button>

    </form>

@endsection
