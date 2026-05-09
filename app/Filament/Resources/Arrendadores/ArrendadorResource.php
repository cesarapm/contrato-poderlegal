<?php

namespace App\Filament\Resources\Arrendadores;

use App\Filament\Resources\Arrendadores\Pages\CreateArrendador;
use App\Filament\Resources\Arrendadores\Pages\EditArrendador;
use App\Filament\Resources\Arrendadores\Pages\ListArrendadores;
use App\Filament\Resources\Arrendadores\Schemas\ArrendadorForm;
use App\Filament\Resources\Arrendadores\Tables\ArrendadoresTable;
use App\Models\Arrendador;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class ArrendadorResource extends Resource
{
    protected static ?string $model = Arrendador::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';
    
    protected static ?string $navigationLabel = 'Arrendadores';
    
    protected static ?string $modelLabel = 'Arrendador';
    
    protected static ?string $pluralModelLabel = 'Arrendadores';
    
    protected static ?int $navigationSort = 4;
    
    protected static string|\UnitEnum|null $navigationGroup = 'Gestión de Contratos';

    public static function form(Schema $schema): Schema
    {
        return ArrendadorForm::schema($schema);
    }

    public static function table(Table $table): Table
    {
        return ArrendadoresTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArrendadores::route('/'),
            'create' => CreateArrendador::route('/create'),
            'edit' => EditArrendador::route('/{record}/edit'),
        ];
    }
}
