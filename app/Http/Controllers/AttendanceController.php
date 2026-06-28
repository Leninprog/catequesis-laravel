<?php

namespace App\Http\Controllers;

use App\Interfaces\AttendanceServiceInterface;
use App\Models\Attendance;
use App\Models\Enrollment;
use Illuminate\Http\Request;

/**
 * AttendanceController — REFACTORIZADO
 *
 * PRINCIPIO SOLID: Single Responsibility Principle (SRP)
 * Este controller SOLO maneja:
 *   - Recibir la request HTTP
 *   - Validar los datos
 *   - Delegar al servicio
 *   - Devolver la respuesta HTTP (redirect/view)
 *
 * YA NO contiene lógica de negocio (actualizar enrollment, etc.).
 * Esa responsabilidad pertenece a AttendanceService.
 *
 * PRINCIPIO SOLID: Dependency Inversion Principle (DIP)
 * Depende de AttendanceServiceInterface (abstracción),
 * no de AttendanceService directamente.
 */
class AttendanceController extends Controller
{
    public function __construct(
        private readonly AttendanceServiceInterface $attendanceService
    ) {}

    public function index()
    {
        $attendances = Attendance::with([
            'enrollment.person',
            'enrollment.event',
            'creator',
        ])->get();

        return view('attendances.index', compact('attendances'));
    }

    public function create()
    {
        $enrollments = Enrollment::with(['person', 'event'])
            ->whereDoesntHave('attendances')
            ->get();

        return view('attendances.create', compact('enrollments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'enrollment_id' => 'required|exists:enrollments,id',
            'estado'        => 'required|in:asistio,no_asistio',
            'observaciones' => 'nullable|string|max:500',
        ]);

        // Delegamos la verificación de duplicados al servicio
        if ($this->attendanceService->yaRegistrada($request->enrollment_id)) {
            return redirect()
                ->back()
                ->withErrors(['enrollment_id' => 'La asistencia ya fue registrada.'])
                ->withInput();
        }

        // Toda la lógica de negocio está en el servicio
        $this->attendanceService->registrar(
            $request->enrollment_id,
            $request->estado,
            $request->observaciones
        );

        return redirect()
            ->route('attendances.index')
            ->with('success', 'Asistencia registrada correctamente.');
    }

    public function edit(Attendance $attendance)
    {
        $enrollments = Enrollment::with(['person', 'event'])->get();

        return view('attendances.edit', compact('attendance', 'enrollments'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'estado'        => 'required|in:asistio,no_asistio',
            'observaciones' => 'nullable|string|max:500',
        ]);

        $this->attendanceService->actualizar(
            $attendance,
            $request->estado,
            $request->observaciones
        );

        return redirect()
            ->route('attendances.index')
            ->with('success', 'Asistencia actualizada correctamente.');
    }

    public function destroy(Attendance $attendance)
    {
        $this->attendanceService->eliminar($attendance);

        return redirect()
            ->route('attendances.index')
            ->with('success', 'Asistencia eliminada correctamente.');
    }
}
