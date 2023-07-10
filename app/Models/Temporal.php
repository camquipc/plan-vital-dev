<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temporal extends Model
{
    use HasFactory;
    protected $fillable = array(
        'agencia_id',
        'cargo_id',
        'ejecutivo_id',
        'fecha',
        'jefatura', 1,
        'estado',
    );
}
