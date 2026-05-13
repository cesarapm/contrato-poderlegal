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
    public $inmueble_uso = '';

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
        ]
    ];

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
        ]
    ];

    // Paso 7: Fiador
    public $fiador_tipo = 'ninguno';
    public $fiador_tipo_persona = 'fisica';
    public $fiador_nombre = '';
    public $fiador_apellido_paterno = '';
    public $fiador_apellido_materno = '';
    public $fiador_telefono_1 = '';
    public $fiador_telefono_2 = '';
    public $fiador_email = '';

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
        ];
    }

    public function removeArrendador($index)
    {
        if (count($this->arrendadores) > 1) {
            unset($this->arrendadores[$index]);
            $this->arrendadores = array_values($this->arrendadores);
        }
    }

    protected function validateCurrentStep()
    {
        $rules = $this->getValidationRulesForStep($this->currentStep);
        
        if (!empty($rules)) {
            $this->validate($rules);
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
            ],
            4 => [
                'inmueble_codigo_postal' => 'required|string|max:10',
                'inmueble_estado' => 'required|string|max:255',
                'inmueble_municipio' => 'required|string|max:255',
                'inmueble_colonia' => 'required|string|max:255',
                'inmueble_calle' => 'required|string|max:255',
                'inmueble_numero_exterior' => 'required|string|max:50',
                'inmueble_uso' => 'required|string|max:255',
            ],
            5 => [
                'arrendatarios.*.nombre' => 'required|string|max:255',
                'arrendatarios.*.apellido_paterno' => 'required|string|max:255',
                'arrendatarios.*.telefono_1' => 'required|string|max:20',
                'arrendatarios.*.email' => 'required|email|max:255',
            ],
            6 => [
                'arrendadores.*.nombre' => 'required|string|max:255',
                'arrendadores.*.apellido_paterno' => 'required|string|max:255',
                'arrendadores.*.telefono_1' => 'required|string|max:20',
                'arrendadores.*.email' => 'required|email|max:255',
            ],
            7 => [
                'fiador_tipo' => 'required|in:ninguno,persona,empresa',
                'fiador_nombre' => 'required_if:fiador_tipo,persona,empresa|string|max:255',
                'fiador_apellido_paterno' => 'required_if:fiador_tipo,persona|string|max:255',
                'fiador_telefono_1' => 'required_if:fiador_tipo,persona,empresa|string|max:20',
                'fiador_email' => 'required_if:fiador_tipo,persona,empresa|email|max:255',
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
                ]);
            }

            // \Log::info('Arrendatarios creados', ['count' => count($this->arrendatarios)]);

            // Crear Arrendadores
            foreach ($this->arrendadores as $index => $arr) {
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
                ]);
            }

            // \Log::info('Arrendadores creados', ['count' => count($this->arrendadores)]);

            // Crear Fiador si aplica
            if ($this->fiador_tipo !== 'ninguno') {
                // Mapear el tipo de fiador correctamente
                $tipo_fiador = 'fiador'; // Siempre es fiador cuando no es 'ninguno'
                $tipo_persona_fiador = $this->fiador_tipo === 'persona' ? 'fisica' : 'moral';
                
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
