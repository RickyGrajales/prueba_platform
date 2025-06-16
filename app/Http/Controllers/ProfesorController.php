<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Profesor;
use App\Models\Estudiante; //Asegúrate de tener el modelo correcto
use App\Models\User;
use App\Models\Curso;


class ProfesorController extends Controller
{
    public function editar()
    {
        
        $profesor = Auth::user();
        return view('profesores.actualizarDatos', compact('profesor'));
    
    }

    // public function actualizar(Request $request)
    // {
    //     $data = $request->validate([
    //         'nombre'    => 'required|string|max:255',
    //         'email'     => 'required|string|max:255',
    //         'telefono'  => 'nullable|string|max:20',
    //          // La contraseña es opcional; si se ingresa, debe ser confirmada y tener un mínimo de caracteres
    //         'password' => 'nullable|string|min:6|confirmed',
    //     ]);

    //         /** @var \App\Models\Profesor $profesor */
    //         $profesor = Auth::User();

    //         if(!empty($data['password'])){
    //         // Encriptamos la contraseña
    //         $data['password'] = bcrypt($data['password']);
                
    //         }else{
    //         // Si no se envió contraseña, se elimina ese campo para que no se intente actualizar
    //         unset($data['password']);
    //         }

    //         $profesor->update($data);

    //         //🔒 Reautenticar al usuario después de cambiar sus datos
    //         Auth::login($profesor);
    //         return redirect()->route('profesor.editar')->with('mensaje','Datos actualizador correctamente');
            
    // }
    public function actualizar(Request $request)
    {
        $user = Auth::user(); // ya está logueado
    
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telefono' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
        ]);
    
        $user->nombre = $request->nombre;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
    
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        /**
        * @var \App\Models\User
        */
        $user = Auth::user();

        $user->save(); // ya no debería marcar en rojo

        
        return back()->with('mensaje', 'Datos actualizados correctamente.');
    }
    

    


    public function mostrarGrado()
    {
        
        // Obtener el usuario autenticado y su grado
        $grado = Auth::user()->grado;

        // Verificar si el usuario tiene un grado asignado
        if (!$grado) {
            return redirect()->back()->with('error', 'No tienes un grado asignado.');
        }

        // Buscar al profesor que tiene asignado ese grado
        $profesor = User::where('role', 'profesor')
                        ->where('grado', $grado)
                        ->first();

        // Obtener todos los estudiantes que pertenecen a ese grado
        $estudiantes = User::where('role', 'estudiante')
                        ->where('grado', $grado)
                        ->get();

        return view('grados.grado', compact('grado', 'profesor', 'estudiantes'));
    }

    
    

    public function asignarMaterias(Request $request, $id)
    {
        $profesor = User::findOrFail($id); // Buscar al profesor
        $profesor->materias()->sync($request->materias); // Asignar las materias seleccionadas

        return redirect()->back()->with('success', 'Materias asignadas correctamente.');
    }




}


