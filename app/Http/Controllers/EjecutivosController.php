<?php

namespace App\Http\Controllers;

use App\Models\Agencias;
use App\Models\Cargos;
use App\Models\Ejecutivos;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EjecutivosController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ejecutivos = Ejecutivos::select('ejecutivos.*', 'cargos.nombre as c_nombre', 'agencias.nombre as a_nombre')
            ->join('agencias', 'ejecutivos.agencia_id', '=', 'agencias.id')
            ->join('cargos', 'ejecutivos.cargo_id', '=', 'cargos.id')
            ->get();
        return view('ejecutivos.index', ['ejecutivos' => $ejecutivos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cargos = Cargos::select('id', 'nombre')->get();
        $agencias = Agencias::select('id', 'nombre')->get();



        return view('ejecutivos.crear', ['cargos' => $cargos, 'agencias' => $agencias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $campos = [
            'nombres' => 'required|max:100',
            'rut' => 'required',
            'agencia' => 'required',
            'cargo' => 'required',
            'estado' => 'required',

        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',

        ];

        $this->validate($request, $campos, $mensaje);

        $ejecutivo = new Ejecutivos();
        $ejecutivo->nombres = $request->nombres;
        $ejecutivo->rut = $request->rut;
        $ejecutivo->agencia_id = $request->agencia;
        $ejecutivo->cargo_id = $request->cargo;
        $ejecutivo->estado = $request->estado;
        $ejecutivo->save();

        Alert::success('Estado', 'Ejecutivo creado!');

        return redirect('ejecutivos');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $ejecutivo = Ejecutivos::findOrFail($id);


        $cargos = Cargos::select('id', 'nombre')->get();
        $agencias = Agencias::select('id', 'nombre')->get();
        return view('ejecutivos.editar', ['ejecutivo' => $ejecutivo, 'cargos' => $cargos, 'agencias' => $agencias]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $campos = [
            'nombres' => 'required|max:100',
            'rut' => 'required',
            'agencia' => 'required',
            'cargo' => 'required',
            'estado' => 'required',

        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',

        ];

        $this->validate($request, $campos, $mensaje);

        $ejecutivo = Ejecutivos::findOrFail($id);
        $ejecutivo->nombres = $request->nombres;
        $ejecutivo->rut = $request->rut;
        $ejecutivo->agencia_id = $request->agencia;
        $ejecutivo->cargo_id = $request->cargo;
        $ejecutivo->estado = $request->estado;
        $ejecutivo->save();

        Alert::success('Estado', 'Ejecutivo editado!');

        return redirect('ejecutivos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ejecutivo = Ejecutivos::where('id', $id)->first();

        $ejecutivo->delete();
        Alert::success('Estado', 'Ejecutivo eliminado!');
        return back();
    }
}
