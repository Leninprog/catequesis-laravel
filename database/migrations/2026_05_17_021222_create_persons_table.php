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
        Schema::create('persons', function (Blueprint $table) {

            $table->id();

            $table->string('nombres', 80);

            $table->string('apellidos', 80);

            $table->string('documento', 20)->unique();

            $table->string('telefono', 20)->nullable();

            $table->string('email', 100)->nullable();

            $table->string('direccion', 150)->nullable();

            $table->enum('estado', [
                'activo',
                'inactivo'
            ])->default('activo');

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
