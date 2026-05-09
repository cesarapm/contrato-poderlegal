<?php

namespace App\Filament\Resources\Fiadores\Pages;

use App\Filament\Resources\Fiadores\FiadorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFiadores extends ListRecords
{
    protected static string $resource = FiadorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
