<h1>Nuevo Evaluador</h1>

@if ($errors->any())

    <div>
        <ul>

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>
    </div>

@endif

<form action="{{ route('evaluators.store') }}" method="POST">

    @csrf

    <div>
        <label>Nombres</label>

        <input type="text" name="nombres" required>
    </div>

    <div>
        <label>Apellidos</label>

        <input type="text" name="apellidos" required>
    </div>

    <div>
        <label>Especialidad</label>

        <input type="text" name="especialidad">
    </div>

    <div>
        <label>Teléfono</label>

        <input type="text" name="telefono">
    </div>

    <div>
        <label>Email</label>

        <input type="email" name="email">
    </div>

    <div>
        <label>Usuario asociado</label>

        <select name="id_user">

            <option value="">
                Seleccione
            </option>

            @foreach ($users as $user)
                <option value="{{ $user->id_user }}">
                    {{ $user->username }}
                </option>
            @endforeach

        </select>
    </div>

    <div>
        <label>Estado</label>

        <select name="estado" required>

            <option value="activo">
                Activo
            </option>

            <option value="inactivo">
                Inactivo
            </option>

        </select>
    </div>

    <button type="submit">
        Guardar
    </button>

</form>
