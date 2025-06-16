<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\EstudiantePBJ;
use App\Models\PreguntaPBJ;
use App\Models\RespuestaPBJ;
use App\Models\EventosPBJ;


use Illuminate\Http\Request;

class EstudiantePBJController extends Controller
{
    //

    //Este metodo muestra el inicio de la vista
    //estudiantePBJ.blade.php
    public function inicio()
    {
        return view('Z_PBJ.estudiantesPBJ.estudiantePBJ');
    }
    

    //Este metdodo redirije al estudiantePBJ.blade.php
    //Hacia la vista actualizarDatosPBJ.blade.php
    public function editar()
    {
        $estudiante = Auth::guard('usuariospbj')->user();
    
        if (!$estudiante) {
            return redirect()->route('login')->with('error', 'No estás autenticado.');
        }
    
        return view('Z_PBJ.estudiantesPBJ.actualizarDatosPBJ', compact('estudiante'));
    }
    
    
    //Este metodo le permite al estudiante actualizar
    //Los datos y guardarlos en la base de datos
    public function actualizar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:usuariospbj,email,' . Auth::guard('usuariospbj')->id(),
            'telefono' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        /** @var \App\Models\EstudiantePBJ $estudiante */
        $estudiante = Auth::guard('usuariospbj')->user();

        $estudiante->nombre = $request->nombre;
        $estudiante->email = $request->email;
        $estudiante->telefono = $request->telefono;

        if ($request->filled('password')) {
            $estudiante->password = Hash::make($request->password);
        }

        $estudiante->save();

        return redirect()->back()->with('mensaje', 'Datos actualizados correctamente.');
    }

    //Este metodo le muestra las preguntas hechas
    //Por el administrador al estudiante de la tabla usuariospbj
    public function mostrarEncuesta()
    {
        $estudianteId = auth('usuariospbj')->id(); // Obtener el ID del estudiante autenticado
        $preguntasRespondidas = RespuestaPBJ::where('estudiante_id', $estudianteId)->pluck('pregunta_pbj_id');
        
        // Filtrar las preguntas que aún no han sido respondidas
        $preguntas = PreguntaPBJ::whereNotIn('id', $preguntasRespondidas)->get();
        
        // Verificar si ya se han respondido todas las preguntas
        $encuestaRespondida = false;
        if ($preguntas->isEmpty()) {
            $encuestaRespondida = true;
        }
    
        return view('Z_PBJ.estudiantesPBJ.encuestaPBJ', compact('preguntas', 'encuestaRespondida'));
    }
    

    //Este metodo guarda las respuestas del estudiante
    //De la tabla usuariospbj
    public function guardarRespuestas(Request $request)
    {
        // Obtener las respuestas del estudiante
        $respuestas = $request->input('respuestas');
        $estudianteId = auth('usuariospbj')->id(); // Obtener el ID del estudiante autenticado

        // Verificar si hay alguna pregunta que no ha sido respondida
        foreach ($respuestas as $preguntaId => $respuestaTexto) {
            if (empty($respuestaTexto)) {
                return back()->with('error', '¡Debe responder todas las preguntas!');
            }
        }

        // Guardar las respuestas solo si todas han sido respondidas
        foreach ($respuestas as $preguntaId => $respuestaTexto) {
            RespuestaPBJ::create([
                'pregunta_pbj_id' => $preguntaId,
                'estudiante_id' => $estudianteId,
                'respuesta' => $respuestaTexto,
            ]);
        }

        // Verificar si el estudiante ha respondido todas las preguntas
        $preguntasRespondidas = RespuestaPBJ::where('estudiante_id', $estudianteId)
                                            ->pluck('pregunta_pbj_id');
        
        $totalPreguntas = PreguntaPBJ::count();

        // Si todas las preguntas han sido respondidas, mantener al estudiante en la misma vista con mensaje de éxito
        if ($preguntasRespondidas->count() === $totalPreguntas) {
            return back()->with('success', '¡Gracias por responder todas las preguntas!');
        }

        // Si no todas las preguntas han sido respondidas, mantener al estudiante en la misma vista
        return back()->with('success', '¡Gracias por responder las preguntas!');
    }


    // public function notificacionPBJ()
    // {
    //     $eventos = EventosPBJ::orderBy('fecha', 'asc')->get();
    //     return view('Z_PBJ.adminPBJ.notificacionPBJ', compact('eventos'));
    // }
    // public function notificacionPBJ()
    // {
    //     $eventos = EventosPBJ::orderBy('fecha', 'asc')->get();
    //     return view('Z_PBJ.estudiantesPBJ.notificacionPBJ', compact('eventos'));
    // }
    

        //Poner a funcionar este metodo
        public function notificacionPBJ()
    {
        $eventos = \App\Models\EventosPBJ::orderBy('fecha', 'asc')->get();
        return view('Z_PBJ.estudiantesPBJ.notificacionPBJ', compact('eventos'));
    }

}


