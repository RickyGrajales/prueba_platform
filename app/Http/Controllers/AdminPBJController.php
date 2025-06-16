<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\UsuarioPBJ; //Importar el modelo UsuarioPBJ
use App\Models\PreguntaPBJ; //Importar el modelo PreguntaPBJ
use App\Models\MateriaPBJ; //Importar el modelo MateriaPBJ
use Illuminate\Support\Facades\DB;






class AdminPBJController extends Controller
{
    //
    //Este metodo carga la vista administradorPBJ.blade.php
    public function index()
    {
        return view('Z_PBJ.adminPBJ.administradorPBJ');
    }

    //Este metodo redirije al administrador autenticado
    //A la vista adctualizarDatosPBJ.blade.php
    public function editar()
    {
        $administrador = Auth::guard('usuariospbj')->user();
    
        if (!$administrador) {
            return redirect()->route('login')->withErrors('Por favor inicie sesión.');
        }
    
        return view('Z_PBJ.adminPBJ.actualizarDatosPBJ', compact('administrador'));
    }


    //Este metodo le permite al administrador actualizar 
    //Sus datos desde la vista actualizarDatosPBJ.blade.php
    public function actualizar(Request $request)
    {
        /** @var \App\Models\UsuarioPBJ $administrador */
        $administrador = Auth::guard('usuariospbj')->user();

        if (!$administrador) {
            return redirect()->route('loginPBJ')->withErrors('Por favor inicie sesión.');
        }

        $data = $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:usuariosPBJ,email,' . $administrador->id,
            'telefono' => 'nullable|string|max:20',
            'password' => 'nullable|min:8|confirmed',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $administrador->update($data); // <- Esto ahora debería estar sin error

        return redirect()->route('adminPBJ.editar')->with('mensaje', 'Datos actualizados correctamente.');
    }


    //Este metodo es para crear más usuarios
    //Y guarda a los usuarios en la tabla usuariospbj
        public function store(Request $request)
    {
        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'role'     => 'required|in:admin,evaluador_pedagogico,profesor,estudiante',
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|email|unique:usuariospbj,email',
            'telefono' => 'nullable|string|max:20',
            'usuario'  => 'required|string|unique:usuariospbj,usuario',
            'password' => 'required|string|min:6',
            'grado'    => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Crear el nuevo usuario PBJ
        $usuarioPBJ = new UsuarioPBJ();
        $usuarioPBJ->role     = $request->input('role');
        $usuarioPBJ->nombre   = $request->input('nombre');
        $usuarioPBJ->email    = $request->input('email');
        $usuarioPBJ->telefono = $request->input('telefono');
        $usuarioPBJ->usuario  = $request->input('usuario');
        $usuarioPBJ->password = Hash::make($request->input('password'));

        if (in_array($usuarioPBJ->role, ['profesor', 'estudiante'])) {
            $usuarioPBJ->grado = $request->input('grado');
        }

        $usuarioPBJ->save();

        return redirect()->route('adminPBJ.administradorPBJ')->with('success', 'Usuario PBJ creado exitosamente.');
    }


    //Este metodo es para eliminar todas las preguntas
    //Y respuestas Hechas por el administrador de PBJ
    //administradorPBJ.blade.php
    public function eliminarTodas()
    {
        DB::table('respuestas_pbj')->delete();
        DB::table('preguntas_pbj')->delete();
    
        return redirect()->back()->with('success', 'Todas las preguntas y respuestas han sido eliminadas correctamente.');
    }
    
    public function indexMaterias()
    {
        $materias = MateriaPBJ::all(); // Asegúrate de importar el modelo
        return view('Z_PBJ.adminPBJ.materiasPBJ.indexMateriaPBJ', compact('materias'));
    }

  
    
}
