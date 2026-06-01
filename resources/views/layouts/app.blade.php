<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Core Intervención Social
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->

        <aside class="w-64 bg-white shadow-lg">

            <div class="p-6 border-b">

                <h2 class="text-xl font-bold text-gray-800">
                    Core Social
                </h2>

            </div>

            <nav class="p-4">

                <ul class="space-y-2">

                    <li>
                        <a href="{{ route('categories.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
                            Categorías
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('subcategories.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
                            Subcategorías
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('persons.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
                            Personas
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('evaluators.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
                            Evaluadores
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('person-conditions.index') }}"
                            class="block px-4 py-2 rounded hover:bg-gray-100">
                            Condiciones Sociales
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('condition-followups.index') }}"
                            class="block px-4 py-2 rounded hover:bg-gray-100">
                            Seguimientos
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('events.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
                            Eventos
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('event-targets.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
                            Targets
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('enrollments.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
                            Inscripciones
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('attendances.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
                            Asistencias
                        </a>
                    </li>

                </ul>

            </nav>

            <div class="border-t p-4 mt-4">

                <p class="text-sm text-gray-600 mb-3">
                    {{ auth()->user()->name }}
                </p>

                <form action="{{ route('logout') }}" method="POST">

                    @csrf

                    <button type="submit" class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600">

                        Cerrar sesión

                    </button>

                </form>

            </div>

        </aside>

        <!-- CONTENIDO -->

        <main class="flex-1 p-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">

                    {{ session('success') }}

                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">

                @yield('content')

            </div>

        </main>

    </div>

</body>

</html>
