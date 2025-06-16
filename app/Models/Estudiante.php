<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Estudiante extends Authenticatable
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

    // public function grado()
    // {
    //     return $this->belongsTo(Curso::class, 'grado_id');
    // }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'grado', 'grado'); // Relacionar estudiantes con el curso
    }

}
