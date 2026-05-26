@extends('layouts.app')

@section('content')

    <h1>Editar Evaluador</h1>

    @if ($errors->any())
        <div>

            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>
    @endif

    <form action="{{ route('evaluators.update', $evaluator->id) }}" method="POST">

        @csrf

        @method('PUT')

        <div>

            <label>Nombres</label>

            <input type="text" name="nombres" value="{{ old('nombres', $evaluator->nombres) }}" required>

        </div>

        <div>

            <label>Apellidos</label>

            <input type="text" name="apellidos" value="{{ old('apellidos', $evaluator->apellidos) }}" required>

        </div>

        <div>

            <label>Especialidad</label>

            <input type="text" name="especialidad" value="{{ old('especialidad', $evaluator->especialidad) }}">

        </div>

        <div>

            <label>Teléfono</label>

            <input type="text" name="telefono" value="{{ old('telefono', $evaluator->telefono) }}">

        </div>

        <div>

            <label>Email</label>

            <input type="email" name="email" value="{{ old('email', $evaluator->email) }}" required>

        </div>

        <div>

            <label>Usuario asociado</label>

            <select name="user_id">

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

        <div>

            <label>Estado</label>

            <select name="estado" required>

                <option value="activo" @selected(old('estado', $evaluator->estado) == 'activo')>
                    Activo
                </option>

                <option value="inactivo" @selected(old('estado', $evaluator->estado) == 'inactivo')>
                    Inactivo
                </option>

            </select>

        </div>

        <button type="submit">
            Actualizar
        </button>

    </form>

@endsection
