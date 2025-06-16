<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;   // ✅ Importa el modelo Curso
use App\Models\User;    // ✅ Importa el modelo User para gestionar profesores

class CursoController extends Controller
{
    // ⭐ Muestra la vista para crear grados con profesores disponibles
    public function index()
    {
        $grados = Curso::all(); // ✅ Obtiene todos los grados
        $profesores = User::where('role', 'profesor')->get(); // ✅ Obtiene los profesores
        return view('admin.crear_grado', compact('grados', 'profesores'));
    }

    // ⭐ Metodo que guarda un nuevo grado y asigna profesor si se selecciona
    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:cursos,nombre',
            'grado'  => 'required|string|max:255',
            'profesor_id' => 'nullable|exists:users,id', // ✅ Valida el profesor si se envía
        ]);

        // 🟢 Crea el grado y asigna el profesor si se selecciona
        $curso = Curso::create([
            'nombre'      => $request->nombre,
            'grado'       => $request->grado,
            'profesor_id' => $request->profesor_id, // Guarda el ID del profesor si se selecciona
        ]);

        return redirect()->route('admin.crear_grado')->with('success', 'Grado creado correctamente.');
    }

    // ⭐ Metodo para eliminar un grado
    public function eliminar($id)
    {
        $grado = Curso::find($id);
        if (!$grado) {
            return redirect()->back()->with('error', 'El grado no existe.');
        }

        $grado->delete();
        return redirect()->route('admin.crear_grado')->with('success', 'Grado eliminado correctamente.');
    }
}
