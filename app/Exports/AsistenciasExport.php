<?php

namespace App\Exports;

use App\Models\Asistencias;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;



class AsistenciasExport implements FromView, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $fecha_inicial;
    public $fecha_final;

    public function __construct($fi, $ff)
    {
        $this->fecha_inicial = $fi;
        $this->fecha_final  = $ff;
    }


    public function view(): View
    {
        $asistencias = Asistencias::select('asistencias.*', 'estado_ejecutivos.estado', 'ejecutivos.nombres', 'ejecutivos.rut', 'ejecutivos.id', 'cargos.nombre as c_nombre', 'agencias.nombre as a_nombre', 'agencias.cod_agencia')
            ->join('ejecutivos', 'ejecutivos.id', '=', 'asistencias.ejecutivo_id')
            ->join('agencias', 'asistencias.agencia_id', '=', 'agencias.id')
            ->join('cargos', 'asistencias.cargo_id', '=', 'cargos.id')
            ->join('estado_ejecutivos', 'asistencias.estado_id', '=', 'estado_ejecutivos.id')
            ->whereBetween('asistencias.fecha', [$this->fecha_inicial, $this->fecha_final])
            ->get();


        return view('exports.exportar', [
            'asistencias' =>  $asistencias
        ]);
    }
}
