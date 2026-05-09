<?php

namespace App\Filament\Resources\Arrendatarios\Pages;

use App\Filament\Resources\Arrendatarios\ArrendatarioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArrendatarios extends ListRecords
{
    protected static string $resource = ArrendatarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
