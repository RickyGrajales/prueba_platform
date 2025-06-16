<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\User;
use Carbon\Carbon;

class AsistenciaController extends Controller {

    //Este metodo guarda en la base de datos la asistencia 
    //De todos los estudiantes de ASODISVALLE
    public function guardarAsistencia(Request $request) {
        foreach ($request->asistencia as $estudiante_id => $estado) {
            Asistencia::create([
                'estudiante_id' => $estudiante_id,
                'fecha' => Carbon::now()->toDateString(),
                'estado' => $estado,
                'excusa' => $estado === 'no' ? ($request->excusa[$estudiante_id] ?? null) : null
            ]);
        }

        return back()->with('success', 'Asistencia guardada correctamente.');
    }
}
