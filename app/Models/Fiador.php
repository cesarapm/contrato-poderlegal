<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fiador extends Model
{
    protected $fillable = [
        'contrato_id',
        'tipo',
        'tipo_persona',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono_1',
        'telefono_2',
        'email',
        'identificacion_path',
        'domicilio',
    ];

    protected $casts = [
        'domicilio' => 'array',
    ];

    public function contrato(): BelongsTo
    {
        return $this->belongsTo(Contrato::class);
    }

    public function getNombreCompletoAttribute(): ?string
    {
        if ($this->tipo === 'ninguno' || empty($this->nombre)) {
            return null;
        }

        return trim(implode(' ', array_filter([
            $this->nombre,
            $this->apellido_paterno,
            $this->apellido_materno,
        ])));
    }
}
