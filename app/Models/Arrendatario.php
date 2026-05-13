<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Arrendatario extends Model
{
    protected $fillable = [
        'contrato_id',
        'tipo_persona',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono_1',
        'telefono_2',
        'email',
        'identificacion_path',
        'domicilio_notificaciones',
        'orden',
    ];

    protected $casts = [
        'domicilio_notificaciones' => 'array',
    ];

    public function contrato(): BelongsTo
    {
        return $this->belongsTo(Contrato::class);
    }

    public function getNombreCompletoAttribute(): string
    {
        return trim(implode(' ', array_filter([
            $this->nombre,
            $this->apellido_paterno,
            $this->apellido_materno,
        ])));
    }
}
