<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UsuarioPBJ extends Authenticatable
{
    protected $table = 'usuariospbj';

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'usuario',
        'password',
        // 'role',
        // 'grado',
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];
}