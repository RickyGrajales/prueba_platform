<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluadorPedagogicoController extends Controller
{

    //Metodo que carga la vista de el evaluador pedagogico
    //Después de iniciar sesión
    public function index()
    {
        return view('evaluador_pedagogico.evaPedagogico');
    }

    
}

