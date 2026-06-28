<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Interfaces
use App\Interfaces\EnrollmentRepositoryInterface;
use App\Interfaces\EnrollmentServiceInterface;
use App\Interfaces\AttendanceServiceInterface;

// Implementaciones concretas
use App\Repositories\EnrollmentRepository;
use App\Services\EnrollmentService;
use App\Services\AttendanceService;

/**
 * AppServiceProvider
 *
 * PRINCIPIO SOLID: Dependency Inversion Principle (DIP)
 *
 * Aquí Laravel aprende qué clase concreta usar cuando alguien
 * pide una interfaz. Los controllers y services piden la INTERFAZ,
 * Laravel inyecta la IMPLEMENTACIÓN.
 *
 * Ventaja: si mañana queremos cambiar EnrollmentRepository por
 * una implementación que use una API externa, solo cambiamos
 * el binding aquí. Los controllers no se tocan.
 */
class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Repository: interfaz → implementación Eloquent
        $this->app->bind(
            EnrollmentRepositoryInterface::class,
            EnrollmentRepository::class
    );

        // Service: interfaz → implementación concreta
        $this->app->bind(
            EnrollmentServiceInterface::class,
            EnrollmentService::class
        );

        $this->app->bind(
            AttendanceServiceInterface::class,
            AttendanceService::class
        );
    }

    public function boot(): void
    {
        //
    }
}
