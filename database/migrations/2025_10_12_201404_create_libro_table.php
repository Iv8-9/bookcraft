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
        Schema::create('libro', function (Blueprint $table) {
            $table->id();
            $table->integer('id_lector');
            $table->text('nombre_libro');
            $table->text('autor');
            $table->text('genero');
            $table->text('no_paginas');
            $table->date('fecha_publicacion');
            $table->text('imagen')->nullable();
            $table->text('personaje_favorito')->nullable();
            $table->text('personaje_odiado')->nullable();
            $table->text('frase_favorita')->nullable(); 
            $table->text('tipo_libro');
            $table->text('modo_lectura');
            $table->timestamps();

            $table->foreign('id_lector')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libro');
    }
};
