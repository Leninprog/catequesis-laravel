<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with([
            'person',
            'event',
            'creator'
        ])->get();

        return view('enrollments.index', compact('enrollments'));
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()
            ->route('enrollments.index')
            ->with(
                'success',
                'Inscripción eliminada correctamente.'
            );
    }
}
