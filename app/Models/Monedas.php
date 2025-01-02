<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;


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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); // 'user_id' en monedas, 'id' en users
    }

    protected static function booted()
    {
        static::creating(function ($moneda) {
            $moneda->user_id = auth()->id(); // Asigna el ID del usuario autenticado
        });
    }
}
