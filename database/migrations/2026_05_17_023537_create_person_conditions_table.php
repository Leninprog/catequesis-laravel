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
        Schema::create('person_conditions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('person_id')
                ->constrained('persons')
                ->onDelete('cascade');

            $table->foreignId('subcategory_id')
                ->constrained('subcategories')
                ->onDelete('cascade');

            $table->foreignId('evaluator_id')
                ->nullable()
                ->constrained('evaluators')
                ->nullOnDelete();

            $table->integer('nivel');

            $table->integer('prioridad');

            $table->enum('estado', [
                'activa',
                'en_seguimiento',
                'resuelta'
            ]);

            $table->text('observaciones')->nullable();

            $table->dateTime('fecha_inicio');

            $table->dateTime('fecha_actualizacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_conditions');
    }
};
