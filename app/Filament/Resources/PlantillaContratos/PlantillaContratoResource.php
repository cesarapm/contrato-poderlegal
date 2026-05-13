<?php

namespace App\Filament\Resources\PlantillaContratos;

use App\Filament\Resources\PlantillaContratos\Pages\CreatePlantillaContrato;
use App\Filament\Resources\PlantillaContratos\Pages\EditPlantillaContrato;
use App\Filament\Resources\PlantillaContratos\Pages\ListPlantillaContratos;
use App\Filament\Resources\PlantillaContratos\Schemas\PlantillaContratoForm;
use App\Filament\Resources\PlantillaContratos\Tables\PlantillaContratosTable;
use App\Models\PlantillaContrato;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class PlantillaContratoResource extends Resource
{
    protected static ?string $model = PlantillaContrato::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-duplicate';
    
    protected static ?string $navigationLabel = 'Plantillas';
    
    protected static ?string $modelLabel = 'Plantilla de Contrato';
    
    protected static ?string $pluralModelLabel = 'Plantillas de Contrato';
    
    protected static ?int $navigationSort = 2;
    
    protected static string|\UnitEnum|null $navigationGroup = 'Gestión de Contratos';

    public static function form(Schema $schema): Schema
    {
        return PlantillaContratoForm::schema($schema);
    }

    public static function table(Table $table): Table
    {
        return PlantillaContratosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPlantillaContratos::route('/'),
            'create' => CreatePlantillaContrato::route('/create'),
            'edit' => EditPlantillaContrato::route('/{record}/edit'),
        ];
    }
    
    public static function shouldRegisterNavigation(): bool
{
    return false;
}
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('activa', true)->count() ?: null;
    }
    
    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }
}
