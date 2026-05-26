@extends('layouts.app')
@section('content')

    <h1>Editar Evento</h1>

    @if ($errors->any())
        <div>
            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>
        </div>
    @endif

    <form action="{{ route('events.update', $event->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div>

            <label>Nombre</label>

            <input type="text" name="nombre" value="{{ old('nombre', $event->nombre) }}" required>

        </div>

        <div>

            <label>Descripción</label>

            <textarea name="descripcion">{{ old('descripcion', $event->descripcion) }}</textarea>

        </div>

        <div>

            <label>Tipo</label>

            <select name="tipo" required>

                <option value="taller" {{ old('tipo', $event->tipo) == 'taller' ? 'selected' : '' }}>
                    Taller
                </option>

                <option value="charla" {{ old('tipo', $event->tipo) == 'charla' ? 'selected' : '' }}>
                    Charla
                </option>

                <option value="brigada" {{ old('tipo', $event->tipo) == 'brigada' ? 'selected' : '' }}>
                    Brigada
                </option>

                <option value="seguimiento" {{ old('tipo', $event->tipo) == 'seguimiento' ? 'selected' : '' }}>
                    Seguimiento
                </option>

            </select>

        </div>

        <div>

            <label>Modalidad</label>

            <select name="modalidad" required>

                <option value="presencial" {{ old('modalidad', $event->modalidad) == 'presencial' ? 'selected' : '' }}>
                    Presencial
                </option>

                <option value="virtual" {{ old('modalidad', $event->modalidad) == 'virtual' ? 'selected' : '' }}>
                    Virtual
                </option>

                <option value="hibrido" {{ old('modalidad', $event->modalidad) == 'hibrido' ? 'selected' : '' }}>
                    Híbrido
                </option>

            </select>

        </div>

        <div>

            <label>Cupo máximo</label>

            <input type="number" name="cupo_maximo" value="{{ old('cupo_maximo', $event->cupo_maximo) }}">

        </div>

        <div>

            <label>Fecha inicio</label>

            <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio', $event->fecha_inicio) }}" required>

        </div>

        <div>

            <label>Fecha fin</label>

            <input type="date" name="fecha_fin" value="{{ old('fecha_fin', $event->fecha_fin) }}" required>

        </div>

        <div>

            <label>Estado</label>

            <select name="estado" required>

                <option value="activo" {{ old('estado', $event->estado) == 'activo' ? 'selected' : '' }}>
                    Activo
                </option>

                <option value="inactivo" {{ old('estado', $event->estado) == 'inactivo' ? 'selected' : '' }}>
                    Inactivo
                </option>

                <option value="finalizado" {{ old('estado', $event->estado) == 'finalizado' ? 'selected' : '' }}>
                    Finalizado
                </option>

            </select>

        </div>

        <button type="submit">
            Actualizar
        </button>

    </form>

@endsection
