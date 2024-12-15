<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billetes extends Model
{
    //

    protected $fillable = [
        'nombre',
        'denominacion',
        'foto_frontal',
        'foto_trasera',
        'anio',
        'pais',
        'estado',
        'valor_comprado',
        'valor_venta_sugerido',
    ];
}
