<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); // 'user_id' en monedas, 'id' en users
    }

    protected static function booted()
    {
        static::creating(function ($billete) {
            $billete->user_id = auth()->id(); // Asigna el ID del usuario autenticado
        });
    }
}
