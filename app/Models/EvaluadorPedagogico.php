<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluadorPedagogico extends Model
{
    use HasFactory;

    protected $table = 'evaluadores_pedagogicos'; // Nombre de la tabla
    protected $fillable = ['nombre', 'email', 'otros_campos'];
}
