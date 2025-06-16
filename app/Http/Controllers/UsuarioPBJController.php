<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsuarioPBJ;
use App\Models\Curso;
use Illuminate\Support\Facades\Hash;

class UsuarioPBJController extends Controller
{
    
    public function create()
    {
        $cursos = Curso::all(); // Obtener todos los cursos disponibles
        return view('Z_PBJ.adminPBJ.crear_usuarioPBJ', compact('cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required|string',
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuariosPBJ,email',
            'usuario' => 'required|string|unique:usuariosPBJ,usuario',
            'password' => 'required|min:6',
            'grado' => 'nullable|string',
            'telefono' => 'nullable|string|max:20',
            'curso_id' => 'nullable|exists:cursos,id',
        ]);

        UsuarioPBJ::create([
            'role' => $request->role,
            'nombre' => $request->nombre,
            'email' => $request->email,
            'usuario' => $request->usuario,
            'password' => Hash::make($request->password),
            'grado' => $request->grado,
            'telefono' => $request->telefono,
            'curso_id' => $request->curso_id,
        ]);

        return redirect()->route('usuariosPBJ.create')->with('success', 'Usuario registrado con éxito');
    }

}
