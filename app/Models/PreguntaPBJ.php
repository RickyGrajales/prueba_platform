<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreguntaPBJ extends Model
{
    use HasFactory;

    protected $table = 'preguntas_pbj';

    protected $fillable = [
        'pregunta'
    ];
}
