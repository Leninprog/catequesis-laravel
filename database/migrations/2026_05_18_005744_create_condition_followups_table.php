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
        Schema::create('condition_followups', function (Blueprint $table) {

            $table->id();

            $table->foreignId('condition_id')
                ->constrained('person_conditions')
                ->onDelete('cascade');

            $table->integer('nivel_anterior');

            $table->integer('nivel_nuevo');

            $table->text('observaciones')->nullable();

            $table->dateTime('fecha');

            $table->foreignId('created_by')
                ->constrained('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('condition_followups');
    }
};
