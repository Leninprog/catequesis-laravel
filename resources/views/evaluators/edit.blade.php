@extends('layouts.app')

@section('content')

    <h1 class="text-3xl font-bold mb-6">Editar Evaluador</h1>

    @if ($errors->any())
        <div class="mb-4 text-red-600">

            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>
    @endif

    <form class="space-y-4" action="{{ route('evaluators.update', $evaluator->id) }}" method="POST">

        @csrf

        @method('PUT')

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Nombres</label>

            <input type="text" name="nombres" value="{{ old('nombres', $evaluator->nombres) }}" required class="border border-gray-300 rounded px-4 py-2">

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Apellidos</label>

            <input type="text" name="apellidos" value="{{ old('apellidos', $evaluator->apellidos) }}" required class="border border-gray-300 rounded px-4 py-2">

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Especialidad</label>

            <input type="text" name="especialidad" value="{{ old('especialidad', $evaluator->especialidad) }}" class="border border-gray-300 rounded px-4 py-2">

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>

            <input type="text" name="telefono" value="{{ old('telefono', $evaluator->telefono) }}" class="border border-gray-300 rounded px-4 py-2">

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>

            <input type="email" name="email" value="{{ old('email', $evaluator->email) }}" required class="border border-gray-300 rounded px-4 py-2">

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Usuario asociado</label>

            <select name="user_id" class="border border-gray-300 rounded px-4 py-2">

                <option value="">
                    Seleccione
                </option>

                @foreach ($users as $user)
                    <option value="{{ $user->id }}" @selected(old('user_id', $evaluator->user_id) == $user->id)>

                        {{ $user->name }}

                    </option>
                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>

            <select name="estado" required class="border border-gray-300 rounded px-4 py-2">

                <option value="activo" @selected(old('estado', $evaluator->estado) == 'activo')>
                    Activo
                </option>

                <option value="inactivo" @selected(old('estado', $evaluator->estado) == 'inactivo')>
                    Inactivo
                </option>

            </select>

        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Actualizar
        </button>

    </form>

@endsection
