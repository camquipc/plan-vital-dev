<?php

namespace App\Http\Controllers;

use App\Models\Ejecutivos;
use App\Models\Temporal;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AsistenciasController extends Controller
{
    public function get_tem($fecha)
    {
        $tem = Temporal::select('temporals.*', 'ejecutivos.nombres', 'ejecutivos.rut', 'ejecutivos.id', 'cargos.nombre as c_nombre', 'agencias.nombre as a_nombre')
            ->join('ejecutivos', 'ejecutivos.id', '=', 'temporals.ejecutivo_id')
            ->join('agencias', 'temporals.agencia_id', '=', 'agencias.id')
            ->join('cargos', 'temporals.cargo_id', '=', 'cargos.id')
            ->where('temporals.fecha', $fecha)
            ->get();


        return response()->json([
            'data' => $tem,
            'success' => true
        ]);
    }

    public function set_tem(Request $request)
    {
        //validar si ya existe el registro para ese dias

        $valid = Temporal::select('*')
            ->where('ejecutivo_id', $request->get('ejecutivo_id'))
            ->where('fecha', $request->get('fecha'))
            ->get();

        if ($valid->count() > 0) {
            return response()->json([
                'data' => null,
                'success' => true
            ]);
        } else {
            $tem = Temporal::create([
                'agencia_id' => $request->get('agencia_id'),
                'cargo_id' => $request->get('cargo_id'),
                'ejecutivo_id' => $request->get('ejecutivo_id'),
                'fecha' => $request->get('fecha'),
                'jefatura' => $request->get('jefatura'),
                'estado' => $request->get('estado')
            ]);

            return response()->json([
                'data' => $tem,
                'success' => true
            ]);
        }
    }
}
