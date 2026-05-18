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
        Schema::create('event_targets', function (Blueprint $table) {

            $table->id();

            $table->foreignId('event_id')
                ->constrained('events')
                ->onDelete('cascade');;

            $table->foreignId('subcategory_id')
                ->constrained('subcategories')
                ->onDelete('cascade');;

            $table->integer('nivel_min');

            $table->integer('nivel_max');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_targets');
    }
};
