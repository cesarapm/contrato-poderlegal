<?php

namespace App\Filament\Resources\Arrendatarios\Pages;

use App\Filament\Resources\Arrendatarios\ArrendatarioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArrendatario extends EditRecord
{
    protected static string $resource = ArrendatarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
