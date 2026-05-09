<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class PlantillaContrato extends Model
{
    protected $fillable = [
        'nombre',
        'slug',
        'contenido_html',
        'variables_detectadas',
        'activa',
    ];

    protected $casts = [
        'variables_detectadas' => 'array',
        'activa' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($plantilla) {
            if (empty($plantilla->slug)) {
                $plantilla->slug = Str::slug($plantilla->nombre);
            }
        });
        
        static::saving(function ($plantilla) {
            // Detectar variables automáticamente
            preg_match_all('/\{\{([^}]+)\}\}/', $plantilla->contenido_html, $matches);
            $plantilla->variables_detectadas = array_unique($matches[0]);
        });
    }

    public function contratos(): HasMany
    {
        return $this->hasMany(Contrato::class, 'plantilla_id');
    }

    public function scopeActivas($query)
    {
        return $query->where('activa', true);
    }
}
