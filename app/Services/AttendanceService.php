<?php

namespace App\Services;

use App\Interfaces\AttendanceServiceInterface;
use App\Models\Attendance;
use App\Models\Enrollment;

/**
 * Class AttendanceService
 *
 * PRINCIPIO SOLID: Single Responsibility Principle (SRP)
 * Este servicio tiene una sola responsabilidad: gestionar la lógica
 * de negocio de las asistencias, incluyendo la sincronización del
 * estado de los enrollments.
 *
 * Antes, esta lógica estaba dentro de AttendanceController, mezclando
 * responsabilidades HTTP con lógica de negocio.
 *
 * PATRÓN DE DISEÑO: Service Layer
 * El controller solo orquesta HTTP (validar request, redirigir).
 * Este servicio maneja las reglas de negocio.
 */
class AttendanceService implements AttendanceServiceInterface
{
    /**
     * Mapea estado de asistencia al estado correspondiente del enrollment.
     */
    private function resolverEstadoEnrollment(string $estadoAsistencia): string
    {
        return $estadoAsistencia === 'asistio' ? 'aprobada' : 'rechazada';
    }

    /**
     * Registra una nueva asistencia y actualiza el enrollment asociado.
     */
    public function registrar(int $enrollmentId, string $estado, ?string $observaciones): Attendance
    {
        $attendance = Attendance::create([
            'enrollment_id'    => $enrollmentId,
            'fecha_asistencia' => now(),
            'estado'           => $estado,
            'observaciones'    => $observaciones,
            'created_by'       => auth()->id(),
        ]);

        // Sincronizar estado del enrollment
        Enrollment::findOrFail($enrollmentId)->update([
            'estado' => $this->resolverEstadoEnrollment($estado),
        ]);

        return $attendance;
    }

    /**
     * Actualiza una asistencia existente y re-sincroniza el enrollment.
     */
    public function actualizar(Attendance $attendance, string $estado, ?string $observaciones): void
    {
        $attendance->update([
            'estado'        => $estado,
            'observaciones' => $observaciones,
        ]);

        $attendance->enrollment->update([
            'estado' => $this->resolverEstadoEnrollment($estado),
        ]);
    }

    /**
     * Elimina la asistencia y revierte el enrollment a 'pendiente'.
     */
    public function eliminar(Attendance $attendance): void
    {
        $attendance->enrollment->update(['estado' => 'pendiente']);
        $attendance->delete();
    }

    /**
     * Verifica si ya existe una asistencia para un enrollment.
     */
    public function yaRegistrada(int $enrollmentId): bool
    {
        return Attendance::where('enrollment_id', $enrollmentId)->exists();
    }
}
