<?php

namespace App\Filament\Resources\PlantillaContratos\Pages;

use App\Filament\Resources\PlantillaContratos\PlantillaContratoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPlantillaContratos extends ListRecords
{
    protected static string $resource = PlantillaContratoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
