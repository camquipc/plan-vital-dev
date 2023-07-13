<?php

namespace App\Http\Controllers;

use App\Models\Cargos as ModelsCargos;
use Illuminate\Http\Request;
use App\Models\Cargos;
use RealRashid\SweetAlert\Facades\Alert;

class CargosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cargos =  Cargos::all();
        $title = 'Eliminar';
        $text = "¿Estás seguro de que quieres eliminar ?";
        confirmDelete($title, $text);

        return view('cargos.index', ['cargos' => $cargos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cargos.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $campos = [
            'nombre' => 'required|max:100',

        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',
            'max' => 'No debe ser mayor a 100 caracteres'
        ];

        $this->validate($request, $campos, $mensaje);

        $cargo = new Cargos();
        $cargo->nombre = $request->nombre;
        $cargo->save();

        Alert::success('Estado', 'Cargo creado!');

        return redirect('cargos');
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
        $cargo = Cargos::findOrFail($id);
        return view('cargos.editar', compact('cargo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $campos = [
            'nombre' => 'required|max:100',

        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',
            'max' => 'No debe ser mayor a 100 caracteres'
        ];

        $this->validate($request, $campos, $mensaje);

        $data = request()->except('_token', '_method');


        Cargos::where('id', '=', $id)->update($data);

        Alert::success('Estado', 'Cargo editado!');

        return redirect('cargos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cargo = Cargos::where('id', $id)->first();

        $cargo->delete();
        Alert::success('Estado', 'Cargo eliminado!');
        return back();
    }
}
