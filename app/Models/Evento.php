<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos'; // Asegúrate de que el nombre de la tabla sea correcto

    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha',
    ];
}
