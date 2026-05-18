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
        Schema::create('event_evaluators', function (Blueprint $table) {

            $table->id();

            $table->foreignId('event_id')
                ->constrained('events')
                ->onDelete('cascade');

            $table->foreignId('evaluator_id')
                ->constrained('evaluators')
                ->onDelete('cascade');

            $table->string('rol', 80);

            $table->enum('estado', [
                'activo',
                'inactivo'
            ])->default('activo');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_evaluators');
    }
};
