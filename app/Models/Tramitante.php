<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tramitante extends Model
{
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono_1',
        'telefono_2',
        'email',
        'inmobiliaria',
        'es_independiente',
        'tipo_solicitante',
        'acepto_terminos',
    ];

    protected $casts = [
        'es_independiente' => 'boolean',
        'acepto_terminos' => 'boolean',
    ];

    public function contratos(): HasMany
    {
        return $this->hasMany(Contrato::class);
    }

    public function getNombreCompletoAttribute(): string
    {
        return trim("{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}");
    }
}
