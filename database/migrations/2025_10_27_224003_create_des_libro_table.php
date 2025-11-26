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
        Schema::create('des_libro', function (Blueprint $table) {
            $table->id();
            $table->integer('id_libro');
            $table->integer('id_clasificacion');

            $table->timestamps();

            $table->foreign('id_libro')->references('id')->on('libro');
            $table->foreign('id_clasificacion')->references('id')->on('clasificacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('des_libro');
    }
};
