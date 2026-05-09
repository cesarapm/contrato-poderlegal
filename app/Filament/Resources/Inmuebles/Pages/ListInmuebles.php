<?php

namespace App\Filament\Resources\Inmuebles\Pages;

use App\Filament\Resources\Inmuebles\InmuebleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInmuebles extends ListRecords
{
    protected static string $resource = InmuebleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
