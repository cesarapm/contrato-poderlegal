<?php

namespace App\Console\Commands;

use App\Services\CalculadoraPrecioPoliza;
use Illuminate\Console\Command;

class TestCalculadoraPoliza extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'poliza:test {monto? : Monto de renta mensual a probar}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prueba la calculadora de precios de póliza';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $calculadora = new CalculadoraPrecioPoliza();

        if ($this->argument('monto')) {
            // Probar un monto específico
            $monto = floatval($this->argument('monto'));
            $this->probarMonto($calculadora, $monto);
        } else {
            // Probar todos los rangos
            $this->info('=== PRUEBA DE CALCULADORA DE PRECIOS DE PÓLIZA ===');
            $this->newLine();

            $montosEjemplo = [
                3444.00,   // Rango 1
                10000.00,  // Límite rango 1
                10001.00,  // Inicio rango 2
                15000.00,  // Medio rango 2
                19000.00,  // Límite rango 2
                19001.00,  // Inicio rango 3
                25000.00,  // Medio rango 3
                30000.00,  // Límite rango 3
                30001.00,  // Inicio rango 4
                35000.00,  // Ejemplo rango 4
                50000.00,  // Ejemplo rango 4
            ];

            foreach ($montosEjemplo as $monto) {
                $this->probarMonto($calculadora, $monto);
                $this->newLine();
            }
        }

        return Command::SUCCESS;
    }

    private function probarMonto(CalculadoraPrecioPoliza $calculadora, float $monto)
    {
        $desglose = $calculadora->obtenerDesglose($monto);

        $this->line("Renta Mensual: <fg=yellow>$" . number_format($monto, 2) . "</>");
        $this->line("Precio sin IVA: <fg=green>$" . number_format($desglose['precio_sin_iva'], 2) . "</>");
        $this->line("IVA (16%): <fg=cyan>$" . number_format($desglose['iva'], 2) . "</>");
        $this->line("Total con IVA: <fg=white;options=bold>$" . number_format($desglose['precio_con_iva'], 2) . "</>");
        $this->line("Vigencia: {$desglose['vigencia_meses']} meses");
        
        // Mostrar el rango aplicado
        if ($monto <= 10000) {
            $this->line("Rango: <fg=blue>$1 - $10,000</>");
        } elseif ($monto <= 19000) {
            $this->line("Rango: <fg=blue>$10,001 - $19,000</>");
        } elseif ($monto <= 30000) {
            $this->line("Rango: <fg=blue>$19,001 - $30,000</>");
        } else {
            $costoAnual = $monto * 12;
            $this->line("Rango: <fg=blue>$30,001 en adelante (30% de $" . number_format($costoAnual, 2) . " anual)</>");
        }
    }
}
