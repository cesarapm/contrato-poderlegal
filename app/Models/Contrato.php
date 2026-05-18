<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Contrato extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tramitante_id',
        'plantilla_id',
        'folio',
        'tipo_producto',
        'monto_renta_mensual',
        'monto_total',
        'incluye_iva',
        'fecha_inicio',
        'fecha_termino',
        'estado',
        'complementos',
        'datos_renta',
        'servicios_inmueble',
        'observaciones',
        'pdf_path',
        'poliza_pdf_path',
    ];

    protected $casts = [
        'incluye_iva' => 'boolean',
        'fecha_inicio' => 'date',
        'fecha_termino' => 'date',
        'complementos' => 'array',
        'datos_renta' => 'array',
        'servicios_inmueble' => 'array',
        'monto_renta_mensual' => 'decimal:2',
        'monto_total' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($contrato) {
            if (empty($contrato->folio)) {
                $contrato->folio = 'CON-' . strtoupper(Str::random(8));
            }
        });

        // Eliminar PDFs antiguos cuando se reemplazan
        static::updating(function ($contrato) {
            foreach (['pdf_path', 'poliza_pdf_path'] as $campo) {
                if ($contrato->isDirty($campo)) {
                    $anterior = $contrato->getOriginal($campo);
                    if ($anterior && Storage::disk('local')->exists($anterior)) {
                        Storage::disk('local')->delete($anterior);
                    }
                }
            }
        });

        // Eliminar PDFs al borrar definitivamente (force delete)
        static::forceDeleted(function ($contrato) {
            foreach (['pdf_path', 'poliza_pdf_path'] as $campo) {
                if ($contrato->$campo && Storage::disk('local')->exists($contrato->$campo)) {
                    Storage::disk('local')->delete($contrato->$campo);
                }
            }
        });
    }

    public function tramitante(): BelongsTo
    {
        return $this->belongsTo(Tramitante::class);
    }

    public function plantilla(): BelongsTo
    {
        return $this->belongsTo(PlantillaContrato::class);
    }

    public function inmueble(): HasOne
    {
        return $this->hasOne(Inmueble::class);
    }

    public function arrendatarios(): HasMany
    {
        return $this->hasMany(Arrendatario::class)->orderBy('orden');
    }

    public function arrendadores(): HasMany
    {
        return $this->hasMany(Arrendador::class)->orderBy('orden');
    }

    public function fiador(): HasOne
    {
        return $this->hasOne(Fiador::class);
    }
}
