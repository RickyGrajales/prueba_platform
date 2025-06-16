<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'role', 'nombre', 'email', 'usuario', 'password', 'grado', 'discapacidad', 'descripcionDiscapacidad' , 'telefono'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function getAuthIdentifierName()
    {
        return 'usuario'; // Aquí estamos usando 'usuario' como el campo de login
    }

    // Definir el campo que se usará para la contraseña
    public function getAuthPassword()
    {
        return $this->password;
    }

    // Si tienes un campo para 'email_verified_at' o algún otro campo para verificar la cuenta,
    // asegúrate de incluirlo en tu migración y modelo, pero no es necesario si solo te basas en usuario.

    public function materias()
    {
        return $this->hasMany(Materia::class, 'profesor_id');
    }

    
    // public function curso()
    // {
    //     return $this->belongsTo(Curso::class, 'curso_id');
    // }


    public function curso()
    {
        return $this->hasOne(Curso::class, 'profesor_id'); // Un profesor tiene un curso
    }

    public function estudianteCursos()
    {
        return $this->hasMany(Estudiante::class, 'usuario_id'); // Un estudiante pertenece a un curso
    }



}
