@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Editar Persona</h1>

    @if ($errors->any())
        <div style="color:red; border:1px solid red; padding:10px; margin-bottom:20px;">

            <strong>
                Se encontraron errores:
            </strong>

            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>
    @endif

    <form class="space-y-4" action="{{ route('persons.update', $person) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="nombres" value="{{ $person->nombres }}">
        <input type="text" name="apellidos" value="{{ $person->apellidos }}">
        <input type="text" name="documento" value="{{ $person->documento }}">
        <input type="text" name="telefono" value="{{ $person->telefono }}">
        <input type="email" name="email" value="{{ $person->email }}">
        <input type="text" name="direccion" value="{{ $person->direccion }}">

        <select name="estado">
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Actualizar
        </button>
    </form>

@endsection
