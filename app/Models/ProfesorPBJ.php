<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class ProfesorPBJ extends Authenticatable
{
    protected $table = 'usuariospbj'; // asumimos que todos los roles están en la misma tabla

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'usuario',
        'password',
        'grado',
        'role'
    ];

    protected $hidden = [
        'password',
        
    ];
}


