<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo2PBJ extends Model
{
    //
    use HasFactory;

    protected $table = 'periodo2pbj';

    protected $fillable = [
        'estudiante_id',
        'materia_id',
        'nota1',
        'nota2',
        'nota3',
        'nota4',
        'nota5',
        'nota6',
        'promedio'
    ];

    public function estudiante()
    {
        return $this->belongsTo(UsuarioPBJ::class, 'estudiante_id');
    }


    public function materia()
    {
        return $this->belongsTo(UsuarioPBJ::class, 'materia_id');
    }
    
}
