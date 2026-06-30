<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::all();

        return view('equipos.index', compact('equipos'));
    }

    public function store(Request $request)
    {
        $equipo = new Equipo();

        $equipo->nombre = $request->input('nombre');
        $equipo->numero_serie = $request->input('numero_serie');
        $equipo->descripcion = $request->input('descripcion');

        $equipo->save();

        return redirect()->route('equipos.index');
    }
}
