<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsistenciaPBJ extends Model
{
    //

    use HasFactory;

    protected $table = 'asistenciaspbj';

    protected $fillable = [

        'estudiante_id',
        'fecha',
        'asistio',
        'excusa',

    ];

    public function estudiante()
    {
        return $this->belongsTo(UsuarioPBJ::class, 'estudiante_id');
    }
}
