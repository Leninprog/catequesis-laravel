<h1>Nuevo Evento</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('events.store') }}" method="POST">

    @csrf

    <div>
        <label>Nombre</label>

        <input type="text" name="nombre" required>
    </div>

    <div>
        <label>Descripción</label>

        <textarea name="descripcion"></textarea>
    </div>

    <div>
        <label>Tipo</label>

        <select name="tipo" required>
            <option value="taller">Taller</option>
            <option value="charla">Charla</option>
            <option value="brigada">Brigada</option>
            <option value="seguimiento">Seguimiento</option>
        </select>
    </div>

    <div>
        <label>Modalidad</label>

        <select name="modalidad" required>
            <option value="presencial">Presencial</option>
            <option value="virtual">Virtual</option>
            <option value="hibrido">Híbrido</option>
        </select>
    </div>

    <div>
        <label>Cupo máximo</label>

        <input type="number" name="cupo_maximo">
    </div>

    <div>
        <label>Fecha inicio</label>

        <input type="date" name="fecha_inicio" required>
    </div>

    <div>
        <label>Fecha fin</label>

        <input type="date" name="fecha_fin" required>
    </div>

    <div>
        <label>Estado</label>

        <select name="estado" required>
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
            <option value="finalizado">Finalizado</option>
        </select>
    </div>

    <button type="submit">
        Guardar
    </button>

</form>
