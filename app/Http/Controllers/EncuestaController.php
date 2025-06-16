<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Pregunta;
use App\Models\Respuesta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class EncuestaController extends Controller
{
    // Cargar preguntas no respondidas para el estudiante
    public function ver()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->withErrors(['error' => 'Debes iniciar sesión.']);
        }

        // Obtener preguntas que el estudiante no ha respondido
        $preguntas = Pregunta::whereDoesntHave('respuestas', function ($query) use ($user) {
            $query->where('estudiante_id', $user->id);
        })->get();

        return view('estudiantes.encuesta', compact('preguntas'));
    }

    // Guardar respuestas del estudiante
    public function guardarRespuestas(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return back()->withErrors(['error' => 'No se encontró un usuario autenticado.']);
        }

        $request->validate([
            'respuestas' => 'required|array',
            'respuestas.*' => 'required|string|max:255',
        ]);

        // Guardar respuestas y eliminar preguntas respondidas
        foreach ($request->input('respuestas') as $preguntaId => $respuesta) {
            Respuesta::create([
                'estudiante_id' => $user->id,
                'pregunta_id' => $preguntaId,
                'respuesta' => $respuesta,
            ]);
        }

        return redirect()->route('estudiantes.encuesta')->with('success', 'Respuestas guardadas correctamente.');
    }

    // Guardar nuevas preguntas sin eliminar las existentes
    public function guardarPreguntas(Request $request)
    {
        $request->validate([
            'preguntas' => 'required|array',
            'preguntas.*' => 'required|string|max:255',
        ]);

        foreach ($request->preguntas as $texto) {
            Pregunta::create(['texto' => $texto]);
        }

        return redirect()->route('admin.encuesta')->with('success', 'Preguntas guardadas correctamente.');
    }

    // Eliminar preguntas antiguas (más de 4 meses)
    public function eliminarPreguntasAntiguas()
    {
        $fechaLimite = Carbon::now()->subMonths(4);
        Pregunta::where('created_at', '<', $fechaLimite)->delete();
    }

    //
    public function mostrarEncuesta()
    {
        $preguntas = Pregunta::all(); // Obtener todas las preguntas
        return view('admin.encuesta_alumno', compact('preguntas'));
    }

}


