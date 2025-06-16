<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    // Indica que este modelo usa la tabla 'users'
    protected $table = 'users';

    // Define los campos asignables que vas a utilizar
    protected $fillable = [
        'nombre', 
        'email', 
        'usuario', 
        'password', 
        'grado', 
        'discapacidad', 
        'descripcionDiscapacidad', 
        'telefono', 
        'role'
        ];
}
