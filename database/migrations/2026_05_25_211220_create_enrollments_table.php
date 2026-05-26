<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('person_id')
                ->constrained('persons')
                ->onDelete('cascade');

            $table->foreignId('event_id')
                ->constrained('events')
                ->onDelete('cascade');

            $table->dateTime('fecha_inscripcion');

            $table->enum('estado', [
                'pendiente',
                'aprobada',
                'rechazada',
                'cancelada'
            ]);

            $table->text('observaciones')
                ->nullable();

            $table->foreignId('created_by')
                ->constrained('users')
                ->onDelete('cascade');

            /*
            |------------------------------------------------------------------
            | EVITAR INSCRIPCIONES DUPLICADAS
            |------------------------------------------------------------------
            */

            $table->unique([
                'person_id',
                'event_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
