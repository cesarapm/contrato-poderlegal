<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inmueble extends Model
{
    protected $fillable = [
        'contrato_id',
        'codigo_postal',
        'estado',
        'alcaldia_municipio',
        'colonia',
        'calle',
        'numero_exterior',
        'edificio',
        'numero_interior',
        'uso_inmueble',
        'abogado_id',
    ];

    public function contrato(): BelongsTo
    {
        return $this->belongsTo(Contrato::class);
    }

    public function abogado(): BelongsTo
    {
        return $this->belongsTo(User::class, 'abogado_id');
    }

    public function getDireccionCompletaAttribute(): string
    {
        $partes = [
            $this->calle,
            "No. {$this->numero_exterior}",
            $this->edificio ? "Edificio {$this->edificio}" : null,
            $this->numero_interior ? "Int. {$this->numero_interior}" : null,
            $this->colonia,
            $this->alcaldia_municipio,
            $this->estado,
            "C.P. {$this->codigo_postal}",
        ];
        
        return implode(', ', array_filter($partes));
    }
}
