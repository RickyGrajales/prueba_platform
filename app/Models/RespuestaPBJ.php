<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaPBJ extends Model
{
    use HasFactory;

    protected $table = 'respuestas_pbj';

    protected $fillable = [
        'pregunta_pbj_id',
        'estudiante_id',
        'respuesta',
    ];

    public function pregunta()
    {
        return $this->belongsTo(PreguntaPBJ::class, 'pregunta_pbj_id');
    }

    public function estudiante()
    {
        return $this->belongsTo(User::class, 'estudiante_id');
    }
}