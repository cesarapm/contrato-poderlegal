<?php

namespace Database\Seeders;

use App\Models\PlantillaContrato;
use Illuminate\Database\Seeder;

class PlantillaArrendamientoProfesionalSeeder extends Seeder
{
    public function run(): void
    {
        $html = file_get_contents(database_path('../resources/html/plantilla-contrato-arrendamiento.html'));

        PlantillaContrato::updateOrCreate(
            ['slug' => 'contrato-arrendamiento-profesional'],
            [
                'nombre' => 'Contrato de Arrendamiento Profesional',
                'slug' => 'contrato-arrendamiento-profesional',
                'contenido_html' => $html,
                'activa' => true,
            ]
        );

        $this->command->info('✅ Plantilla de arrendamiento profesional creada/actualizada exitosamente');
    }
}
