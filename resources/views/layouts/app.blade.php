<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Core Intervención Social</title>
</head>

<body>

    <div
        style="
            width: 250px;
            float: left;
            min-height: 100vh;
            background: #f0f0f0;
            padding: 20px;
        ">

        <h2>MENÚ</h2>

        <ul>

            <li>
                <a href="{{ route('categories.index') }}">
                    Categorías
                </a>
            </li>

            <li>
                <a href="{{ route('subcategories.index') }}">
                    Subcategorías
                </a>
            </li>

            <li>
                <a href="{{ route('persons.index') }}">
                    Personas
                </a>
            </li>

            <li>
                <a href="{{ route('evaluators.index') }}">
                    Evaluadores
                </a>
            </li>

            <li>
                <a href="{{ route('person-conditions.index') }}">
                    Condiciones Sociales
                </a>
            </li>

            <li>
                <a href="{{ route('condition-followups.index') }}">
                    Seguimientos
                </a>
            </li>

            <li>
                <a href="{{ route('events.index') }}">
                    Eventos
                </a>
            </li>

            <li>
                <a href="{{ route('event-targets.index') }}">
                    Targets
                </a>
            </li>

            <li>
                <a href="{{ route('enrollments.index') }}">
                    Inscripciones
                </a>
            </li>

            <li>
                <a href="{{ route('attendances.index') }}">
                    Asistencias
                </a>
            </li>

        </ul>

        <hr>

        <p>
            Usuario:
            {{ auth()->user()->name }}
        </p>

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit">
                Cerrar sesión
            </button>
        </form>

    </div>

    <div style="
            margin-left: 270px;
            padding: 20px;
        ">

        @yield('content')

    </div>

</body>

</html>
