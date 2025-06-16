<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; //Importar el modelo User
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Materia; //Importar el modelo Materia
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    // Función para registrar- crear un nuevo usuario
    //Con condicionales, ciertos campos serán nuelo 
    //Para ciertos usuarios, por eso el formulario de
    //Crear usuario es interactivo
    public function register(Request $request)
    {
        $request->validate([
            // 'cedula' => 'required|string|max:255|unique:users',
            'role' => 'required',
            'nombre' => 'required',
            'email' => 'required|email|unique:users,email',
            'telefono' => 'nullable|string|max:255',
            'usuario' => 'required|unique:users,usuario',
            'password' => 'required|min:6',
            'grado' => 'required',
            'discapacidad' => 'required',
            'descripcionDiscapacidad' => 'nullable',
        ]);
       

        $roles = $request->input('role');

        
        // if($roles == "admin")
        // {
        //     // Crear un nuevo usuario
        //     $user = User::create([
        //         // 'cedula' => $request->cedula,
        //         'role' => $request->role,
        //         'nombre' => $request->nombre,
        //         'email' => $request->email,
        //         'usuario' => $request->usuario,
        //         'password' => Hash::make($request->password), // Encriptar la contraseña
        //         // 'grado' => $request->grado,
        //         'discapacidad' => $request->discapacidad,
        //         'descripcionDiscapacidad' => $request->descripcionDiscapacidad,

        //     ]);

        // }elseif($roles == "profesor" || $roles == "estudiante"  )
        // {
        //     $user = User::create([
        //         // 'cedula' => $request->cedula,
        //         'role' => $request->role,
        //         'nombre' => $request->nombre,
        //         'email' => $request->email,
        //         'usuario' => $request->usuario,
        //         'password' => Hash::make($request->password), // Encriptar la contraseña
        //         'grado' => $request->grado,
        //         'discapacidad' => $request->discapacidad,
        //         'descripcionDiscapacidad' => $request->descripcionDiscapacidad,
        //     ]);
        // }else{
        //     return Redirect()->with([
        //         'success' => true,
        //         'Error','Error,no se encontro el rol'
        //     ]);
        // }
        if ($roles === "admin" || $roles === "evaluador_pedagogico") {
            $user = User::create([
                'role' => $request->role,
                'nombre' => $request->nombre,
                'email' => $request->email,
                'usuario' => $request->usuario,
                'password' => Hash::make($request->password),
            ]);
        } elseif ($roles === "profesor" || $roles === "estudiante") {
            $user = User::create([
                'role' => $request->role,
                'nombre' => $request->nombre,
                'email' => $request->email,
                'usuario' => $request->usuario,
                'password' => Hash::make($request->password),
                'grado' => $request->grado,
                'discapacidad' => $request->discapacidad,
                'descripcionDiscapacidad' => $request->descripcionDiscapacidad,
            ]);
        } else {
            return Redirect()->with([
                'success' => false,
                'error' => 'Error, no se encontró el rol.'
            ]);
        }

        


        // Asignar materias automáticamente si es estudiante
        if ($user->role === 'estudiante' && $user->grado) {
            $materias = Materia::where('curso_id', $user->grado)->pluck('id');

            foreach ($materias as $materia_id) {
                DB::table('estudiante_materia')->insert([
                    'user_id' => $user->id,
                    'materia_id' => $materia_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Redirigir al login después del registro exitoso
        return redirect()->route('login')->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
    }

    
    // Función para hacer login
    // public function login(Request $request)
    // {

    //     $credentials = $request->validate([
    //         'usuario' => 'required',
    //         'password' => 'required',
    //     ]);


    //     // , $request->has('remember'))
    //     // Evita problemas de expiración

    //     if (Auth::attempt($credentials)) {


    //         $request->session()->regenerate();

    //         $user = Auth::user();


    //         if ($user->role == 'admin') {
    //             return redirect()->route('admin.administrador');
    //         } elseif ($user->role == 'profesor') {
    //             return redirect()->route('profesores.profesor');
    //         } elseif ($user->role == 'estudiante') {
    //             return redirect()->route('estudiantes.estudiante');
    //         } elseif ($user->role == 'evaluador_pedagogico') { // Asegúrate de que el nombre del rol en la BD es correcto
    //             return redirect()->route('evaluador_pedagogico');
    //         }
    //     }

    //     return back()->withErrors(['usuario' => 'Credenciales incorrectas']);
    // }

    // public function login(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'usuario' => 'required',
    //         'password' => 'required',
    //     ]);

    //     // Aseguramos usar el guard web explícitamente
    //     if (Auth::guard('web')->attempt([
    //         'usuario' => $credentials['usuario'],
    //         'password' => $credentials['password'],
    //     ])) {
    //         $request->session()->regenerate();

    //         $user = Auth::guard('web')->user();

    //         if ($user->role == 'admin') {
    //             return redirect()->route('admin.administrador');
    //         } elseif ($user->role == 'profesor') {
    //             return redirect()->route('profesores.profesor');
    //         } elseif ($user->role == 'estudiante') {
    //             return redirect()->route('estudiantes.estudiante');
    //         } elseif ($user->role == 'evaluador_pedagogico') {
    //             return redirect()->route('evaluador_pedagogico');
    //         }
    //     }

    //     return back()->withErrors(['usuario' => 'Credenciales incorrectas']);
    // }


    //Función para que los usuarios de la tabla users
    //Puedan iniciar sesión
    public function login(Request $request)
    {
        // Validar las credenciales del usuario
        $credentials = $request->validate([
            'usuario' => 'required',
            'password' => 'required',
        ]);
    
        // Intentar autenticar con el guard 'web' para los usuarios de la tabla 'users'
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
    
            $user = Auth::guard('web')->user();
    
            // Redirigir según el rol
            if ($user->role == 'admin') {
                return redirect()->route('admin.administrador');
            } elseif ($user->role == 'profesor') {
                return redirect()->route('profesores.profesor');
            } elseif ($user->role == 'estudiante') {
                return redirect()->route('estudiantes.estudiante');
            } elseif ($user->role == 'evaluador_pedagogico') { // Asegúrate de que el nombre del rol en la BD es correcto
                return redirect()->route('evaluador_pedagogico');
            }
        }
    
        return back()->withErrors(['usuario' => 'Credenciales incorrectas']);
    }
    


       



    // Función para devolver al usuario hacia la vista de 
    //login.blade.php cuando cierre sesión
    public function logout(Request $request)
    {

        Auth::logout();  // Cerrar sesión
        $request->session()->invalidate();  // Invalidar la sesión
        $request->session()->regenerateToken();  // Regenerar el token CSRF

        // Redirigir a la página de login.blade.php
        return redirect()->route('login');  // Redirigir al login

    }


    
    

    public function showLoginForm()
    {
        session()->regenerateToken();
        return view('auth.login');  // Asegúrate de que el archivo de la vista se llame 'login.blade.php' y esté en la carpeta 'resources/views/auth'.
    }

    public function showRegisterForm()
    {
        return view('admin.registro');
    }
}
