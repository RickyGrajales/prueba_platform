<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;

    protected $table = 'respuestas'; // Asegura que Laravel use la tabla correcta

    protected $fillable = [
        'pregunta_id', // Relación con la pregunta
        'estudiante_id', // ID del estudiante que responde
        'respuesta', // Respuesta dada
    ];

    public function pregunta()
    {
    return $this->belongsTo(Pregunta::class, 'pregunta_id');
    }

    public function estudiante()
    {
    return $this->belongsTo(User::class, 'estudiante_id');
    }


}
