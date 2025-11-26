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
        Schema::create('progreso', function (Blueprint $table) {
            $table->id();
            $table->integer('id_libro');
            $table->integer('id_estatus');

            $table->timestamps();

            $table->foreign('id_libro')->references('id')->on('libro');
            $table->foreign('id_estatus')->references('id')->on('estatus');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progreso');
    }
};
