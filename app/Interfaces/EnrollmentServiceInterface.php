<?php

namespace App\Interfaces;

use App\Models\PersonCondition;

/**
 * Interface EnrollmentServiceInterface
 *
 * PRINCIPIO SOLID: Dependency Inversion Principle (DIP)
 * Los controladores dependen de esta interfaz, no de EnrollmentService directamente.
 * Facilita pruebas unitarias (se puede mockear) y desacoplamiento.
 */
interface EnrollmentServiceInterface
{
    /**
     * Genera inscripciones automáticas para una condición dada.
     * Busca todos los EventTargets compatibles y crea Enrollments si no existen.
     *
     * @param  PersonCondition $condition  La condición recién creada o actualizada
     * @return int  Número de inscripciones nuevas creadas
     */
    public function generarInscripcionesAutomaticas(PersonCondition $condition): int;
}
