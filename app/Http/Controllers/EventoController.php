<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;  // Importar el modelo Evento
use Illuminate\Support\Facades\Auth;


class EventoController extends Controller
{
    // Mostrar la vista para crear eventos
    public function index()
    {
        $eventos = Evento::all();
        return view('admin.eventos',compact('eventos'));
    }

    //Este metodo es para crear eventos y guardarlos
    //En la base de datos
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
        ]);

        try {
            // Guardar el evento en la base de datos
            Evento::create($request->all());

            // Redireccionar con mensaje de éxito
            return redirect()->route('admin.eventos')->with('success', 'Evento creado con éxito.');
        } catch (\Exception $e) {
            // En caso de error, redireccionar con mensaje de error
            return back()->with('error', 'Error al guardar el evento: ' . $e->getMessage());
        }
    }
    

    // Enviar los eventos a la vista del calendario de estudiantes
    public function obtenerEventos()
    {
        $eventos = Evento::all();
        return response()->json($eventos);
    }

    //Este metodo es para eliminar el evento por completo
    //Incluso de la base de datos
    public function eliminarEventos()
    {
        // Eliminar todos los eventos de la base de datos
        \App\Models\Evento::truncate(); // Borra todos los registros de la tabla eventos

        return response()->json(['mensaje' => 'Eventos eliminados correctamente']);
    }

    //Este metodo me carga el calendario en tiempo real
    //El se actualiza la fecha de manera automatica
    public function verCalendario()
    {
        $userId = Auth::id();

        // Marcar eventos como leídos para el usuario actual
        Evento::where('destinatario_id', $userId)
            ->where('leido', false)
            ->update(['leido' => true]);

        $eventos = Evento::where('destinatario_id', $userId)->get();

        return view('estudiantes.calendario', compact('eventos'));
    }



}
