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
        Schema::create('asistenciaspbj', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estudiante_id');
            $table->date('fecha');
            $table->boolean('asistio'); // true = sí, false = no
            $table->string('excusa')->nullable();
            $table->timestamps();

            $table->foreign('estudiante_id')->references('id')->on('usuariospbj')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistenciaspbj');
    }
};
