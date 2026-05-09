<?php

namespace App\Filament\Resources\Arrendadores\Pages;

use App\Filament\Resources\Arrendadores\ArrendadorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArrendador extends EditRecord
{
    protected static string $resource = ArrendadorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
