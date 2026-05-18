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
                {{ $evaluator->user?->username }}
            </td>

            <td>
                {{ $evaluator->estado }}
            </td>

        </tr>
    @endforeach

</table>
