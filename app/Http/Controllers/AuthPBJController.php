<?php

namespace App\Http\Controllers;



use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class AuthPBJController extends Controller
{
    //Metodo para que los usuarios de la tabla
    //usuariospbj puedan iniciar sesión 
    public function login(Request $request) 
    {
        $credentials = $request->only('usuario', 'password');
    
        // Usamos el guard 'usuariospbj' para todos los roles
        if (Auth::guard('usuariospbj')->attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::guard('usuariospbj')->user();
    
            // Verificamos el rol para redirigir a la vista correspondiente
            if ($user->role === 'admin') {
                return redirect()->route('adminPBJ.inicio');
            }
    
            if ($user->role === 'profesor') {
                return redirect()->route('profesorPBJ.inicio');
            }
    
            if ($user->role === 'estudiante') {
                return redirect()->route('estudiantePBJ.inicio');
            }
        }
    
        // Si no se logró autenticar, devolvemos un error
        return back()->withErrors([
            'usuario' => 'Usuario o contraseña incorrectos o rol no autorizado.',
        ])->withInput();
    }
    
    //Función para que cuando cierren sesión
    //Sean redirigidos hacia la vista loginPBJ.blade.php
    public function logout(Request $request)
    {
        Auth::guard('usuariospbj')->logout();  // Usamos el guard 'usuariospbj' para cerrar sesión
        $request->session()->invalidate();    // Invalidamos la sesión
        $request->session()->regenerateToken(); // Regeneramos el token para evitar CSRF

        return redirect()->route('loginPBJ'); // Redirigimos al login de PBJ
    }



}
