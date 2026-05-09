<?php

namespace App\Filament\Resources\Fiadores;

use App\Filament\Resources\Fiadores\Pages\CreateFiador;
use App\Filament\Resources\Fiadores\Pages\EditFiador;
use App\Filament\Resources\Fiadores\Pages\ListFiadores;
use App\Filament\Resources\Fiadores\Schemas\FiadorForm;
use App\Filament\Resources\Fiadores\Tables\FiadoresTable;
use App\Models\Fiador;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class FiadorResource extends Resource
{
    protected static ?string $model = Fiador::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-shield-check';
    
    protected static ?string $navigationLabel = 'Fiadores';
    
    protected static ?string $modelLabel = 'Fiador';
    
    protected static ?string $pluralModelLabel = 'Fiadores';
    
    protected static ?int $navigationSort = 5;
    
    protected static string|\UnitEnum|null $navigationGroup = 'Gestión de Contratos';

    public static function form(Schema $schema): Schema
    {
        return FiadorForm::schema($schema);
    }

    public static function table(Table $table): Table
    {
        return FiadoresTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFiadores::route('/'),
            'create' => CreateFiador::route('/create'),
            'edit' => EditFiador::route('/{record}/edit'),
        ];
    }
}
