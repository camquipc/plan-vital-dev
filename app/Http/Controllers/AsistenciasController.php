<?php

namespace App\Http\Controllers;


use App\Models\Temporal;
use App\Models\Agencias;
use App\Models\Asistencias;
use App\Models\Cargos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Exports\AsistenciasExport;
use Maatwebsite\Excel\Facades\Excel;

class AsistenciasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cargos = Cargos::select('id', 'nombre')->get();
        $agencias = Agencias::select('id', 'nombre')->get();
        $estado_ejecutivos = DB::table('estado_ejecutivos')->get();

        return view('asistencias', ['cargos' => $cargos, 'agencias' => $agencias, 'estado_ejecutivos' => $estado_ejecutivos]);
    }

    public function get_asistencias_temporal()
    {
        $tem = Temporal::select('temporals.*', 'estado_ejecutivos.estado', 'ejecutivos.nombres', 'ejecutivos.rut', 'ejecutivos.id', 'cargos.nombre as c_nombre', 'agencias.nombre as a_nombre')
            ->join('ejecutivos', 'ejecutivos.id', '=', 'temporals.ejecutivo_id')
            ->join('agencias', 'temporals.agencia_id', '=', 'agencias.id')
            ->join('cargos', 'temporals.cargo_id', '=', 'cargos.id')
            ->join('estado_ejecutivos', 'temporals.estado_id', '=', 'estado_ejecutivos.id')
            ->get();


        return response()->json([
            'data' => $tem,
            'success' => true
        ]);
    }

    public function set_asistencia_temporal(Request $request)
    {
        $rules = [
            'fecha' => 'required',
            'agencia_id' => 'required',
            'cargo_id' => 'required',
            'ejecutivo_id' => 'required',
            'jefatura' => 'required',
            'estado_id' => 'required',
        ];

        $messages = [
            'fecha.required' => 'Fecha requerida',
            'agencia_id.required' => 'Agencia requerida',
            'cargo_id.required' => 'Cargo requerido',
            'ejecutivo_id.required' => 'Ejecutivo requerido',
            'jefatura.required' => 'Jefatura requerida',
            'estado_id.required' => 'Estado requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'type' => 'data-validacion',
                'errors' => $validator->errors()->all(),
                'message' => "Error de validación"
            ]);
        }

        $valid = Temporal::select('*')
            ->where('ejecutivo_id', $request->get('ejecutivo_id'))
            ->where('fecha', $request->get('fecha'))
            ->get();

        if ($valid->count() > 0) {
            return response()->json([
                'type' => 'data-duplicada',
                'message' => "Ejecutivo ya tiene un asistencia para esta fecha."
            ]);
        }
        Temporal::create([
            'agencia_id' => $request->get('agencia_id'),
            'cargo_id' => $request->get('cargo_id'),
            'ejecutivo_id' => $request->get('ejecutivo_id'),
            'fecha' => $request->get('fecha'),
            'jefatura' => $request->get('jefatura'),
            'estado_id' => $request->get('estado_id')
        ]);

        return response()->json([
            'type' => 'success',
            'message' => "Ejecutivo agregado."
        ]);
    }

    public function store_asistencias(Request $request)
    {
        $temporal = Temporal::select('*')
            ->where('fecha', $request->get('fecha'))
            ->get();

        if ($temporal->count() > 0) {
            foreach ($temporal as $temp) {
                //valida en la tabla asistencias si existe para el ejecutivo y fecha
                $temporal = Asistencias::select('id')
                    ->where('fecha', $request->get('fecha'))
                    ->where('ejecutivo_id', $temp->ejecutivo_id)
                    ->get();
                if ($temporal->count() == 0) {
                    Asistencias::create([
                        'agencia_id' => $temp->agencia_id,
                        'cargo_id' => $temp->cargo_id,
                        'ejecutivo_id' => $temp->ejecutivo_id,
                        'fecha' => $temp->fecha,
                        'jefatura' => $temp->jefatura,
                        'estado_id' => $temp->estado_id
                    ]);
                }
            }
            //limpiando la tabla temporal
            Temporal::query()->delete();

            return response()->json([
                'type' => 'success',
                'message' => "Asistencias guardadas"
            ]);
        }
    }

    public function delete_asistencias_temporal(Request $request)
    {
        $tem = Temporal::query()->delete();
        return response()->json([
            'type' => 'success',
            'message' => "Registros borrados"
        ]);
    }

    public function exportarExcelForm()
    {
        return View('exports.exportar_form');
    }

    public function exportarExcel(Request $request)
    {

        $rules = [
            'fecha_inicial' => 'required',
            'fecha_final' => 'required|after_or_equal:fecha_inicial',
        ];

        $messages = [
            'fecha_inicial.required' => 'Fecha inicial requerida',
            'fecha_final.required' => 'Fecha final requerida',
            'fecha_final.after_or_equal' => 'Fecha inicial no debe ser mayor a la fecha final'
        ];

        $this->validate($request, $rules, $messages);

        return Excel::download(new AsistenciasExport($request->get('fecha_inicial'), $request->get('fecha_final')), 'Registro_asitencias.xlsx');
    }
}
