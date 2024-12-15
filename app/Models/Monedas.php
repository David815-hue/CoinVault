<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monedas extends Model
{
    

    protected $fillable = [
        'nombre',
        'descripcion',
        'foto_frontal',
        'foto_trasera',
        'anio',
        'pais',
        'estado',
        'valor_comprado',
        'valor_venta_sugerido',
        'material',
    ];
}
