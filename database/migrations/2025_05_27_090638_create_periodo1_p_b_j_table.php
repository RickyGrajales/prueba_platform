<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class createPeriodo1PBJTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('periodo1PBJ', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('estudiante_id');
            $table->unsignedBigInteger('materia_id');
            $table->decimal('nota1', 3, 1)->nullable();
            $table->decimal('nota2', 3, 1)->nullable();
            $table->decimal('nota3', 3, 1)->nullable();
            $table->decimal('nota4', 3, 1)->nullable();
            $table->decimal('nota5', 3, 1)->nullable();
            $table->decimal('nota6', 3, 1)->nullable();
            $table->decimal('promedio', 3, 1)->nullable();
            $table->timestamps();

            $table->foreign('estudiante_id')->references('id')->on('usuariosPBJ')->onDelete('cascade');
            $table->foreign('materia_id')->references('id')->on('materiaPBJ')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('periodo1PBJ');
    }
};
