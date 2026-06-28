<?php

namespace App\Repositories;

use App\Interfaces\EnrollmentRepositoryInterface;
use App\Models\Enrollment;
use App\Models\EventTarget;
use App\Models\PersonCondition;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class EnrollmentRepository
 *
 * PATRÓN DE DISEÑO: Repository Pattern
 *
 * Centraliza TODO el acceso a datos relacionado con Enrollment.
 * Antes, las queries de Enrollment estaban duplicadas en 3 controllers:
 *   - PersonConditionController::store()
 *   - ConditionFollowupController::store()
 *   - EventTargetController::store() y update()
 *
 * Ahora existe un único lugar que sabe cómo hablar con la base de datos.
 * Si cambia el ORM o la lógica de búsqueda, solo se modifica aquí.
 */
class EnrollmentRepository implements EnrollmentRepositoryInterface
{
    /**
     * Verifica si ya existe una inscripción para la combinación persona+evento.
     */
    public function existsForPersonAndEvent(int $personId, int $eventId): bool
    {
        return Enrollment::where('person_id', $personId)
            ->where('event_id', $eventId)
            ->exists();
    }

    /**
     * Crea una inscripción automática con estado 'pendiente'.
     * Usa auth()->id() para registrar quién la generó.
     */
    public function createAutomatic(int $personId, int $eventId): void
    {
        Enrollment::create([
            'person_id'         => $personId,
            'event_id'          => $eventId,
            'fecha_inscripcion' => now(),
            'estado'            => 'pendiente',
            'observaciones'     => 'Generado automáticamente por compatibilidad.',
            'created_by'        => auth()->id(),
        ]);
    }

    /**
     * Busca EventTargets compatibles con la subcategoría y nivel de una condición.
     * Un target es compatible si:
     *   - Tiene la misma subcategoría
     *   - El nivel de la condición está entre nivel_min y nivel_max del target
     */
    public function findCompatibleTargets(PersonCondition $condition): Collection
    {
        return EventTarget::where('subcategory_id', $condition->subcategory_id)
            ->where('nivel_min', '<=', $condition->nivel)
            ->where('nivel_max', '>=', $condition->nivel)
            ->get();
    }
}
