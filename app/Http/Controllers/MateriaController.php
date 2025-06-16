<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;
use App\Models\Curso;
use App\Models\User;
use App\Models\Profesor;

class MateriaController extends Controller
{
    /**
     * Muestra la lista de materias.
     */
    public function index()
    {
        $materias = Materia::all();
        return view('admin.materias.index', compact('materias'));
    }

    /**
     * Muestra el formulario para crear una nueva materia.
     */
    public function create()
    {
        $cursos = Curso::all(); // ✅ Cambia $grados por $cursos
        $profesores = User::where('role', 'profesor')->get();
        return view('admin.materias.crear', compact('cursos', 'profesores')); // ✅ Envía $cursos
    }
    
    /**
     * Guarda una nueva materia en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'profesor_id' => 'required|exists:users,id',
            'nombre' => 'required|string|max:255',
            'porcentual' => 'required|numeric|min:0|max:100',
        ]);

        // Convierte $request->curso_id en un array si es un string
        $cursos = is_array($request->curso_id) ? $request->curso_id : [$request->curso_id];

        // Verifica si se seleccionó "todos"
        if (in_array("todos", $cursos)) {
            $cursos = Curso::pluck('id')->toArray(); // Obtiene todos los IDs de los cursos
        } else {
            $cursos = array_filter($cursos, fn($id) => $id !== "todos"); // Filtra "todos"
        }

        // Crea la materia para cada curso seleccionado
        foreach ($cursos as $curso_id) {
            Materia::create([
                'nombre' => $request->nombre,
                'porcentual' => $request->porcentual,
                'curso_id' => $curso_id,
                'profesor_id' => $request->profesor_id,
            ]);
        }

        return redirect()->route('admin.materias.index')->with('success', 'Materia creada correctamente.');
}


    /**
     * Muestra el formulario para editar una materia.
     */
    public function edit($id)
    {
        $materia = Materia::findOrFail($id); // Busca la materia o lanza error 404
        $cursos = Curso::all();
        $profesores = User::where('role', 'profesor')->get();
    
        return view('admin.materias.editar', compact('materia', 'cursos', 'profesores')); // Cambié 'materias' por 'materia'
    }
    
    
    
    

    /**
     * Actualiza una materia en la base de datos.
     */
    public function update(Request $request)
    {
        $request->validate([
            'materia_id' => 'required|exists:materias,id',
            'nombre' => 'required|string|max:255',
            'porcentual' => 'required|numeric|min:0|max:100',
            'grado_id' => 'required|exists:cursos,id',
            'profesor_id' => 'required|exists:users,id',
        ]);
    
        $materia = Materia::findOrFail($request->materia_id);
        $materia->update([
            'nombre' => $request->nombre,
            'porcentual' => $request->porcentual,
            'grado_id' => $request->grado_id,
            'profesor_id' => $request->profesor_id,
        ]);
    
        return redirect()->route('admin.materias.index')->with('success', 'Materia actualizada correctamente.');
    }
    

    /**
     * Elimina una materia de la base de datos.
     */
    public function destroy(Materia $materia)
    {
        $materia->delete();

        return redirect()->route('admin.materias.index')->with('success', 'Materia eliminada correctamente.');

    }


    //Este metodo es para asignarle materias al profesor
    public function asignarMaterias(Request $request, User $profesor)
    {
        $request->validate([
            'materias' => 'array', // Asegura que es una lista
            'materias.*' => 'exists:materias,id' // Valida que sean materias válidas
        ]);

        $profesor->materias()->sync($request->materias); // Asigna o quita materias

        return back()->with('success', 'Materias asignadas correctamente.');
    }

}


