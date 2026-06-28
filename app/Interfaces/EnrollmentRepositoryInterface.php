<?php

namespace App\Interfaces;

use App\Models\PersonCondition;
use App\Models\EventTarget;

/**
 * Interface EnrollmentRepositoryInterface
 *
 * PRINCIPIO SOLID: Dependency Inversion Principle (DIP)
 * Los controladores y servicios dependen de esta abstracción,
 * no de la implementación concreta (Eloquent).
 * Si mañana cambiamos el ORM, solo cambia el Repository, no los controllers.
 */
interface EnrollmentRepositoryInterface
{
    /**
     * Verifica si ya existe una inscripción para persona+evento.
     */
    public function existsForPersonAndEvent(int $personId, int $eventId): bool;

    /**
     * Crea una inscripción automática con estado 'pendiente'.
     */
    public function createAutomatic(int $personId, int $eventId): void;

    /**
     * Busca los EventTargets compatibles con una condición (subcategoria + nivel).
     */
    public function findCompatibleTargets(PersonCondition $condition): \Illuminate\Database\Eloquent\Collection;
}
