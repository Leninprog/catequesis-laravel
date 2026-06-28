<?php

namespace App\Interfaces;

use App\Models\Attendance;
use App\Models\Enrollment;

/**
 * Interface AttendanceServiceInterface
 *
 * PRINCIPIO SOLID: Dependency Inversion Principle (DIP)
 * Separa el contrato del servicio de asistencia de su implementación concreta.
 */
interface AttendanceServiceInterface
{
    /**
     * Registra una asistencia nueva y actualiza el estado del enrollment.
     *
     * @param  int    $enrollmentId
     * @param  string $estado        'asistio' | 'no_asistio'
     * @param  string|null $observaciones
     * @return Attendance
     */
    public function registrar(int $enrollmentId, string $estado, ?string $observaciones): Attendance;

    /**
     * Actualiza una asistencia existente y sincroniza el estado del enrollment.
     */
    public function actualizar(Attendance $attendance, string $estado, ?string $observaciones): void;

    /**
     * Elimina una asistencia y revierte el enrollment a 'pendiente'.
     */
    public function eliminar(Attendance $attendance): void;

    /**
     * Verifica si un enrollment ya tiene asistencia registrada.
     */
    public function yaRegistrada(int $enrollmentId): bool;
}
