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
        Schema::create('evaluators', function (Blueprint $table) {

            $table->id();

            $table->string('nombres', 80);

            $table->string('apellidos', 80);

            $table->string('especialidad', 100)
                ->nullable();

            $table->string('telefono', 20)
                ->nullable();

            $table->string('email', 100)
                ->nullable()
                ->unique();

            $table->enum('estado', [
                'activo',
                'inactivo'
            ])->default('activo');

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluators');
    }
};
