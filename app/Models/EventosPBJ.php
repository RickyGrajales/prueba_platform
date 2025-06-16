<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventosPBJ extends Model
{
    //

    use HasFactory;

    protected $table = 'eventospbj';

    protected $fillable = ['titulo', 'descripcion', 'fecha'];

}
