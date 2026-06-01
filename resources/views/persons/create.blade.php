@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Registrar Persona</h1>

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

    <form class="space-y-4" action="{{ route('persons.store') }}" method="POST">
        @csrf


        <input type="text" name="nombres" placeholder="Nombres">
        <input type="text" name="apellidos" placeholder="Apellidos">
        <input type="text" name="documento" placeholder="Documento">
        <input type="text" name="telefono" placeholder="Teléfono">
        <input type="email" name="email" placeholder="Email">
        <input type="text" name="direccion" placeholder="Dirección">

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Guardar
        </button>
    </form>

@endsection
