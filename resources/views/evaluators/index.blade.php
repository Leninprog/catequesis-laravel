@extends('layouts.app')

@section('content')
    <h1>Evaluadores</h1>

    <a href="{{ route('evaluators.create') }}">
        Nuevo evaluador
    </a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10">

        <tr>

            <th>Nombres</th>

            <th>Especialidad</th>

            <th>Email</th>

            <th>Usuario</th>

            <th>Estado</th>

            <th>Acciones</th>

        </tr>

        @foreach ($evaluators as $evaluator)
            <tr>

                <td>

                    {{ $evaluator->nombres }}
                    {{ $evaluator->apellidos }}

                </td>

                <td>
                    {{ $evaluator->especialidad }}
                </td>

                <td>
                    {{ $evaluator->email }}
                </td>

                <td>
                    {{ $evaluator->user?->name }}
                </td>

                <td>
                    {{ $evaluator->estado }}
                </td>

                <td>

                    <a href="{{ route('evaluators.edit', $evaluator->id) }}">
                        Editar
                    </a>

                    <form action="{{ route('evaluators.destroy', $evaluator->id) }}" method="POST" style="display:inline;">

                        @csrf

                        @method('DELETE')

                        <button type="submit">
                            Eliminar
                        </button>

                    </form>

                </td>

            </tr>
        @endforeach

    </table>
@endsection
