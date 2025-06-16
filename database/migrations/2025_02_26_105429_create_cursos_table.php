<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Asegúrate de que la columna 'nombre' exista
            $table->string('grado')->nullable();
            $table->text('descripcion')->nullable();
            $table->unsignedBigInteger('profesor_id')->nullable(); // Agregamos esta línea
            $table->foreign('profesor_id')->references('id')->on('users')->onDelete('set null'); // Relación
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cursos');
    }
};
