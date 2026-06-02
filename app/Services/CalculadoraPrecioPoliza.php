<?php

namespace App\Services;

class CalculadoraPrecioPoliza
{
    /**
     * Calcula el precio de la póliza basado en la renta mensual
     * según la tabla de precios escalonada.
     *
     * Tabla de precios:
     * - $1.00 – $10,000 → $4,680.00
     * - $10,001 – $19,000 → $4,800.00
     * - $19,001 – $30,000 → $5,800.00
     * - $30,001 en adelante → 30% del costo anual de la renta
     *
     * @param float $montoRentaMensual
     * @return float Precio de la póliza sin IVA
     */
    public function calcularPrecioPoliza(float $montoRentaMensual): float
    {
        // Rangos de precio fijo
        if ($montoRentaMensual >= 1 && $montoRentaMensual <= 10000) {
            return 4680.00;
        }

        if ($montoRentaMensual >= 10001 && $montoRentaMensual <= 19000) {
            return 4800.00;
        }

        if ($montoRentaMensual >= 19001 && $montoRentaMensual <= 30000) {
            return 5800.00;
        }

        // $30,001 en adelante: 30% del costo anual
        if ($montoRentaMensual >= 30001) {
            $costoAnual = $montoRentaMensual * 12;
            return round($costoAnual * 0.30, 2);
        }

        // Por defecto, retornar el precio más bajo
        return 4680.00;
    }

    /**
     * Calcula el precio de la póliza con IVA incluido
     *
     * @param float $montoRentaMensual
     * @param float $tasaIva Tasa de IVA (por defecto 0.16 = 16%)
     * @return float Precio de la póliza con IVA
     */
    public function calcularPrecioPolizaConIva(float $montoRentaMensual, float $tasaIva = 0.16): float
    {
        $precioSinIva = $this->calcularPrecioPoliza($montoRentaMensual);
        return round($precioSinIva * (1 + $tasaIva), 2);
    }

    /**
     * Obtiene el desglose completo del precio de la póliza
     *
     * @param float $montoRentaMensual
     * @param float $tasaIva Tasa de IVA (por defecto 0.16 = 16%)
     * @return array
     */
    public function obtenerDesglose(float $montoRentaMensual, float $tasaIva = 0.16): array
    {
        $precioSinIva = $this->calcularPrecioPoliza($montoRentaMensual);
        $iva = round($precioSinIva * $tasaIva, 2);
        $precioConIva = round($precioSinIva + $iva, 2);

        return [
            'monto_renta_mensual' => $montoRentaMensual,
            'precio_sin_iva' => $precioSinIva,
            'iva' => $iva,
            'tasa_iva' => $tasaIva * 100, // En porcentaje
            'precio_con_iva' => $precioConIva,
            'vigencia_meses' => 12,
            'limite_renta_mensual' => $montoRentaMensual,
        ];
    }
}
