<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstudianteController extends Controller
{
    
    // Muestra el formulario de edición con los datos actuales del estudiante
    public function editar()
    {
        $estudiante = Auth::user();
        return view('estudiantes.actualizarDatos', compact('estudiante'));
    }
    
    // Procesa la actualización de los datos del estudiante
    public function actualizar(Request $request)
    {
        $data = $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20',
            // La contraseña es opcional; si se ingresa, debe ser confirmada y tener un mínimo de caracteres
        'password' => 'nullable|string|min:6|confirmed',
        ]);
        
        /** @var \App\Models\Estudiante $estudiante */
        $estudiante = Auth::user();

         // Si el campo password no está vacío, encriptamos la nueva contraseña
        if (!empty($data['password'])) {
        // Encriptamos la contraseña
        $data['password'] = bcrypt($data['password']);
        } else {
        // Si no se envió contraseña, se elimina ese campo para que no se intente actualizar
        unset($data['password']);
        }

        $estudiante->update($data);
        
        return redirect()->route('estudiante.editar')->with('mensaje', 'Datos actualizados correctamente.');
    }


    //Este metodo le muestra al estudiante si hay 
    //O no nuevos eventos 
    public function mostrarVistaEstudiante()
    {
        $userId = Auth::id();
        
        // Verificar si hay nuevos eventos para el usuario autenticado
        $hayNuevosEventos = Evento::where('destinatario_id', $userId)
            ->where('leido', false)
            ->exists();

        return view('estudiantes.estudiante', compact('hayNuevosEventos'));
    }


    //Le muestra al estudiante si hay nuevos eventos
    public function verCalendario()
    {
        $userId = Auth::id();

        // Verificar si hay eventos nuevos sin leer
        $hayNuevosEventos = Evento::where('destinatario_id', $userId)
            ->where('leido', false)
            ->exists();

        // Marcar eventos como leídos después de cargar la página
        $eventos = Evento::where('destinatario_id', $userId)->get();

        return view('estudiantes.calendario', compact('eventos', 'hayNuevosEventos'));
    }




}
