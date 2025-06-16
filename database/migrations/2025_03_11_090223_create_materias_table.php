<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre de la materia
            $table->decimal('porcentual', 5, 2); // Porcentaje de la materia en la nota final
            $table->unsignedBigInteger('curso_id');  // Se usa curso_id para la relación
            $table->unsignedBigInteger('profesor_id');  // Columna para el profesor

            // Definición de claves foráneas
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');
            $table->foreign('profesor_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('materias');
    }
};
