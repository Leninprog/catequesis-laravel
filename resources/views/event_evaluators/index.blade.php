@extends('layouts.app')
@section('content')
    <h1 class="text-3xl font-bold mb-6">Evaluadores por Evento</h1>

    @if (session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('event-evaluators.create') }}"
        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
        Nueva Asignación
    </a>

    <table class="w-full border border-gray-200 rounded">

        <thead>

            <tr>

                <th class="border px-4 py-2">ID</th>

                <th class="border px-4 py-2">Evento</th>

                <th class="border px-4 py-2">Evaluador</th>

                <th class="border px-4 py-2">Rol</th>

                <th class="border px-4 py-2">Estado</th>

                <th class="border px-4 py-2">Acciones</th>

            </tr>

        </thead>

        <tbody>

            @forelse($eventEvaluators as $eventEvaluator)
                <tr>

                    <td class="border px-4 py-2">{{ $eventEvaluator->id }}</td>

                    <td class="border px-4 py-2">
                        {{ $eventEvaluator->event->nombre ?? 'Sin evento' }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $eventEvaluator->evaluator->nombres ?? '' }}
                        {{ $eventEvaluator->evaluator->apellidos ?? '' }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $eventEvaluator->rol }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $eventEvaluator->estado }}
                    </td>

                    <td class="border px-4 py-2">

                        <a href="{{ route('event-evaluators.edit', $eventEvaluator->id) }}"
                            class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
                            Editar
                        </a>

                        <form class="inline" action="{{ route('event-evaluators.destroy', $eventEvaluator->id) }}" method="POST"
                            style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="inline-block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                Eliminar
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6">
                        No existen asignaciones registradas.
                    </td>

                </tr>
            @endforelse

        </tbody>

    </table>
@endsection
