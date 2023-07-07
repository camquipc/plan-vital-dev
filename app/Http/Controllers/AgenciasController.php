<?php

namespace App\Http\Controllers;

use App\Models\Agencias;
use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;

class AgenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agencias =  Agencias::all();

        return view('agencias.index', ['agencias' => $agencias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agencias.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $campos = [
            'nombre' => 'required|max:100',
            'cod_agencia' => 'required',
        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',
            'max' => 'No debe ser mayor a 100 caracteres'
        ];

        $this->validate($request, $campos, $mensaje);

        $agencia = new Agencias();
        $agencia->nombre = $request->nombre;
        $agencia->cod_agencia = $request->cod_agencia;
        $agencia->save();

        Alert::success('Estado', 'Agencia creada!');

        return redirect('agencias');
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
        $agencia = Agencias::findOrFail($id);
        return view('agencias.editar', compact('agencia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $campos = [
            'nombre' => 'required|max:100',
            'cod_agencia' => 'required',
        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',
            'max' => 'No debe ser mayor a 100 caracteres'
        ];

        $this->validate($request, $campos, $mensaje);

        $data = request()->except('_token', '_method');


        Agencias::where('id', '=', $id)->update($data);

        Alert::success('Estado', 'Agencia editada!');

        return redirect('agencias');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agencia = Agencias::where('id', $id)->first();

        $agencia->delete();
        Alert::success('Estado', 'Agencia eliminada!');
        return back();
    }
}
