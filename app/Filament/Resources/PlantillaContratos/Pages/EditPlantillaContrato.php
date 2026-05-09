<?php

namespace App\Filament\Resources\PlantillaContratos\Pages;

use App\Filament\Resources\PlantillaContratos\PlantillaContratoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPlantillaContrato extends EditRecord
{
    protected static string $resource = PlantillaContratoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
