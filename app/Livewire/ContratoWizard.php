<?php

namespace App\Livewire;

use App\Models\Contrato;
use App\Models\Tramitante;
use App\Models\Inmueble;
use App\Models\Arrendatario;
use App\Models\Arrendador;
use App\Models\Fiador;
use Livewire\Component;
use Livewire\WithFileUploads;

class ContratoWizard extends Component
{
    use WithFileUploads;

    public $currentStep = 1;
    public $totalSteps = 9;

    // Paso 1: Datos del Tramitante
    public $tramitante_nombre = '';
    public $tramitante_apellido_paterno = '';
    public $tramitante_apellido_materno = '';
    public $tramitante_telefono_1 = '';
    public $tramitante_telefono_2 = '';
    public $tramitante_email = '';
    public $es_independiente = false;
    public $tipo_solicitante = 'asesor';

    // Paso 2: Tipo de Producto
    public $tipo_producto = '';

    // Paso 3: Datos de Renta
    public $monto_renta_mensual = '';
    public $incluye_iva = false;
    public $fecha_inicio = '';
    public $fecha_termino = '';
    public $servicios_incluidos = [];

    // Paso 4: Datos del Inmueble
    public $inmueble_codigo_postal = '';
    public $inmueble_estado = '';
    public $inmueble_municipio = '';
    public $inmueble_colonia = '';
    public $inmueble_calle = '';
    public $inmueble_numero_exterior = '';
    public $inmueble_edificio = '';
    public $inmueble_numero_interior = '';
    public $inmueble_uso = 'habitacional';

    // Paso 5: Arrendatario(s)
    public $arrendatarios = [
        [
            'tipo_persona' => 'fisica',
            'nombre' => '',
            'apellido_paterno' => '',
            'apellido_materno' => '',
            'telefono_1' => '',
            'telefono_2' => '',
            'email' => '',
            // Persona moral
            'no_acta_constitutiva' => '',
            'fecha_acta_constitutiva' => '',
            'fecha_registro_acta' => '',
            'estado_inscrita' => '',
            'nombre_notario' => '',
            'no_notario' => '',
            'estado_notario' => '',
            'ciudad_notario' => '',
            'folio_mercantil' => '',
            'poder_en_acta' => true,
        ]
    ];

    // Archivos de acta constitutiva de arrendatarios (indexados)
    public $actas_arrendatarios = [];

    // Paso 6: Arrendador(es)
    public $arrendadores = [
        [
            'tipo_persona' => 'fisica',
            'nombre' => '',
            'apellido_paterno' => '',
            'apellido_materno' => '',
            'telefono_1' => '',
            'telefono_2' => '',
            'email' => '',
            'tiene_representante_legal' => false,
            'en_proceso_sucesorio' => false,
            // Persona moral
            'no_acta_constitutiva' => '',
            'fecha_acta_constitutiva' => '',
            'fecha_registro_acta' => '',
            'estado_inscrita' => '',
            'nombre_notario' => '',
            'no_notario' => '',
            'estado_notario' => '',
            'ciudad_notario' => '',
            'folio_mercantil' => '',
            'poder_en_acta' => true,
        ]
    ];

    // Archivos de acta constitutiva de arrendadores (indexados)
    public $actas_arrendadores = [];

    // Paso 7: Fiador
    public $fiador_tipo = 'ninguno';
    public $fiador_tipo_persona = 'fisica';
    public $fiador_nombre = '';
    public $fiador_apellido_paterno = '';
    public $fiador_apellido_materno = '';
    public $fiador_telefono_1 = '';
    public $fiador_telefono_2 = '';
    public $fiador_email = '';
    // Fiador persona moral
    public $fiador_no_acta_constitutiva = '';
    public $fiador_fecha_acta_constitutiva = '';
    public $fiador_fecha_registro_acta = '';
    public $fiador_estado_inscrita = '';
    public $fiador_acta_constitutiva = null; // archivo
    public $fiador_nombre_notario = '';
    public $fiador_no_notario = '';
    public $fiador_estado_notario = '';
    public $fiador_ciudad_notario = '';
    public $fiador_folio_mercantil = '';
    public $fiador_poder_en_acta = true;
    // Fiador - archivos adicionales (moral)
    public $fiador_poderes_representante = null;
    public $fiador_constancia_situacion_fiscal = null;
    // Fiador - comprobantes de ingresos (todos)
    public $comprobantes_fiador = [];

    // Archivos de comprobantes de ingresos por persona (indexados)
    public $comprobantes_arrendatarios = [];

    // Archivos de INE (todos los tipos, indexados para arrendatarios/arrendadores, simple para fiador)
    public $ines_arrendatarios = [];
    public $ines_arrendadores = [];
    public $ine_fiador = [];

    // Archivos de poderes y constancia (moral, indexados)
    public $poderes_arrendatarios = [];
    public $constancias_arrendatarios = [];
    public $poderes_arrendadores = [];
    public $constancias_arrendadores = [];

    // Paso 8: Complementos
    public $complementos = [];
    public $observaciones = '';

    // Paso 9: Términos y Condiciones
    public $acepto_terminos = false;
    public $acepto_privacidad = false;

    public function mount()
    {
        $this->currentStep = 1;
    }

    public function nextStep()
    {
        $this->validateCurrentStep();
        
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function goToStep($step)
    {
        if ($step >= 1 && $step <= $this->totalSteps) {
            $this->currentStep = $step;
        }
    }

    public function addArrendatario()
    {
        $this->arrendatarios[] = [
            'tipo_persona' => 'fisica',
            'nombre' => '',
            'apellido_paterno' => '',
            'apellido_materno' => '',
            'telefono_1' => '',
            'telefono_2' => '',
            'email' => '',
            'no_acta_constitutiva' => '',
            'fecha_acta_constitutiva' => '',
            'fecha_registro_acta' => '',
            'estado_inscrita' => '',
            'nombre_notario' => '',
            'no_notario' => '',
            'estado_notario' => '',
            'ciudad_notario' => '',
            'folio_mercantil' => '',
            'poder_en_acta' => true,
        ];
    }

    public function removeArrendatario($index)
    {
        if (count($this->arrendatarios) > 1) {
            unset($this->arrendatarios[$index]);
            $this->arrendatarios = array_values($this->arrendatarios);
        }
    }

    public function addArrendador()
    {
        $this->arrendadores[] = [
            'tipo_persona' => 'fisica',
            'nombre' => '',
            'apellido_paterno' => '',
            'apellido_materno' => '',
            'telefono_1' => '',
            'telefono_2' => '',
            'email' => '',
            'tiene_representante_legal' => false,
            'en_proceso_sucesorio' => false,
            'no_acta_constitutiva' => '',
            'fecha_acta_constitutiva' => '',
            'fecha_registro_acta' => '',
            'estado_inscrita' => '',
            'nombre_notario' => '',
            'no_notario' => '',
            'estado_notario' => '',
            'ciudad_notario' => '',
            'folio_mercantil' => '',
            'poder_en_acta' => true,
        ];
    }

    public function removeArrendador($index)
    {
        if (count($this->arrendadores) > 1) {
            unset($this->arrendadores[$index]);
            $this->arrendadores = array_values($this->arrendadores);
        }
    }

    protected function fileMessages(): array
    {
        $campos = [
            'actas_arrendatarios.*', 'poderes_arrendatarios.*', 'constancias_arrendatarios.*',
            'comprobantes_arrendatarios.*.*', 'ines_arrendatarios.*.*',
            'actas_arrendadores.*', 'poderes_arrendadores.*', 'constancias_arrendadores.*',
            'ines_arrendadores.*.*',
            'fiador_acta_constitutiva', 'fiador_poderes_representante', 'fiador_constancia_situacion_fiscal',
            'comprobantes_fiador.*', 'ine_fiador.*',
        ];

        $messages = [];
        foreach ($campos as $campo) {
            $messages["{$campo}.max"] = 'El archivo no debe superar 5 MB.';
            $messages["{$campo}.file"] = 'El valor debe ser un archivo válido.';
        }
        return $messages;
    }

    protected function validateCurrentStep()
    {
        $rules = $this->getValidationRulesForStep($this->currentStep);
        
        if (!empty($rules)) {
            $this->validate($rules, $this->fileMessages());
        }
    }

    protected function getValidationRulesForStep($step)
    {
        return match($step) {
            1 => [
                'tramitante_nombre' => 'required|string|max:255',
                'tramitante_apellido_paterno' => 'required|string|max:255',
                'tramitante_telefono_1' => 'required|string|max:20',
                'tramitante_email' => 'required|email|max:255',
                'tipo_solicitante' => 'required|in:asesor,propietario',
            ],
            2 => [
                'tipo_producto' => 'required|in:basica,superior,empresarial',
            ],
            3 => [
                'monto_renta_mensual' => 'required|numeric|min:0',
                'fecha_inicio' => 'required|date',
                'fecha_termino' => 'required|date|after:fecha_inicio',
                'inmueble_uso' => 'required|string|max:255',
            ],
            4 => [
                'inmueble_codigo_postal' => 'required|string|max:10',
                'inmueble_estado' => 'required|string|max:255',
                'inmueble_municipio' => 'required|string|max:255',
                'inmueble_colonia' => 'required|string|max:255',
                'inmueble_calle' => 'required|string|max:255',
                'inmueble_numero_exterior' => 'required|string|max:50',
            ],
            5 => [
                'arrendatarios.*.nombre' => 'required|string|max:255',
                'arrendatarios.*.apellido_paterno' => 'required|string|max:255',
                'arrendatarios.*.telefono_1' => 'required|string|max:20',
                'arrendatarios.*.email' => 'required|email|max:255',
                'actas_arrendatarios.*' => 'nullable|file|max:5120',
                'comprobantes_arrendatarios.*' => 'nullable|array',
                'comprobantes_arrendatarios.*.*' => 'nullable|file|max:5120',
                'poderes_arrendatarios.*' => 'nullable|file|max:5120',
                'constancias_arrendatarios.*' => 'nullable|file|max:5120',
                'ines_arrendatarios.*' => 'nullable|array',
                'ines_arrendatarios.*.*' => 'nullable|file|max:5120',
            ],
            6 => [
                'arrendadores.*.nombre' => 'required|string|max:255',
                'arrendadores.*.apellido_paterno' => 'required|string|max:255',
                'arrendadores.*.telefono_1' => 'required|string|max:20',
                'arrendadores.*.email' => 'required|email|max:255',
                'actas_arrendadores.*' => 'nullable|file|max:5120',
                'poderes_arrendadores.*' => 'nullable|file|max:5120',
                'constancias_arrendadores.*' => 'nullable|file|max:5120',
                'ines_arrendadores.*' => 'nullable|array',
                'ines_arrendadores.*.*' => 'nullable|file|max:5120',
            ],
            7 => [
                'fiador_tipo' => 'required|in:ninguno,persona,empresa',
                'fiador_nombre' => 'required_if:fiador_tipo,persona,empresa|string|max:255',
                'fiador_apellido_paterno' => 'required_if:fiador_tipo,persona|string|max:255',
                'fiador_telefono_1' => 'required_if:fiador_tipo,persona,empresa|string|max:20',
                'fiador_email' => 'required_if:fiador_tipo,persona,empresa|email|max:255',
                'fiador_acta_constitutiva' => 'nullable|file|max:5120',
                'fiador_poderes_representante' => 'nullable|file|max:5120',
                'fiador_constancia_situacion_fiscal' => 'nullable|file|max:5120',
                'comprobantes_fiador.*' => 'nullable|file|max:5120',
                'ine_fiador.*' => 'nullable|file|max:5120',
            ],
            9 => [
                'acepto_terminos' => 'accepted',
                'acepto_privacidad' => 'accepted',
            ],
            default => [],
        };
    }

    public function submit()
    {
        $this->validateCurrentStep();

        try {
            // \Log::info('Iniciando creación de contrato', [
            //     'tramitante' => $this->tramitante_nombre,
            //     'producto' => $this->tipo_producto,
            // ]);

            // Crear o actualizar Tramitante (si el email ya existe, lo actualiza)
            $tramitante = Tramitante::updateOrCreate(
                ['email' => $this->tramitante_email], // Buscar por email
                [
                    'nombre' => $this->tramitante_nombre,
                    'apellido_paterno' => $this->tramitante_apellido_paterno,
                    'apellido_materno' => $this->tramitante_apellido_materno,
                    'telefono_1' => $this->tramitante_telefono_1,
                    'telefono_2' => $this->tramitante_telefono_2,
                    'es_independiente' => $this->es_independiente,
                    'tipo_solicitante' => $this->tipo_solicitante,
                    'acepto_terminos' => $this->acepto_terminos,
                ]
            );

            // \Log::info('Tramitante creado/actualizado', ['id' => $tramitante->id, 'email' => $tramitante->email]);

            // Calcular monto total (ejemplo: 12 meses)
            $monto_total = floatval($this->monto_renta_mensual) * 12;

            // Preparar datos de renta
            $datos_renta = [
                'monto_mensual' => floatval($this->monto_renta_mensual),
                'incluye_iva' => $this->incluye_iva,
                'fecha_inicio' => $this->fecha_inicio,
                'fecha_termino' => $this->fecha_termino,
                'servicios_incluidos' => $this->servicios_incluidos ?? [],
                'forma_pago' => 'mensual', // Valor por defecto
                'dia_pago' => 1, // Valor por defecto
            ];

            // Crear Contrato
            $contrato = Contrato::create([
                'tramitante_id' => $tramitante->id,
                'tipo_producto' => $this->tipo_producto,
                'monto_renta_mensual' => floatval($this->monto_renta_mensual),
                'monto_total' => $monto_total,
                'incluye_iva' => $this->incluye_iva,
                'fecha_inicio' => $this->fecha_inicio,
                'fecha_termino' => $this->fecha_termino,
                'estado' => 'borrador',
                'datos_renta' => $datos_renta,
                'servicios_inmueble' => $this->servicios_incluidos,
                'complementos' => $this->complementos,
                'observaciones' => $this->observaciones,
            ]);

            // \Log::info('Contrato creado', ['id' => $contrato->id, 'folio' => $contrato->folio]);

            // Crear Inmueble
            Inmueble::create([
                'contrato_id' => $contrato->id,
                'codigo_postal' => $this->inmueble_codigo_postal,
                'estado' => $this->inmueble_estado,
                'alcaldia_municipio' => $this->inmueble_municipio,
                'colonia' => $this->inmueble_colonia,
                'calle' => $this->inmueble_calle,
                'numero_exterior' => $this->inmueble_numero_exterior,
                'edificio' => $this->inmueble_edificio,
                'numero_interior' => $this->inmueble_numero_interior,
                'uso_inmueble' => $this->inmueble_uso,
            ]);

            // \Log::info('Inmueble creado');

            // Crear Arrendatarios
            foreach ($this->arrendatarios as $index => $arr) {
                $actaPath = null;
                if (!empty($this->actas_arrendatarios[$index])) {
                    $actaPath = $this->actas_arrendatarios[$index]->store('actas', 'public');
                }

                $comprobantesArr = [];
                if (!empty($this->comprobantes_arrendatarios[$index])) {
                    foreach ((array) $this->comprobantes_arrendatarios[$index] as $file) {
                        $comprobantesArr[] = $file->store('comprobantes', 'public');
                    }
                }

                $ineArr = [];
                if (!empty($this->ines_arrendatarios[$index])) {
                    foreach ((array) $this->ines_arrendatarios[$index] as $file) {
                        $ineArr[] = $file->store('ines', 'public');
                    }
                }

                $poderesPath = null;
                if ($arr['tipo_persona'] === 'moral' && !empty($this->poderes_arrendatarios[$index])) {
                    $poderesPath = $this->poderes_arrendatarios[$index]->store('poderes', 'public');
                }

                $constanciaPath = null;
                if ($arr['tipo_persona'] === 'moral' && !empty($this->constancias_arrendatarios[$index])) {
                    $constanciaPath = $this->constancias_arrendatarios[$index]->store('constancias', 'public');
                }

                Arrendatario::create([
                    'contrato_id' => $contrato->id,
                    'tipo_persona' => $arr['tipo_persona'],
                    'nombre' => $arr['nombre'],
                    'apellido_paterno' => $arr['apellido_paterno'] ?? null,
                    'apellido_materno' => $arr['apellido_materno'] ?? null,
                    'telefono_1' => $arr['telefono_1'],
                    'telefono_2' => $arr['telefono_2'] ?? null,
                    'email' => $arr['email'],
                    'domicilio_notificaciones' => [
                        'calle' => $this->inmueble_calle,
                        'numero_exterior' => $this->inmueble_numero_exterior,
                        'numero_interior' => $this->inmueble_numero_interior ?? '',
                        'colonia' => $this->inmueble_colonia,
                        'municipio' => $this->inmueble_municipio,
                        'estado' => $this->inmueble_estado,
                        'codigo_postal' => $this->inmueble_codigo_postal,
                    ],
                    'orden' => $index + 1,
                    'comprobantes_ingresos' => !empty($comprobantesArr) ? $comprobantesArr : null,
                    'ine_paths' => !empty($ineArr) ? $ineArr : null,
                    // Persona moral
                    'no_acta_constitutiva' => $arr['tipo_persona'] === 'moral' ? ($arr['no_acta_constitutiva'] ?? null) : null,
                    'fecha_acta_constitutiva' => $arr['tipo_persona'] === 'moral' ? ($arr['fecha_acta_constitutiva'] ?: null) : null,
                    'fecha_registro_acta' => $arr['tipo_persona'] === 'moral' ? ($arr['fecha_registro_acta'] ?: null) : null,
                    'estado_inscrita' => $arr['tipo_persona'] === 'moral' ? ($arr['estado_inscrita'] ?? null) : null,
                    'acta_constitutiva_path' => $actaPath,
                    'nombre_notario' => $arr['tipo_persona'] === 'moral' ? ($arr['nombre_notario'] ?? null) : null,
                    'no_notario' => $arr['tipo_persona'] === 'moral' ? ($arr['no_notario'] ?? null) : null,
                    'estado_notario' => $arr['tipo_persona'] === 'moral' ? ($arr['estado_notario'] ?? null) : null,
                    'ciudad_notario' => $arr['tipo_persona'] === 'moral' ? ($arr['ciudad_notario'] ?? null) : null,
                    'folio_mercantil' => $arr['tipo_persona'] === 'moral' ? ($arr['folio_mercantil'] ?? null) : null,
                    'poder_en_acta' => $arr['tipo_persona'] === 'moral' ? ($arr['poder_en_acta'] ?? null) : null,
                    'poderes_representante_path' => $poderesPath,
                    'constancia_situacion_fiscal_path' => $constanciaPath,
                ]);
            }

            // \Log::info('Arrendatarios creados', ['count' => count($this->arrendatarios)]);

            // Crear Arrendadores
            foreach ($this->arrendadores as $index => $arr) {
                $actaPath = null;
                if (!empty($this->actas_arrendadores[$index])) {
                    $actaPath = $this->actas_arrendadores[$index]->store('actas', 'public');
                }

                $ineArrArrendador = [];
                if (!empty($this->ines_arrendadores[$index])) {
                    foreach ((array) $this->ines_arrendadores[$index] as $file) {
                        $ineArrArrendador[] = $file->store('ines', 'public');
                    }
                }

                $poderesPath = null;
                if ($arr['tipo_persona'] === 'moral' && !empty($this->poderes_arrendadores[$index])) {
                    $poderesPath = $this->poderes_arrendadores[$index]->store('poderes', 'public');
                }

                $constanciaPath = null;
                if ($arr['tipo_persona'] === 'moral' && !empty($this->constancias_arrendadores[$index])) {
                    $constanciaPath = $this->constancias_arrendadores[$index]->store('constancias', 'public');
                }

                Arrendador::create([
                    'contrato_id' => $contrato->id,
                    'tipo_persona' => $arr['tipo_persona'],
                    'nombre' => $arr['nombre'],
                    'apellido_paterno' => $arr['apellido_paterno'] ?? null,
                    'apellido_materno' => $arr['apellido_materno'] ?? null,
                    'telefono_1' => $arr['telefono_1'],
                    'telefono_2' => $arr['telefono_2'] ?? null,
                    'email' => $arr['email'],
                    'tiene_representante_legal' => $arr['tiene_representante_legal'] ?? false,
                    'en_proceso_sucesorio' => $arr['en_proceso_sucesorio'] ?? false,
                    'direccion' => [
                        'calle' => $this->inmueble_calle,
                        'numero_exterior' => $this->inmueble_numero_exterior,
                        'numero_interior' => $this->inmueble_numero_interior ?? '',
                        'colonia' => $this->inmueble_colonia,
                        'municipio' => $this->inmueble_municipio,
                        'estado' => $this->inmueble_estado,
                        'codigo_postal' => $this->inmueble_codigo_postal,
                    ],
                    'orden' => $index + 1,
                    'comprobantes_ingresos' => !empty($comprobantesArr) ? $comprobantesArr : null,
                    // Persona moral
                    'no_acta_constitutiva' => $arr['tipo_persona'] === 'moral' ? ($arr['no_acta_constitutiva'] ?? null) : null,
                    'fecha_acta_constitutiva' => $arr['tipo_persona'] === 'moral' ? ($arr['fecha_acta_constitutiva'] ?: null) : null,
                    'fecha_registro_acta' => $arr['tipo_persona'] === 'moral' ? ($arr['fecha_registro_acta'] ?: null) : null,
                    'estado_inscrita' => $arr['tipo_persona'] === 'moral' ? ($arr['estado_inscrita'] ?? null) : null,
                    'acta_constitutiva_path' => $actaPath,
                    'nombre_notario' => $arr['tipo_persona'] === 'moral' ? ($arr['nombre_notario'] ?? null) : null,
                    'no_notario' => $arr['tipo_persona'] === 'moral' ? ($arr['no_notario'] ?? null) : null,
                    'estado_notario' => $arr['tipo_persona'] === 'moral' ? ($arr['estado_notario'] ?? null) : null,
                    'ciudad_notario' => $arr['tipo_persona'] === 'moral' ? ($arr['ciudad_notario'] ?? null) : null,
                    'folio_mercantil' => $arr['tipo_persona'] === 'moral' ? ($arr['folio_mercantil'] ?? null) : null,
                    'poder_en_acta' => $arr['tipo_persona'] === 'moral' ? ($arr['poder_en_acta'] ?? null) : null,
                    'poderes_representante_path' => $poderesPath,
                    'constancia_situacion_fiscal_path' => $constanciaPath,
                    'comprobantes_ingresos' => null,
                    'ine_paths' => !empty($ineArrArrendador) ? $ineArrArrendador : null,
                ]);
            }

            // \Log::info('Arrendadores creados', ['count' => count($this->arrendadores)]);

            // Crear Fiador si aplica
            if ($this->fiador_tipo !== 'ninguno') {
                // Mapear el tipo de fiador correctamente
                $tipo_fiador = 'fiador'; // Siempre es fiador cuando no es 'ninguno'
                $tipo_persona_fiador = $this->fiador_tipo === 'persona' ? 'fisica' : 'moral';

                $actaFiadorPath = null;
                if ($this->fiador_acta_constitutiva) {
                    $actaFiadorPath = $this->fiador_acta_constitutiva->store('actas', 'public');
                }

                $comprobantesArrFiador = [];
                if (!empty($this->comprobantes_fiador)) {
                    foreach ((array) $this->comprobantes_fiador as $file) {
                        $comprobantesArrFiador[] = $file->store('comprobantes', 'public');
                    }
                }

                $ineArrFiador = [];
                if (!empty($this->ine_fiador)) {
                    foreach ((array) $this->ine_fiador as $file) {
                        $ineArrFiador[] = $file->store('ines', 'public');
                    }
                }

                $poderesFiadorPath = null;
                if ($tipo_persona_fiador === 'moral' && $this->fiador_poderes_representante) {
                    $poderesFiadorPath = $this->fiador_poderes_representante->store('poderes', 'public');
                }

                $constanciaFiadorPath = null;
                if ($tipo_persona_fiador === 'moral' && $this->fiador_constancia_situacion_fiscal) {
                    $constanciaFiadorPath = $this->fiador_constancia_situacion_fiscal->store('constancias', 'public');
                }

                Fiador::create([
                    'contrato_id' => $contrato->id,
                    'tipo' => $tipo_fiador,
                    'tipo_persona' => $tipo_persona_fiador,
                    'nombre' => $this->fiador_nombre,
                    'apellido_paterno' => $this->fiador_apellido_paterno,
                    'apellido_materno' => $this->fiador_apellido_materno,
                    'telefono_1' => $this->fiador_telefono_1,
                    'telefono_2' => $this->fiador_telefono_2,
                    'email' => $this->fiador_email,
                    'domicilio' => [],
                    'comprobantes_ingresos' => !empty($comprobantesArrFiador) ? $comprobantesArrFiador : null,
                    'ine_paths' => !empty($ineArrFiador) ? $ineArrFiador : null,
                    // Persona moral
                    'no_acta_constitutiva' => $tipo_persona_fiador === 'moral' ? $this->fiador_no_acta_constitutiva : null,
                    'fecha_acta_constitutiva' => $tipo_persona_fiador === 'moral' ? ($this->fiador_fecha_acta_constitutiva ?: null) : null,
                    'fecha_registro_acta' => $tipo_persona_fiador === 'moral' ? ($this->fiador_fecha_registro_acta ?: null) : null,
                    'estado_inscrita' => $tipo_persona_fiador === 'moral' ? $this->fiador_estado_inscrita : null,
                    'acta_constitutiva_path' => $actaFiadorPath,
                    'nombre_notario' => $tipo_persona_fiador === 'moral' ? $this->fiador_nombre_notario : null,
                    'no_notario' => $tipo_persona_fiador === 'moral' ? $this->fiador_no_notario : null,
                    'estado_notario' => $tipo_persona_fiador === 'moral' ? $this->fiador_estado_notario : null,
                    'ciudad_notario' => $tipo_persona_fiador === 'moral' ? $this->fiador_ciudad_notario : null,
                    'folio_mercantil' => $tipo_persona_fiador === 'moral' ? $this->fiador_folio_mercantil : null,
                    'poder_en_acta' => $tipo_persona_fiador === 'moral' ? $this->fiador_poder_en_acta : null,
                    'poderes_representante_path' => $poderesFiadorPath,
                    'constancia_situacion_fiscal_path' => $constanciaFiadorPath,
                ]);
                // \Log::info('Fiador creado');
            }

            // \Log::info('Contrato completado exitosamente', ['folio' => $contrato->folio]);

            session()->flash('success', '¡Contrato creado exitosamente! Folio: ' . $contrato->folio);
            
            return redirect()->route('contrato.confirmacion', $contrato->id);
            
        } catch (\Exception $e) {
            \Log::error('Error al crear contrato', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            session()->flash('error', 'Error al crear el contrato: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.contrato-wizard');
    }
}
