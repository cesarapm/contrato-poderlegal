<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

/**
 * Elimina automáticamente los archivos de Storage cuando el modelo
 * es borrado o cuando un campo de archivo es reemplazado.
 *
 * El modelo debe definir:
 *   protected array $camposArchivoSimple   = ['campo_path', ...];
 *   protected array $camposArchivoMultiple = ['campo_paths', ...]; // campos cast a array
 */
trait EliminaArchivosAlBorrar
{
    protected static function bootEliminaArchivosAlBorrar(): void
    {
        // Eliminar archivos antiguos cuando se reemplazan
        static::updating(function ($model) {
            foreach ($model->camposArchivoSimple ?? [] as $campo) {
                if ($model->isDirty($campo)) {
                    static::eliminarArchivoSimple($model->getOriginal($campo));
                }
            }
            foreach ($model->camposArchivoMultiple ?? [] as $campo) {
                if ($model->isDirty($campo)) {
                    $anteriores = $model->getOriginal($campo) ?? [];
                    $nuevos     = $model->$campo ?? [];
                    if (is_string($anteriores)) {
                        $anteriores = json_decode($anteriores, true) ?? [];
                    }
                    foreach (array_diff((array) $anteriores, (array) $nuevos) as $archivo) {
                        static::eliminarArchivoSimple($archivo);
                    }
                }
            }
        });

        // Eliminar todos los archivos al borrar el modelo
        static::deleted(function ($model) {
            foreach ($model->camposArchivoSimple ?? [] as $campo) {
                static::eliminarArchivoSimple($model->$campo);
            }
            foreach ($model->camposArchivoMultiple ?? [] as $campo) {
                foreach ((array) ($model->$campo ?? []) as $archivo) {
                    static::eliminarArchivoSimple($archivo);
                }
            }
        });
    }

    private static function eliminarArchivoSimple(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
