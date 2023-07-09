<?php

namespace App\Http\Controllers;

use App\Models\Agencias;
use App\Models\Cargos;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cargos = Cargos::select('id', 'nombre')->get();
        $agencias = Agencias::select('id', 'nombre')->get();

        return view('home', ['cargos' => $cargos, 'agencias' => $agencias]);
    }
}
