<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ProfesorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión.');
        }

        if (Auth::user()->role !== 'profesor') {
            abort(403, 'Acceso denegado.');
        }
    
        dd('Middleware pasó - usuario autenticado: ', Auth::user());

        return $next($request);
    }
}


//Arreglar la ruta para actualizar datos
//de el profesor.blade.php