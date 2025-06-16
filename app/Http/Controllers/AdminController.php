<?php

namespace App\Http\Controllers;

use App\Models\Curso;      // Importar el modelo Curso
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;       // Importar el modelo User



class AdminController extends Controller
{
    // 🟢 Mostrar la vista principal del administrador
    public function index()
    {
        // Obtener el administrador
        $admin = User::where('role', 'admin')->first();

        if (!$admin) {
            abort(404, 'Administrador no encontrado');
        }

        return view('admin.administrador', compact('admin'));
    }

    // 🟢 Mostrar el formulario de registro
    public function showRegisterForm()
    {
        return view('admin.registro'); // Corregido el path de la vista
    }

    // 🟢 Mostrar formulario para editar perfil
    public function editar()
    {
        $administrador = Auth::user(); // Obtiene los datos del usuario autenticado
        return view('admin.actualizarDatos', compact('administrador'));
    }
    
    // 🟢 Procesar actualización de datos del administrador
    public function actualizar(Request $request)
    {
        $data = $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        /** @var \App\Models\User $admin */
        $admin = Auth::user();  // ✅ Obtener el usuario autenticado

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);  // Encriptar contraseña
        } else {
            unset($data['password']);  // Eliminar si está vacío
        }

        // 🟢 Corregido: Verifica que $admin es instancia de User
        if ($admin instanceof User) {
            $admin->update($data);  // ✅ Actualizar datos
        } else {
            abort(404, 'Administrador no encontrado.');
        }

        // return redirect()->route('administrador.editar')->with('mensaje', 'Datos actualizados correctamente.');
        return redirect()->route('admin.editar')->with('mensaje', 'Datos actualizados correctamente.');

    }


    // 🟢 Mostrar formulario para registrar nuevos usuarios
    public function registro()
    {
        return view('admin.registro');
    }

    // 🟢 Guardar nuevo usuario
    // public function guardarUsuario(Request $request)
    // {
    //     $request->validate([
    //         'nombre'   => 'required|string|max:255',
    //         'email'    => 'required|email|unique:users',
    //         'password' => 'required|string|min:8|confirmed',
    //         'role'     => 'required|string|in:admin,profesor,estudiante', // Validar roles
    //     ]);

    //     User::create([
    //         'nombre'   => $request->nombre,
    //         'email'    => $request->email,
    //         'password' => bcrypt($request->password),
    //         'role'     => $request->role,
    //     ]);

    //     return redirect()->route('administrador')->with('success', 'Usuario registrado correctamente.');
    // }
    public function guardarUsuario(Request $request) 
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|string|in:admin,profesor,estudiante', // Validar roles
            'grado'    => $request->role !== 'admin' ? 'required|string' : 'nullable', // Grado solo requerido para profesores y estudiantes
        ]);

        User::create([
            'nombre'   => $request->nombre,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => $request->role,
            'grado'    => $request->role !== 'admin' ? $request->grado : null, // Asigna grado solo si no es admin
        ]);

        return redirect()->route('administrador')->with('success', 'Usuario registrado correctamente.');
    }


    // 🟢 Mostrar la vista para crear grados con los profesores disponibles
    public function crearGrado()
    {
        $profesores = User::where('role', 'profesor')->get(); // Obtener todos los profesores
        $grados = Curso::all(); // Obtener todos los grados

        return view('admin.crear_grado', compact('profesores', 'grados'));
    }

    // 🟢 Guardar nuevo grado y asignar profesor
    public function guardarGrado(Request $request)
    {
        $request->validate([
            'nombre'         => 'required|string|max:255',
            'profesor_id'    => 'nullable|exists:users,id', // Validar si se asigna un profesor
        ]);

        $curso = Curso::create([
            'nombre'      => $request->nombre,
            'profesor_id' => $request->profesor_id,
        ]);

        return redirect()->back()->with('success', 'Grado creado exitosamente.');
    }

    // 🟢 Guardar nuevo profesor desde la vista crear_grado

    public function guardarProfesor(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'telefono' => 'nullable|string|max:20',
            'usuario'  => 'required|string|max:50|unique:users,usuario',
            'password' => 'required|string|min:6',
        ]);

        // Crear el usuario en la tabla 'users'
        $profesor = User::create([
            'nombre'   => $request->nombre,
            'email'    => $request->email,
            'telefono' => $request->telefono,
            'usuario'  => $request->usuario,
            'password' => Hash::make($request->password),
            'rol'      => 'profesor',  // Asignar el rol de profesor
        ]);

        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', '¡Profesor registrado exitosamente!');
    }


     // 🚀 **Aquí va el método `store` para guardar el grado y el profesor:**
     public function store(Request $request)
     {
         $request->validate([
             'nombre' => 'required|string',
             'curso' => 'nullable|string',
             'profesor_id' => 'nullable|exists:users,id',
         ]);
 
         // Guarda el nuevo grado en la base de datos
         Curso::create([
             'nombre' => $request->nombre,
             'curso' => $request->curso,
             'profesor_id' => $request->profesor_id,
         ]);
 
         return redirect()->back()->with('success', '¡Grado creado con éxito!');
     }

}
