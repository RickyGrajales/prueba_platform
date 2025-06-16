<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;

class Profesor extends Authenticatable

{
    // Indica que este modelo usa la tabla 'users'
    protected $table = 'users';

    // Define los campos asignables que vas a utilizar
    protected $fillable = [
        'nombre', 
        'email', 
        'password', 
        'telefono', 
    ];

    
    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'grado', 'grado');
    }

    public function grado()
    {
        return $this->belongsTo(Curso::class, 'grado_id');
    }

}
