<?php

namespace App\Services;

use App\Models\Estudiante;

class EstudianteService
{
    public function listar()
    {
        return Estudiante::all();
    }

    public function crear(array $data)
    {
        return Estudiante::create($data);
    }

    public function actualizar(Estudiante $estudiante, array $data)
    {
        $estudiante->update($data);
        return $estudiante;
    }

    public function eliminar(Estudiante $estudiante)
    {
        return $estudiante->delete();
    }
}
