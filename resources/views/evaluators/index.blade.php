@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Evaluadores</h1>

    <a href="{{ route('evaluators.create') }}"
        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
        Nuevo evaluador
    </a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table class="w-full border border-gray-200 rounded">

        <tr class="bg-gray-100">

            <th class="border px-4 py-2">Nombres</th>

            <th class="border px-4 py-2">Especialidad</th>

            <th class="border px-4 py-2">Email</th>

            <th class="border px-4 py-2">Usuario</th>

            <th class="border px-4 py-2">Estado</th>

            <th class="border px-4 py-2">Acciones</th>

        </tr>

        @foreach ($evaluators as $evaluator)
            <tr>

                <td class="border px-4 py-2">

                    {{ $evaluator->nombres }}
                    {{ $evaluator->apellidos }}

                </td>

                <td class="border px-4 py-2">
                    {{ $evaluator->especialidad }}
                </td>

                <td class="border px-4 py-2">
                    {{ $evaluator->email }}
                </td>

                <td class="border px-4 py-2">
                    {{ $evaluator->user?->name }}
                </td>

                <td class="border px-4 py-2">
                    {{ $evaluator->estado }}
                </td>

                <td class="border px-4 py-2">

                    <a href="{{ route('evaluators.edit', $evaluator->id) }}"
                        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
                        Editar
                    </a>

                    <form class="inline" action="{{ route('evaluators.destroy', $evaluator->id) }}" method="POST" style="display:inline;">

                        @csrf

                        @method('DELETE')

                        <button type="submit" class="inline-block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                            Eliminar
                        </button>

                    </form>

                </td>

            </tr>
        @endforeach

    </table>
@endsection
