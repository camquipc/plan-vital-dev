<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencias extends Model
{
    use HasFactory;
    protected $fillable = array(
        'agencia_id',
        'cargo_id',
        'ejecutivo_id',
        'fecha',
        'jefatura',
        'estado_id',
    );
}
