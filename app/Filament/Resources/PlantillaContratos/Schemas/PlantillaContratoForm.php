<?php

namespace App\Filament\Resources\PlantillaContratos\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PlantillaContratoForm
{
    public static function schema(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Información de la Plantilla')
                    ->schema([
                        TextInput::make('nombre')
                            ->label('Nombre de la Plantilla')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1),

                        TextInput::make('slug')
                            ->label('Slug (URL amigable)')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Se genera automáticamente si se deja vacío')
                            ->columnSpan(1),

                        Toggle::make('activa')
                            ->label('Plantilla Activa')
                            ->default(true)
                            ->inline(false)
                            ->helperText('Solo las plantillas activas estarán disponibles al crear contratos')
                            ->columnSpan(2),
                    ])
                    ->columns(2),

                Section::make('Contenido HTML')
                    ->description('Escribe el contenido de la plantilla usando HTML. Usa {{variable}} para insertar variables dinámicas.')
                    ->schema([
                        Textarea::make('contenido_html')
                            ->label('Código HTML del Contrato')
                            ->required()
                            ->rows(20)
                            ->columnSpanFull()
                            ->helperText('Ejemplo de variables: {{tramitante_nombre}}, {{monto_renta}}, {{fecha_inicio}}'),

                        Placeholder::make('variables_info')
                            ->label('Variables Detectadas')
                            ->content(function ($get) {
                                $contenido = $get('contenido_html');
                                if (empty($contenido)) {
                                    return 'No hay variables detectadas. Las variables se detectan automáticamente al guardar.';
                                }
                                
                                preg_match_all('/\{\{([^}]+)\}\}/', $contenido, $matches);
                                if (empty($matches[0])) {
                                    return 'No se encontraron variables en el contenido.';
                                }
                                
                                $variables = array_unique($matches[0]);
                                return 'Variables encontradas: ' . implode(', ', $variables);
                            })
                            ->columnSpanFull(),
                    ]),

                Section::make('Ayuda')
                    ->description('Variables disponibles comunes')
                    ->schema([
                        Placeholder::make('help')
                            ->label('')
                            ->content('
                                **Variables del Tramitante:**
                                - {{tramitante_nombre}}, {{tramitante_apellidos}}, {{tramitante_email}}
                                
                                **Variables del Contrato:**
                                - {{folio}}, {{tipo_producto}}, {{monto_renta}}, {{monto_total}}
                                - {{fecha_inicio}}, {{fecha_termino}}
                                
                                **Variables del Inmueble:**
                                - {{inmueble_direccion}}, {{inmueble_colonia}}, {{inmueble_cp}}
                                
                                **Variables de Arrendatarios/Arrendadores:**
                                - {{arrendatario_nombre}}, {{arrendador_nombre}}
                            ')
                            ->columnSpanFull(),
                    ])
                    ->collapsed(),
            ]);
    }
}
