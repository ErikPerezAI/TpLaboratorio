<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use App\Models\Aula;
class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::with('aula')->get();
        $aulas = Aula::all();

        return view('equipos.index', compact('equipos', 'aulas'));
    }

    public function store(Request $request)
    {
        $equipo = new Equipo();

        $equipo->nombre = $request->input('nombre');
        $equipo->numero_serie = $request->input('numero_serie');
        $equipo->descripcion = $request->input('descripcion');

        if ($request->hasFile('imagen')) {

            $ruta = $request->file('imagen')
                            ->store('public/hardware');

            $ruta = str_replace(
                'public/',
                'storage/',
                $ruta
            );

            $equipo->imagen_ruta = $ruta;
        }

        $equipo->aula_id = $request->input('aula_id');
        $equipo->save();

        return redirect()->route('equipos.index');
    }
}