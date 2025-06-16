<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// use App\Models\ProfesorPBJ;
use App\Models\UsuarioPBJ;
use App\Models\AsistenciaPBJ;
use App\Models\Estudiante;
use App\Models\MateriaPBJ;
use App\Models\Periodo1PBJ;
use App\Models\Periodo2PBJ;
use App\Models\Periodo3PBJ;
use Carbon\Carbon;




use Illuminate\Http\Request;

class ProfesorPBJController extends Controller
{
    //
    public function inicio()
    {
        return view('Z_PBJ.profesoresPBJ.profesorPBJ');
    }

    

    public function editar()
    {
        // Obtener el profesor autenticado en el guard 'profesorpbj'
        $profesor = Auth::guard('usuariospbj')->user();

        // Retornar la vista correcta con la variable
        return view('Z_PBJ.profesoresPBJ.actualizarDatosPBJ', compact('profesor'));
    }


    public function actualizarDatos(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
        ]);
    
        // Obtener el usuario autenticado en el guard de profesorPBJ
       /** @var \App\Models\ProfesorPBJ $profesor */
        $profesor = Auth::guard('usuariospbj')->user();
    
        // Actualizar datos
        $profesor->nombre = $request->nombre;
        $profesor->email = $request->email;
        $profesor->telefono = $request->telefono;
    
        // Si el usuario ingresó una nueva contraseña, la actualiza
        if ($request->filled('password')) {
            $profesor->password = Hash::make($request->password);
        }
    

        $profesor->save();
    
        return redirect()->back()->with('mensaje', 'Datos actualizados correctamente.');
    }



    public function llamarLista()
    {
        return view('Z_PBJ.profesoresPBJ.llamarListaPBJ');
    }
    
    

    public function verGrado()
    {
        $profesor = Auth::guard('usuariospbj')->user();
    
        // Obtener estudiantes del mismo grado, excluyendo al profesor
        $estudiantes = UsuarioPBJ::where('grado', $profesor->grado)
                                  ->where('id', '!=', $profesor->id)
                                  ->get();
    
        // Verifica si ya se registró asistencia hoy para ese grado
        $yaRegistrada = AsistenciaPBJ::whereDate('fecha', Carbon::today())
                                      ->whereIn('estudiante_id', $estudiantes->pluck('id'))
                                      ->exists();
    
        return view('Z_PBJ.gradosPBJ.gradoPBJ', compact('profesor', 'estudiantes', 'yaRegistrada'));
    }



    public function storeAsistencia(Request $request)
    {
        $fecha = now()->toDateString(); // Fecha actual
    
        // Validar que se haya enviado al menos una asistencia
        if (!$request->has('asistencia') || !is_array($request->asistencia)) {
            return redirect()->back()->with('error', 'No se ha marcado asistencia para ningún estudiante.');
        }
    
        foreach ($request->asistencia as $estudiante_id => $asistio) {
            AsistenciaPBJ::create([
                'estudiante_id' => $estudiante_id,
                'fecha' => $fecha,
                'asistio' => $asistio,
                'excusa' => $request->excusa[$estudiante_id] ?? null,
            ]);
        }
    
        return redirect()->route('profesorPBJ.grado')->with('mensaje', 'Asistencia registrada correctamente.');
    }
    

    //Metodos de redireccionamiento a las vistas de 
    //Los periodos.
    //Primer Periodo 
    public function primerPeriodo(Request $request)
    {
        $materias = MateriaPBJ::all();
        $profesor = Auth::guard('usuariospbj')->user();

        // Validar si hay materias
        if ($materias->isEmpty()) {
            return back()->with('error', 'No hay materias disponibles.');
        }

        // Obtener la materia seleccionada o tomar la primera del listado
        $materiaSeleccionada = $request->input('materia');
        if (!$materiaSeleccionada) {
            $materiaSeleccionada = $materias->first()->id;
        }

        // Obtener los estudiantes del grado del profesor
        $estudiantes = UsuarioPBJ::where('grado', $profesor->grado)
            ->where('id', '!=', $profesor->id)
            ->get();

        // Obtener las notas de esa materia
        $notas = Periodo1PBJ::where('materia_id', $materiaSeleccionada)
            ->get()
            ->keyBy('estudiante_id');

        return view('Z_PBJ.profesoresPBJ.notasPBJ.periodo1PBJ', compact(
            'materias', 'estudiantes', 'profesor', 'materiaSeleccionada', 'notas'
        ));
    }

    //Metodo para guardar notas por materia
    //Primer periodo.....
    public function guardarNotas(Request $request)
    {
        $profesor = Auth::guard('usuariospbj')->user();
        $materiaId = $request->input('materia');

        foreach ($request->input('notas') as $estudianteId => $notas) {
            $promedio = array_sum(array_filter($notas, fn($n) => $n !== null && $n !== '')) / max(count(array_filter($notas, fn($n) => $n !== null && $n !== '')), 1);
            $promedio = round($promedio, 1);

            Periodo1PBJ::updateOrCreate(
                ['estudiante_id' => $estudianteId, 'materia_id' => $materiaId],
                [
                    'nota1' => $notas[0] ?? null,
                    'nota2' => $notas[1] ?? null,
                    'nota3' => $notas[2] ?? null,
                    'nota4' => $notas[3] ?? null,
                    'nota5' => $notas[4] ?? null,
                    'nota6' => $notas[5] ?? null,
                    'promedio' => $promedio
                ]
            );
        }

        return redirect()->route('profesorPBJ.periodo1', ['materia' => $materiaId])
                 ->with('success', 'Notas guardadas correctamente.');

    }
    
    //Me tare todas las notas registradas, 
    //Las notas segun la materia a la vista
    //periodo1PBJ.blade.php
    public function obtenerNotas(Request $request)
    {
        $materiaId = $request->query('materia_id');
        $profesor = Auth::guard('usuariospbj')->user();

        // Obtener estudiantes del grado del profesor
        $estudiantes = UsuarioPBJ::where('grado', $profesor->grado)
                                ->where('id', '!=', $profesor->id)
                                ->get();

        //Obtener notas existentes del periodo 1 para esa materia
        $notas = Periodo1PBJ::where('materia_id', $materiaId)
                            ->whereIn('estudiante_id', $estudiantes->pluck('id'))
                            ->get()
                            ->keyBy('estudiante_id');

        return response()->json(['notas' => $notas]);
    }




    //Segundo Periodo
    public function segundoPeriodo()
    {
        $materias = MateriaPBJ::all();
        $profesor = Auth::guard('usuariospbj')->user();
        $estudiantes = UsuarioPBJ::where('grado', $profesor->grado)->where('id', '!=', $profesor->id)->get();

        // Selecciona la primera materia por defecto
        // $materia_id = $materias->first()->id ?? null;
        $materia_id = request()->input('materia_id') ?? $materias->first()->id ?? null;


        // Obtener notas si existen
        $notas = Periodo2PBJ::whereIn('estudiante_id', $estudiantes->pluck('id'))
            ->where('materia_id', $materia_id)
            ->get()
            ->keyBy('estudiante_id');

        return view('Z_PBJ.profesoresPBJ.notasPBJ.periodo2PBJ', compact(
            'materias', 'profesor', 'estudiantes', 'materia_id', 'notas'
        ));
        
    }

    
    public function guardarPeriodo2(Request $request)
    {
        $materia_id = $request->materia_id;

        foreach ($request->estudiantes as $data) {
            // Asegurar que cada nota es numérica, si no, poner 0
            $notas = [];
            for ($i = 1; $i <= 6; $i++) {
                $nota = isset($data["nota$i"]) && is_numeric($data["nota$i"]) ? floatval($data["nota$i"]) : 0;
                $notas[] = $nota;
            }

            // Calcular promedio de notas numéricas
            $promedio = count($notas) > 0 ? round(array_sum($notas) / count($notas), 2) : 0;

            Periodo2PBJ::updateOrCreate(
                ['estudiante_id' => $data['estudiante_id'], 'materia_id' => $materia_id],
                [
                    'nota1' => $notas[0], 'nota2' => $notas[1],
                    'nota3' => $notas[2], 'nota4' => $notas[3],
                    'nota5' => $notas[4], 'nota6' => $notas[5],
                    'promedio' => $promedio
                ]
            );
        }

        return redirect()->route('profesorPBJ.periodo2.mostrar')->with('success', 'Notas del segundo periodo guardadas correctamente.');
    }


     // Mostrar formulario de notas del periodo 2
    public function mostrarNotasSegundoPeriodo(Request $request)
    {
        $profesor = Auth::guard('usuariospbj')->user();
        $materias = MateriaPBJ::all();

        // Obtenemos el grado del profesor y todos los estudiantes de ese grado (menos el profesor)
        $estudiantes = UsuarioPBJ::where('grado', $profesor->grado)
                                ->where('id', '!=', $profesor->id)
                                ->get();

        // Si quieres que la materia se seleccione (opcional):
        $materia_id = $request->input('materia_id');
        if (!$materia_id && count($materias) > 0) {
            $materia_id = $materias[0]->id; // Selecciona la primera materia por defecto
        }

        // Obtener las notas del periodo 2 solo para los estudiantes del grado del profesor
        $notas = Periodo2PBJ::whereIn('estudiante_id', $estudiantes->pluck('id'))
                    ->where('materia_id', $materia_id)
                    ->get()
                    ->keyBy('estudiante_id'); // Para acceso rápido por ID del estudiante

        return view('Z_PBJ.profesoresPBJ.notasPBJ.periodo2PBJ', compact('profesor', 'materias', 'estudiantes', 'notas', 'materia_id'));
    }





    //Tercer Periodo
    public function tercerPeriodo()
    {
        $materias = MateriaPBJ::all();

        //Obtener profesor autenticado
        $profesor = Auth::guard('usuariospbj')->user();

        //Traer estudiantes del mismo grado
        $estudiantes = UsuarioPBJ::where('grado', $profesor->grado)
                                ->where('id', '!=', $profesor->id)
                                ->get();

        return view('Z_PBJ.profesoresPBJ.notasPBJ.periodo3PBJ', compact('materias', 'profesor', 'estudiantes'));
    }



    
    
    //Cuarto Periodo
    public function cuartoPeriodo()
    {
        $materias = MateriaPBJ::all();

        //Obtener profesor autenticado
        $profesor = Auth::guard('usuariospbj')->user();

        //Traer estudiantes del mismo grado
        $estudiantes = UsuarioPBJ::where('grado', $profesor->grado)
                                ->where('id', '!=', $profesor->id)
                                ->get();

        return view('Z_PBJ.profesoresPBJ.notasPBJ.periodo4PBJ', compact('materias', 'profesor', 'estudiantes' ));
    }
     



    
}


