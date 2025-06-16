<?Php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $table = 'materias'; // Nombre de la tabla

    protected $fillable = [
        'nombre',
        'porcentual',
        'curso_id',  // Cambiado de grado_id a curso_id
        'profesor_id',
    ];

    // Relación con la tabla cursos
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    // Relación con la tabla users (profesor)
    public function profesor()
    {
        return $this->belongsTo(User::class, 'profesor_id');
    }
}
