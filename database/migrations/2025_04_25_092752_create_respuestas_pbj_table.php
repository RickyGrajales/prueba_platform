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
        Schema::create('respuestas_pbj', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pregunta_pbj_id');
            $table->unsignedBigInteger('estudiante_id'); // puedes usar 'user_id' si ya manejas autenticación general
            $table->string('respuesta'); // Sí / No / Tal vez
            $table->timestamps();

            // Claves foráneas
            $table->foreign('pregunta_pbj_id')->references('id')->on('preguntas_pbj')->onDelete('cascade');
            $table->foreign('estudiante_id')->references('id')->on('usuariospbj')->onDelete('cascade');
        });
    }

    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respuestas_pbj');
    }
};
