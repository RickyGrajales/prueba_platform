<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MateriaPBJ;

class MateriaPBJController extends Controller
{
    //

    public function index()
    {
        $materias = MateriaPBJ::all();
        return view('Z_PBJ.adminPBJ.materiasPBJ.indexMateriaPBJ', compact('materias'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);


        MateriaPBJ::create(['nombre' => $request->nombre]);

        return redirect()->route('materiasPBJ.index')->with('success', 'Materia registrada correctamente.');

    }





    public function update (Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $materia = MateriaPBJ::findOrFail($id);
        $materia->update(['nombre' => $request->nombre]);

        return redirect()->route('materiasPBJ.index')->with('success', 'Materia actualizada.');


    }



    public function destroy($id)
    {
        $materia = MateriaPBJ::findOrFail($id);
        $materia->delete();


        return redirect()->route('materiasPBJ.index')->with('success', 'Materia eliminada');
    }

}
