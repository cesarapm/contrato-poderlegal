<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Arrendador extends Model
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
        'titulo_propiedad_path',
        'tiene_representante_legal',
        'en_proceso_sucesorio',
        'direccion',
        'orden',
    ];

    protected $casts = [
        'tiene_representante_legal' => 'boolean',
        'en_proceso_sucesorio' => 'boolean',
        'direccion' => 'array',
    ];

    public function contrato(): BelongsTo
    {
        return $this->belongsTo(Contrato::class);
    }

    public function getNombreCompletoAttribute(): string
    {
        if ($this->tipo_persona === 'moral') {
            return $this->nombre;
        }
        
        return trim("{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}");
    }
}
