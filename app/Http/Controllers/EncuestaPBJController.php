<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreguntaPBJ;

class EncuestaPBJController extends Controller
{
    // Mostrar vista del admin con el formulario para crear preguntas
    public function verFormularioAdmin()
    {
        $preguntas = PreguntaPBJ::all();
        return view('Z_PBJ.adminPBJ.encuestaAlumnoPBJ', compact('preguntas'));
    }

    // Guardar preguntas desde el admin
    public function guardarPreguntas(Request $request)
    {
        $request->validate([
            'preguntas' => 'required|array|min:1',
            'preguntas.*.texto' => 'required|string|max:255',
        ]);

        foreach ($request->preguntas as $pregunta) {
            PreguntaPBJ::create([
                'pregunta' => $pregunta['texto']
            ]);
        }

        return redirect()->route('adminPBJ.encuesta')->with('success', 'Preguntas guardadas correctamente.');
    }

    // Mostrar encuesta para el estudiante
    public function verEncuestaEstudiante()
    {
        $preguntas = PreguntaPBJ::all();
        return view('Z_PBJ.estudiantesPBJ.encuestaPBJ', compact('preguntas'));
    }

    // Guardar respuestas del estudiante
    // Si ya no vas a guardar respuestas, puedes comentar o eliminar este método
    public function guardarRespuestas(Request $request)
    {
        // Opcional: eliminar este método si ya no se usarán respuestas individuales
        return redirect()->route('estudiantePBJ.encuesta')->with('info', 'Respuestas no almacenadas (función desactivada).');
    }
}
