<?php

namespace App\Models;

use App\Traits\EliminaArchivosAlBorrar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fiador extends Model
{
    use EliminaArchivosAlBorrar;

    protected array $camposArchivoSimple = [
        'identificacion_path',
        'acta_constitutiva_path',
        'poderes_representante_path',
        'constancia_situacion_fiscal_path',
    ];

    protected array $camposArchivoMultiple = [
        'comprobantes_ingresos',
        'ine_paths',
    ];

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
        'estado_civil',
        'numero_inm',
        'numero_ine',
        'nacionalidad',
        'identificacion_path',
        'domicilio',
        'ciudad',
        'estado',
        'pais',
        'codigo_postal',
        // Campos persona moral
        'no_acta_constitutiva',
        'fecha_acta_constitutiva',
        'fecha_registro_acta',
        'estado_inscrita',
        'acta_constitutiva_path',
        'nombre_notario',
        'no_notario',
        'estado_notario',
        'ciudad_notario',
        'folio_mercantil',
        'poder_en_acta',
        'poderes_representante_path',
        'constancia_situacion_fiscal_path',
        // Todos los tipos
        'comprobantes_ingresos',
        'ine_paths',
    ];

    protected $casts = [
        'domicilio' => 'array',
        'fecha_acta_constitutiva' => 'date',
        'fecha_registro_acta' => 'date',
        'poder_en_acta' => 'boolean',
        'comprobantes_ingresos' => 'array',
        'ine_paths' => 'array',
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
