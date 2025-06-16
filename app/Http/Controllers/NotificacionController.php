<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    public function verificar()
    {
        // Simulación de respuesta (debes cambiarlo por datos reales desde la base de datos)
        return response()->json([
            'encuesta' => true, // Cambia a `false` si no hay encuestas
            'calendario' => true, // Cambia a `false` si no hay eventos
        ]);
    }
}
