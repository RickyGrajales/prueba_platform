<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventosPBJ;

class EventosPBJController extends Controller
{
    //Este metodo direcciona al administradorPBJ.blade.php
    //Hacia la vista eventosPBJ.blade.php
    public function index(){
        $eventos = EventosPBJ::all();
        return view ('Z_PBJ.adminPBJ.eventosPBJ', compact('eventos'));
    }


    //Este metodo es para crear eventos
    //Y se guardan en la base de datos
    public function store(Request $request){
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
        ]);

        EventosPBJ::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
        ]);

        return redirect()->route('adminPBJ.eventos')->with('success','Evento creado con exito');

    }

//Este metodo elimina los eventos creaodos 
//De la base de datos y de la vista del estudiantePB.blade.php
    public function destroyAll()
    {
        // Elimina todos los eventos de la tabla
        \App\Models\EventosPBJ::truncate(); // Asegúrate de usar el modelo correcto

        return redirect()->route('adminPBJ.eventos')->with('success', 'Todos los eventos fueron eliminados correctamente.');
    }



}
