<?php

namespace App\Filament\Resources\Arrendadores\Pages;

use App\Filament\Resources\Arrendadores\ArrendadorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArrendadores extends ListRecords
{
    protected static string $resource = ArrendadorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
