@extends('layouts.app')
@section('content')
    <h1>Editar Categoría</h1>

    @if ($errors->any())
        <div>
            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>
        </div>
    @endif

    <form action="{{ route('categories.update', $category->id) }}" method="POST">

        @csrf

        @method('PUT')

        <div>

            <label>Nombre</label>

            <input type="text" name="nombre" value="{{ old('nombre', $category->nombre) }}" required>

        </div>

        <div>

            <label>Descripción</label>

            <textarea name="descripcion">{{ old('descripcion', $category->descripcion) }}</textarea>

        </div>

        <button type="submit">
            Actualizar
        </button>

    </form>
@endsection
