<?php

namespace App\Filament\Resources\Inmuebles;

use App\Filament\Resources\Inmuebles\Pages\CreateInmueble;
use App\Filament\Resources\Inmuebles\Pages\EditInmueble;
use App\Filament\Resources\Inmuebles\Pages\ListInmuebles;
use App\Filament\Resources\Inmuebles\Schemas\InmuebleForm;
use App\Filament\Resources\Inmuebles\Tables\InmueblesTable;
use App\Models\Inmueble;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class InmuebleResource extends Resource
{
    protected static ?string $model = Inmueble::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-home';
    
    protected static ?string $navigationLabel = 'Inmuebles';
    
    protected static ?string $modelLabel = 'Inmueble';
    
    protected static ?string $pluralModelLabel = 'Inmuebles';
    
    protected static ?int $navigationSort = 2;
    
    protected static string|\UnitEnum|null $navigationGroup = 'Gestión de Contratos';

    public static function form(Schema $schema): Schema
    {
        return InmuebleForm::schema($schema);
    }

    public static function table(Table $table): Table
    {
        return InmueblesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInmuebles::route('/'),
            'create' => CreateInmueble::route('/create'),
            'edit' => EditInmueble::route('/{record}/edit'),
        ];
    }
}
