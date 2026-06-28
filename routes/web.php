<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConditionFollowupController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\EvaluatorController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventEvaluatorController;
use App\Http\Controllers\EventTargetController;
use App\Http\Controllers\PersonConditionController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('welcome'));

Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Rutas protegidas — UN SOLO grupo auth (antes eran 11 grupos separados)
|
| MEJORA: DRY + legibilidad. Todos los recursos requieren autenticación,
| no tiene sentido repetir ->middleware(['auth']) en cada uno.
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Recursos CRUD
    Route::resource('persons', PersonController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('subcategories', SubcategoryController::class);
    Route::resource('person-conditions', PersonConditionController::class);
    Route::resource('evaluators', EvaluatorController::class);
    Route::resource('condition-followups', ConditionFollowupController::class);
    Route::resource('events', EventController::class);
    Route::resource('event-targets', EventTargetController::class);
    Route::resource('event-evaluators', EventEvaluatorController::class);
    Route::resource('enrollments', EnrollmentController::class)->only(['index', 'destroy']);
    Route::resource('attendances', AttendanceController::class);
});

require __DIR__ . '/auth.php';
