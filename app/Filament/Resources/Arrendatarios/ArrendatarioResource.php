<?php

namespace App\Filament\Resources\Arrendatarios;

use App\Filament\Resources\Arrendatarios\Pages\CreateArrendatario;
use App\Filament\Resources\Arrendatarios\Pages\EditArrendatario;
use App\Filament\Resources\Arrendatarios\Pages\ListArrendatarios;
use App\Filament\Resources\Arrendatarios\Schemas\ArrendatarioForm;
use App\Filament\Resources\Arrendatarios\Tables\ArrendatariosTable;
use App\Models\Arrendatario;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class ArrendatarioResource extends Resource
{
    protected static ?string $model = Arrendatario::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-group';
    
    protected static ?string $navigationLabel = 'Arrendatarios';
    
    protected static ?string $modelLabel = 'Arrendatario';
    
    protected static ?string $pluralModelLabel = 'Arrendatarios';
    
    protected static ?int $navigationSort = 3;
    
    protected static string|\UnitEnum|null $navigationGroup = 'Gestión de Contratos';

    public static function form(Schema $schema): Schema
    {
        return ArrendatarioForm::schema($schema);
    }

    public static function table(Table $table): Table
    {
        return ArrendatariosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArrendatarios::route('/'),
            'create' => CreateArrendatario::route('/create'),
            'edit' => EditArrendatario::route('/{record}/edit'),
        ];
    }
}
