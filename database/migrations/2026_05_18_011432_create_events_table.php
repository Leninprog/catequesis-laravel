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
        Schema::create('events', function (Blueprint $table) {

            $table->id();

            $table->string('nombre', 100);

            $table->string('descripcion', 250)->nullable();

            $table->string('tipo', 30);

            $table->string('modalidad', 20);

            $table->integer('cupo_maximo')->nullable();

            $table->date('fecha_inicio');

            $table->date('fecha_fin');

            $table->string('estado', 20)
                ->default('activo');

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
