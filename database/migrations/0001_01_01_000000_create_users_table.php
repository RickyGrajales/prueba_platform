<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('usuario')->unique();
            $table->string('password');
            $table->string('grado')->nullable();
            $table->string('discapacidad')->nullable();
            $table->string('descripcionDiscapacidad')->nullable();
            $table->string('telefono')->nullable();  // Agregar el campo teléfono
            $table->unsignedBigInteger('curso_id')->nullable(); // Agregar esta línea
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('set null'); // Agregar esta línea      
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
    
};