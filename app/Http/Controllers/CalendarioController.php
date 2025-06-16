<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento; // Asegúrate de tener este modelo

class CalendarioController extends Controller
{
    //Este metodo le permite ver al estudiante
    //Los eventos creados por el administrador de la tabla users 
    public function ver()
    {
        // Obtener todos los eventos de la base de datos
        $eventos = Evento::all();
        $hayNuevosEventos = $eventos->count() > 0; // Verifica si hay eventos

        
        // Pasar los eventos a la vista
        return view('estudiantes.calendario', compact('eventos'));
    }
}
