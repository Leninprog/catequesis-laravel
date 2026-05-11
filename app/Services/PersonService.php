<?php

namespace App\Services;

use App\Models\Person;

class PersonService
{
    public function listar()
    {
        return Person::latest()->get();
    }

    public function crear(array $data)
    {
        return Person::create($data);
    }

    public function actualizar(Person $person, array $data)
    {
        $person->update($data);

        return $person;
    }

    public function eliminar(Person $person)
    {
        return $person->delete();
    }
}
