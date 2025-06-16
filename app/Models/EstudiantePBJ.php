<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class EstudiantePBJ extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuariospbj'; // ← porque los estudiantes están en esa tabla

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'usuario',
        'password',
        'role', // y cualquier otro campo
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
