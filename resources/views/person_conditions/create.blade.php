<h1>Nueva Condición Social</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('person-conditions.store') }}" method="POST">
    @csrf

    <div>
        <label>Persona</label>

        <select name="person_id" required>
            <option value="">Seleccione</option>

            @foreach ($persons as $person)
                <option value="{{ $person->id }}">
                    {{ $person->nombres }} {{ $person->apellidos }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Subcategoría</label>

        <select name="subcategory_id" required>
            <option value="">Seleccione</option>

            @foreach ($subcategories as $subcategory)
                <option value="{{ $subcategory->id }}">
                    {{ $subcategory->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Evaluador</label>

        <select name="evaluator_id">
            <option value="">Seleccione</option>

            @foreach ($evaluators as $evaluator)
                <option value="{{ $evaluator->id }}">
                    {{ $evaluator->nombres }} {{ $evaluator->apellidos }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Nivel</label>

        <input type="number" name="nivel" min="1" max="5" required>
    </div>

    <div>
        <label>Prioridad</label>

        <input type="number" name="prioridad" min="1" max="5" required>
    </div>

    <div>
        <label>Estado</label>

        <select name="estado" required>
            <option value="activa">Activa</option>
            <option value="en_seguimiento">En seguimiento</option>
            <option value="resuelta">Resuelta</option>
        </select>
    </div>

    <div>
        <label>Observaciones</label>

        <textarea name="observaciones"></textarea>
    </div>

    <button type="submit">
        Guardar
    </button>
</form>
