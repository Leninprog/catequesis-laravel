<?php

namespace App\Services;

use App\Interfaces\EnrollmentRepositoryInterface;
use App\Interfaces\EnrollmentServiceInterface;
use App\Models\PersonCondition;

/**
 * Class EnrollmentService
 *
 * PRINCIPIO SOLID: Single Responsibility Principle (SRP)
 * Este servicio tiene UNA sola responsabilidad:
 * coordinar la lógica de negocio para generar inscripciones automáticas.
 *
 * PATRÓN DE DISEÑO: Service Layer
 * Actúa como intermediario entre los Controllers y el Repository.
 * Los controllers no saben CÓMO se generan los enrollments, solo llaman al servicio.
 *
 * PRINCIPIO SOLID: Dependency Inversion Principle (DIP)
 * Depende de la INTERFAZ EnrollmentRepositoryInterface, no de la clase concreta.
 * Esto permite intercambiar la implementación del repositorio sin tocar el servicio.
 */
class EnrollmentService implements EnrollmentServiceInterface
{
    public function __construct(
        private readonly EnrollmentRepositoryInterface $enrollmentRepository
    ) {}

    /**
     * Genera inscripciones automáticas para todos los eventos
     * compatibles con la condición dada.
     *
     * Lógica centralizada que antes estaba DUPLICADA en:
     *   - PersonConditionController::store()
     *   - ConditionFollowupController::store()
     *   - EventTargetController::store() y update()
     *
     * @return int Número de nuevas inscripciones creadas
     */
    public function generarInscripcionesAutomaticas(PersonCondition $condition): int
    {
        $targets = $this->enrollmentRepository->findCompatibleTargets($condition);

        $creadas = 0;

        foreach ($targets as $target) {
            $yaExiste = $this->enrollmentRepository->existsForPersonAndEvent(
                $condition->person_id,
                $target->event_id
            );

            if (!$yaExiste) {
                $this->enrollmentRepository->createAutomatic(
                    $condition->person_id,
                    $target->event_id
                );
                $creadas++;
            }
        }

        return $creadas;
    }
}
