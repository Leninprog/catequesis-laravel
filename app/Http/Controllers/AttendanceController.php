<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with([
            'enrollment.person',
            'enrollment.event',
            'creator'
        ])->get();

        return view('attendances.index', compact('attendances'));
    }

    public function create()
    {
        /*
        |--------------------------------------------------------------------------
        | SOLO INSCRIPCIONES SIN ASISTENCIA
        |--------------------------------------------------------------------------
        */

        $enrollments = Enrollment::with([
            'person',
            'event'
        ])
            ->whereDoesntHave('attendances')
            ->get();

        return view('attendances.create', compact('enrollments'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'enrollment_id' =>
            'required|exists:enrollments,id',

            'estado' =>
            'required|in:asistio,no_asistio',

            'observaciones' =>
            'nullable|string|max:500'
        ]);

        /*
        |--------------------------------------------------------------------------
        | EVITAR DUPLICADOS
        |--------------------------------------------------------------------------
        */

        $exists = Attendance::where(
            'enrollment_id',
            $request->enrollment_id
        )->exists();

        if ($exists) {

            return redirect()
                ->back()
                ->withErrors([
                    'enrollment_id' =>
                    'La asistencia ya fue registrada.'
                ])
                ->withInput();
        }

        Attendance::create([

            'enrollment_id' =>
            $request->enrollment_id,

            'fecha_asistencia' =>
            now(),

            'estado' =>
            $request->estado,

            'observaciones' =>
            $request->observaciones,

            'created_by' =>
            auth()->id()
        ]);

        /*
        |--------------------------------------------------------------------------
        | ACTUALIZAR ESTADO DE INSCRIPCIÓN
        |--------------------------------------------------------------------------
        */

        $enrollment = Enrollment::findOrFail(
            $request->enrollment_id
        );

        $enrollment->update([

            'estado' =>

            $request->estado === 'asistio'
                ? 'completado'
                : 'ausente'
        ]);

        return redirect()
            ->route('attendances.index')
            ->with(
                'success',
                'Asistencia registrada correctamente.'
            );
    }

    public function edit(Attendance $attendance)
    {
        $enrollments = Enrollment::with([
            'person',
            'event'
        ])->get();

        return view('attendances.edit', compact(
            'attendance',
            'enrollments'
        ));
    }

    public function update(
        Request $request,
        Attendance $attendance
    ) {
        $request->validate([

            'estado' =>
            'required|in:asistio,no_asistio',

            'observaciones' =>
            'nullable|string|max:500'
        ]);

        $attendance->update([

            'estado' =>
            $request->estado,

            'observaciones' =>
            $request->observaciones
        ]);

        /*
        |--------------------------------------------------------------------------
        | ACTUALIZAR ESTADO DE INSCRIPCIÓN
        |--------------------------------------------------------------------------
        */

        $attendance->enrollment->update([

            'estado' =>

            $request->estado === 'asistio'
                ? 'completado'
                : 'ausente'
        ]);

        return redirect()
            ->route('attendances.index')
            ->with(
                'success',
                'Asistencia actualizada correctamente.'
            );
    }

    public function destroy(Attendance $attendance)
    {
        /*
        |--------------------------------------------------------------------------
        | REVERTIR ESTADO DE INSCRIPCIÓN
        |--------------------------------------------------------------------------
        */

        $attendance->enrollment->update([

            'estado' => 'pendiente'
        ]);

        $attendance->delete();

        return redirect()
            ->route('attendances.index')
            ->with(
                'success',
                'Asistencia eliminada correctamente.'
            );
    }
}
