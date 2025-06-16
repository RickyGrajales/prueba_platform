<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'grado', 'descripcion', 'profesor_id',];


    public function profesor()
    {
        return $this->belongsTo(User::class, 'profesor_id');
    }

    
    public function materias()
    {
        return $this->hasMany(Materia::class, 'curso_id');
    }


    public function usuarios()
    {
        return $this->hasMany(User::class, 'curso_id');
    }

    // public function estudiantes()
    // {
    //     return $this->hasMany(Estudiante::class, 'grado_id');
    // }


    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'grado', 'grado'); // Relación con estudiantes según grado
    }

}
