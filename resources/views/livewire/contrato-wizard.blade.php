<div class="w-full max-w-6xl mx-auto px-1 sm:px-6 lg:px-8">
    <!-- Progress Steps -->
    <div class="mb-8 sm:mb-12">
        <div class="grid grid-cols-3 sm:grid-cols-5 lg:grid-cols-9 gap-2 mb-4">
            @for ($i = 1; $i <= $totalSteps; $i++)
                <div class="relative">
                    <button 
                        type="button"
                        wire:click="goToStep({{ $i }})"
                        class="w-full aspect-square rounded-xl sm:rounded-2xl font-bold text-sm sm:text-base lg:text-lg transition-all duration-300 shadow-xl hover:scale-105 hover:shadow-2xl {{ $currentStep < $i ? 'border border-white/20' : '' }}"
                        style="{{ $currentStep == $i ? 'background: linear-gradient(135deg, #FFD700 0%, #FFAA00 100%); color: #1A0933; transform: scale(1.1); box-shadow: 0 20px 40px rgba(255, 215, 0, 0.5);' : '' }}
                               {{ $currentStep > $i ? 'background: linear-gradient(135deg, #663399 0%, #4A148C 100%); color: white;' : '' }}
                               {{ $currentStep < $i ? 'background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); color: rgba(255, 255, 255, 0.4);' : '' }}">
                        {{ $i }}
                    </button>
                </div>
            @endfor
        </div>
        <div class="text-center">
            <p class="font-bold text-base sm:text-lg" style="color: #FFC107;">Paso {{ $currentStep }} de {{ $totalSteps }}</p>
            <p class="text-xs sm:text-sm mt-1" style="color: rgba(255, 255, 255, 0.6);">
                @switch($currentStep)
                    @case(1) Información del Tramitante @break
                    @case(2) Selección de Producto @break
                    @case(3) Datos de Renta @break
                    @case(4) Ubicación del Inmueble @break
                    @case(5) Datos del Arrendatario @break
                    @case(6) Datos del Arrendador @break
                    @case(7) Información del Fiador @break
                    @case(8) Complementos Adicionales @break
                    @case(9) Confirmación y Términos @break
                @endswitch
            </p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="relative backdrop-blur-xl bg-gradient-to-br from-white/10 to-white/5 rounded-2xl sm:rounded-3xl p-6 sm:p-8 md:p-12 shadow-2xl border border-white/20">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-gold-accent/20 to-transparent rounded-bl-full blur-2xl"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-tr from-primary-purple/20 to-transparent rounded-tr-full blur-2xl"></div>

        @if (session()->has('success'))
            <div class="mb-6 p-5 bg-gradient-to-r from-green-500/20 to-green-600/10 border-l-4 border-green-500 rounded-xl text-green-100 backdrop-blur-sm">
                <p class="font-semibold">{{ session('success') }}</p>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mb-6 p-5 bg-gradient-to-r from-red-500/20 to-red-600/10 border-l-4 border-red-500 rounded-xl text-red-100 backdrop-blur-sm">
                <p class="font-semibold">{{ session('error') }}</p>
            </div>
        @endif

        <form wire:submit.prevent="submit" class="relative z-10">
            <!-- Paso 1: Datos del Tramitante -->
            @if ($currentStep === 1)
                <div class="space-y-6 animate-fadeIn ">
                    <div class="mb-8">
                        <h3 class="text-2xl sm:text-3xl lg:text-4xl font-display font-bold mb-3" style="background: linear-gradient(135deg, #FFD700 0%, #FFAA00 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                            Datos del Tramitante
                        </h3>
                        <p class="text-white/70">Ingresa la información de quien solicita el contrato</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-white font-semibold mb-2">Nombre *</label>
                            <input 
                                type="text" 
                                wire:model="tramitante_nombre"
                                class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                placeholder="Juan">
                            @error('tramitante_nombre') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-white font-semibold mb-2">Apellido Paterno *</label>
                            <input 
                                type="text" 
                                wire:model="tramitante_apellido_paterno"
                                class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                placeholder="Pérez">
                            @error('tramitante_apellido_paterno') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-white font-semibold mb-2">Apellido Materno</label>
                            <input 
                                type="text" 
                                wire:model="tramitante_apellido_materno"
                                class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                placeholder="García">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-white font-semibold mb-2">Teléfono Principal *</label>
                            <input 
                                type="tel" 
                                wire:model="tramitante_telefono_1"
                                class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                placeholder="55 1234 5678">
                            @error('tramitante_telefono_1') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-white font-semibold mb-2">Teléfono Secundario</label>
                            <input 
                                type="tel" 
                                wire:model="tramitante_telefono_2"
                                class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                placeholder="55 8765 4321">
                        </div>
                    </div>

                    <div>
                        <label class="block text-white font-semibold mb-2">Correo Electrónico *</label>
                        <input 
                            type="email" 
                            wire:model="tramitante_email"
                            class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                            placeholder="correo@ejemplo.com">
                        @error('tramitante_email') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-white font-semibold mb-2">Tipo de Solicitante *</label>
                        <select 
                            wire:model="tipo_solicitante"
                            class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm">
                            <option value="asesor" class="bg-purple-900 text-white">Asesor</option>
                            <option value="propietario" class="bg-purple-900 text-white">Propietario</option>
                        </select>
                        @error('tipo_solicitante') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <label class="flex items-center space-x-3 cursor-pointer group">
                        <input 
                            type="checkbox" 
                            wire:model="es_independiente"
                            class="w-5 h-5 rounded border-white/30 bg-white/10 text-gold-accent focus:ring-gold-accent/50">
                        <span class="text-white group-hover:text-gold-accent transition-colors">Soy independiente</span>
                    </label>
                </div>
            @endif

            <!-- Paso 2: Tipo de Producto -->
            @if ($currentStep === 2)
                <div class="space-y-8 animate-fadeIn">
                    <div class="mb-8">
                        <h3 class="text-2xl sm:text-3xl lg:text-4xl font-display font-bold mb-3" style="background: linear-gradient(135deg, #FFD700 0%, #FFAA00 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                            Selecciona tu Producto
                        </h3>
                        <p class="text-white/70">Elige el paquete que mejor se adapte a tus necesidades</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- <label class="cursor-pointer group">
                            <input type="radio" wire:model="tipo_producto" value="basica" class="hidden peer">
                            <div class="relative h-full p-8 rounded-2xl bg-gradient-to-br from-white/5 to-white/10 border-2 border-white/20 peer-checked:border-gold-accent peer-checked:shadow-2xl peer-checked:shadow-gold-accent/30 peer-checked:scale-105 transition-all duration-300 hover:scale-102 backdrop-blur-sm">
                                <div class="text-6xl mb-4">📄</div>
                                <h4 class="text-2xl font-bold text-white mb-3">Básica</h4>
                                <p class="text-white/70 mb-4">Contrato estándar con cláusulas esenciales</p>
                                <div class="absolute top-4 right-4 w-8 h-8 rounded-full border-2 border-white/30 peer-checked:border-gold-accent peer-checked:bg-gold-accent flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white opacity-0 peer-checked:opacity-100" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                        </label> -->

                        <label class="cursor-pointer group">
                            <input type="radio" wire:model="tipo_producto" value="superior" class="hidden peer">
                            <div class="relative h-full p-8 rounded-2xl bg-gradient-to-br from-white/5 to-white/10 border-2 border-white/20 peer-checked:border-gold-accent peer-checked:shadow-2xl peer-checked:shadow-gold-accent/30 peer-checked:scale-105 transition-all duration-300 hover:scale-102 backdrop-blur-sm">
                                <div class="absolute -top-3 -right-3 px-3 py-1 bg-gradient-to-r from-gold-accent to-gold-warm rounded-full text-purple-deep text-xs font-bold">POPULAR</div>
                                <div class="text-6xl mb-4">⭐</div>
                                <h4 class="text-2xl font-bold text-white mb-3">Superior</h4>
                                <p class="text-white/70 mb-4">Incluye cláusulas adicionales y asesoría legal</p>
                                <div class="absolute top-4 right-4 w-8 h-8 rounded-full border-2 border-white/30 peer-checked:border-gold-accent peer-checked:bg-gold-accent flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white opacity-0 peer-checked:opacity-100" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                        </label>

                            <!-- <label class="cursor-pointer group">
                                <input type="radio" wire:model="tipo_producto" value="empresarial" class="hidden peer">
                                <div class="relative h-full p-8 rounded-2xl bg-gradient-to-br from-white/5 to-white/10 border-2 border-white/20 peer-checked:border-gold-accent peer-checked:shadow-2xl peer-checked:shadow-gold-accent/30 peer-checked:scale-105 transition-all duration-300 hover:scale-102 backdrop-blur-sm">
                                    <div class="text-6xl mb-4">💼</div>
                                    <h4 class="text-2xl font-bold text-white mb-3">Empresarial</h4>
                                    <p class="text-white/70 mb-4">Contratos corporativos personalizados</p>
                                    <div class="absolute top-4 right-4 w-8 h-8 rounded-full border-2 border-white/30 peer-checked:border-gold-accent peer-checked:bg-gold-accent flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white opacity-0 peer-checked:opacity-100" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </div>
                            </label> -->
                    </div>

                    @error('tipo_producto')
                        <p class="text-red-400 text-center">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            <!-- Paso 3: Datos de Renta -->
            @if ($currentStep === 3)
                <div class="space-y-6 animate-fadeIn">
                    <div class="mb-8">
                        <h3 class="text-2xl sm:text-3xl lg:text-4xl font-display font-bold mb-3" style="background: linear-gradient(135deg, #FFD700 0%, #FFAA00 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                            Datos de Renta
                        </h3>
                        <p class="text-white/70">Define los términos económicos del contrato</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-white font-semibold mb-2">Monto de Renta Mensual *</label>
                            <div class="relative">
                              
                                <input 
                                    type="number" 
                                    wire:model="monto_renta_mensual"
                                    class="w-full pl-7 pr-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                    placeholder="15,000.00"
                                    step="0.01">
                            </div>
                            @error('monto_renta_mensual') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-white font-semibold mb-2">Uso del Inmueble</label>
                            <select 
                                wire:model="inmueble_uso"
                                class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm">
                                <option value="habitacional" class="bg-purple-900 text-white">Habitacional</option>
                                <option value="comercial" class="bg-purple-900 text-white">Comercial</option>
                                <option value="mixto" class="bg-purple-900 text-white">Mixto</option>
                            </select>
                        </div>
                    </div>

                    <label class="flex items-center space-x-3 cursor-pointer group">
                        <input 
                            type="checkbox" 
                            wire:model="incluye_iva"
                            class="w-5 h-5 rounded border-white/30 bg-white/10 text-gold-accent focus:ring-gold-accent/50">
                        <span class="text-white group-hover:text-gold-accent transition-colors">La renta incluye IVA</span>
                    </label>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-white font-semibold mb-2">Fecha de Inicio *</label>
                            <input 
                                type="date" 
                                wire:model="fecha_inicio"
                                class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm">
                            @error('fecha_inicio') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-white font-semibold mb-2">Fecha de Término *</label>
                            <input 
                                type="date" 
                                wire:model="fecha_termino"
                                class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm">
                            @error('fecha_termino') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-white font-semibold mb-3">Servicios Incluidos (Opcional)</label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            @foreach(['agua' => '💧 Agua', 'luz' => '⚡ Luz', 'gas' => '🔥 Gas', 'internet' => '📡 Internet', 'mantenimiento' => '🔧 Mantenimiento', 'seguridad' => '🛡️ Seguridad'] as $key => $label)
                                <label class="flex items-center space-x-2 cursor-pointer group px-4 py-3 rounded-xl bg-white/5 hover:bg-white/10 border border-white/20 transition-all">
                                    <input 
                                        type="checkbox" 
                                        wire:model="servicios_incluidos"
                                        value="{{ $key }}"
                                        class="w-4 h-4 rounded border-white/30 bg-white/10 text-gold-accent focus:ring-gold-accent/50">
                                    <span class="text-white text-sm">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Paso 4: Ubicación del Inmueble -->
            @if ($currentStep === 4)
                <div class="space-y-6 animate-fadeIn">
                    <div class="mb-8">
                        <h3 class="text-2xl sm:text-3xl lg:text-4xl font-display font-bold mb-3" style="background: linear-gradient(135deg, #FFD700 0%, #FFAA00 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                            Ubicación del Inmueble
                        </h3>
                        <p class="text-white/70">Especifica la dirección completa de la propiedad</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-white font-semibold mb-2">Código Postal *</label>
                            <input 
                                type="text" 
                                wire:model="inmueble_codigo_postal"
                                class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                placeholder="03100"
                                maxlength="5">
                            @error('inmueble_codigo_postal') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-white font-semibold mb-2">Estado *</label>
                            <input 
                                type="text" 
                                wire:model="inmueble_estado"
                                class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                placeholder="Ciudad de México">
                            @error('inmueble_estado') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-white font-semibold mb-2">Municipio/Alcaldía *</label>
                            <input 
                                type="text" 
                                wire:model="inmueble_municipio"
                                class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                placeholder="Benito Juárez">
                            @error('inmueble_municipio') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-white font-semibold mb-2">Colonia *</label>
                        <input 
                            type="text" 
                            wire:model="inmueble_colonia"
                            class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                            placeholder="Del Valle">
                        @error('inmueble_colonia') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-white font-semibold mb-2">Calle *</label>
                            <input 
                                type="text" 
                                wire:model="inmueble_calle"
                                class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                placeholder="Av. Insurgentes Sur">
                            @error('inmueble_calle') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-white font-semibold mb-2">Número Exterior *</label>
                            <input 
                                type="text" 
                                wire:model="inmueble_numero_exterior"
                                class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                placeholder="1234">
                            @error('inmueble_numero_exterior') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-white font-semibold mb-2">Edificio/Torre (Opcional)</label>
                            <input 
                                type="text" 
                                wire:model="inmueble_edificio"
                                class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                placeholder="Torre A">
                        </div>

                        <div>
                            <label class="block text-white font-semibold mb-2">Número Interior (Opcional)</label>
                            <input 
                                type="text" 
                                wire:model="inmueble_numero_interior"
                                class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                placeholder="301">
                        </div>
                    </div>
                </div>
            @endif

            <!-- Paso 5: Datos del Arrendatario -->
            @if ($currentStep === 5)
                <div class="space-y-6 animate-fadeIn">
                    <div class="mb-8 flex justify-between items-center">
                        <div>
                            <h3 class="text-2xl sm:text-3xl lg:text-4xl font-display font-bold mb-3" style="background: linear-gradient(135deg, #FFD700 0%, #FFAA00 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                                Datos del Arrendatario
                            </h3>
                            <p class="text-white/70">Información de quien rentará la propiedad</p>
                        </div>
                        <button 
                            type="button"
                            wire:click="addArrendatario"
                            class="px-4 py-2 rounded-xl bg-gold-accent text-purple-deep font-semibold hover:scale-105 transition-all">
                            + Agregar Arrendatario
                        </button>
                    </div>

                    @foreach($arrendatarios as $index => $arrendatario)
                        <div class="p-6 rounded-2xl bg-white/5 border border-white/20 space-y-4">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-xl font-bold text-gold-accent">Arrendatario {{ $index + 1 }}</h4>
                                @if(count($arrendatarios) > 1)
                                    <button 
                                        type="button"
                                        wire:click="removeArrendatario({{ $index }})"
                                        class="px-3 py-1 rounded-lg bg-red-500/20 text-red-300 hover:bg-red-500/30 transition-all text-sm">
                                        Eliminar
                                    </button>
                                @endif
                            </div>

                            <div>
                                <label class="block text-white font-semibold mb-2">Tipo de Persona</label>
                                <select 
                                    wire:model.live="arrendatarios.{{ $index }}.tipo_persona"
                                    class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm">
                                    <option value="fisica" class="bg-purple-900 text-white">Persona Física</option>
                                    <option value="moral" class="bg-purple-900 text-white">Persona Moral</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-white font-semibold mb-2">Nombre *</label>
                                    <input 
                                        type="text" 
                                        wire:model="arrendatarios.{{ $index }}.nombre"
                                        class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                        placeholder="María">
                                    @error("arrendatarios.{$index}.nombre") <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-white font-semibold mb-2">Apellido Paterno *</label>
                                    <input 
                                        type="text" 
                                        wire:model="arrendatarios.{{ $index }}.apellido_paterno"
                                        class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                        placeholder="López">
                                    @error("arrendatarios.{$index}.apellido_paterno") <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-white font-semibold mb-2">Apellido Materno</label>
                                    <input 
                                        type="text" 
                                        wire:model="arrendatarios.{{ $index }}.apellido_materno"
                                        class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                        placeholder="Martínez">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-white font-semibold mb-2">Teléfono Principal *</label>
                                    <input 
                                        type="tel" 
                                        wire:model="arrendatarios.{{ $index }}.telefono_1"
                                        class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                        placeholder="55 1234 5678">
                                    @error("arrendatarios.{$index}.telefono_1") <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-white font-semibold mb-2">Teléfono Secundario</label>
                                    <input 
                                        type="tel" 
                                        wire:model="arrendatarios.{{ $index }}.telefono_2"
                                        class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                        placeholder="55 8765 4321">
                                </div>
                            </div>

                            <div>
                                <label class="block text-white font-semibold mb-2">Correo Electrónico *</label>
                                <input 
                                    type="email" 
                                    wire:model="arrendatarios.{{ $index }}.email"
                                    class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                    placeholder="arrendatario@ejemplo.com">
                                @error("arrendatarios.{$index}.email") <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>

                            @if($arrendatario['tipo_persona'] === 'moral')
                                @include('formulario.persona-moral-fields', [
                                    'prefix' => "arrendatarios.{$index}",
                                    'actaModel' => "actas_arrendatarios.{$index}",
                                    'poderesModel' => "poderes_arrendatarios.{$index}",
                                    'constanciaModel' => "constancias_arrendatarios.{$index}",
                                    'data' => $arrendatario,
                                ])
                            @endif

                            {{-- Comprobantes de ingresos (todos los tipos) --}}
                            @php
                                $comprArr = $comprobantes_arrendatarios[$index] ?? null;
                                $comprFiles = $comprArr ? (is_array($comprArr) ? $comprArr : [$comprArr]) : [];
                            @endphp
                            <div class="mt-4 pt-4 border-t border-white/20" x-data="{ files: [], uploaded: {{ count($comprFiles) }} }">
                                <label class="block text-white font-semibold mb-2 text-sm">
                                    Comprobantes de ingresos
                                    <span class="text-white/40 font-normal">(mínimo 3, opcional)</span>
                                </label>
                                <label class="flex items-center gap-2 w-full px-3 py-2 rounded-xl border cursor-pointer transition-all backdrop-blur-sm text-sm"
                                       :class="(files.length || uploaded) ? 'bg-green-500/10 border-green-400/50 text-green-300' : 'bg-white/10 border-white/20 text-white/70 hover:border-gold-accent'">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    <span class="truncate flex-1" x-text="files.length ? files.length + (files.length === 1 ? ' archivo seleccionado' : ' archivos seleccionados') : (uploaded ? uploaded + (uploaded === 1 ? ' archivo subido' : ' archivos subidos') : 'Seleccionar archivos (puede elegir varios)')">Seleccionar archivos (puede elegir varios)</span>
                                    <input type="file" wire:model="comprobantes_arrendatarios.{{ $index }}" class="hidden" accept=".pdf,.jpg,.jpeg,.png" multiple
                                           @change="files = Array.from($event.target.files); uploaded = 0">
                                </label>
                                <template x-if="files.length">
                                    <ul class="mt-2 space-y-1">
                                        <template x-for="file in files" :key="file.name">
                                            <li class="text-green-400 text-xs">
                                                <span x-text="file.name + ' · ' + (file.size / 1024 / 1024).toFixed(2) + ' MB'"></span>
                                            </li>
                                        </template>
                                    </ul>
                                </template>
                                @if(count($comprFiles) > 0)
                                    <ul x-show="!files.length" class="mt-2 space-y-1">
                                        @foreach($comprFiles as $uf)
                                            @if($uf && method_exists($uf, 'getClientOriginalName'))
                                                <li class="text-green-400 text-xs">{{ $uf->getClientOriginalName() }} · {{ round($uf->getSize() / 1024 / 1024, 2) }} MB</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                                <p class="text-white/40 text-xs mt-1">Últimos 3 meses — PDF, JPG o PNG — máx. 5 MB c/u</p>
                                @error("comprobantes_arrendatarios.{$index}.0")
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- INE (todos los tipos) --}}
                            @php
                                $inesArr = $ines_arrendatarios[$index] ?? null;
                                $inesFiles = $inesArr ? (is_array($inesArr) ? $inesArr : [$inesArr]) : [];
                            @endphp
                            <div class="mt-4 pt-4 border-t border-white/20" x-data="{ files: [], uploaded: {{ count($inesFiles) }} }">
                                <label class="block text-white font-semibold mb-2 text-sm">
                                    INE / Identificación oficial
                                    <span class="text-white/40 font-normal">(opcional, puede subir varios)</span>
                                </label>
                                <label class="flex items-center gap-2 w-full px-3 py-2 rounded-xl border cursor-pointer transition-all backdrop-blur-sm text-sm"
                                       :class="(files.length || uploaded) ? 'bg-green-500/10 border-green-400/50 text-green-300' : 'bg-white/10 border-white/20 text-white/70 hover:border-gold-accent'">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    <span class="truncate flex-1" x-text="files.length ? files.length + (files.length === 1 ? ' archivo seleccionado' : ' archivos seleccionados') : (uploaded ? uploaded + (uploaded === 1 ? ' archivo subido' : ' archivos subidos') : 'Seleccionar archivos (anverso y reverso)')">Seleccionar archivos (anverso y reverso)</span>
                                    <input type="file" wire:model="ines_arrendatarios.{{ $index }}" class="hidden" accept=".pdf,.jpg,.jpeg,.png" multiple
                                           @change="files = Array.from($event.target.files); uploaded = 0">
                                </label>
                                <template x-if="files.length">
                                    <ul class="mt-2 space-y-1">
                                        <template x-for="file in files" :key="file.name">
                                            <li class="text-green-400 text-xs">
                                                <span x-text="file.name + ' · ' + (file.size / 1024 / 1024).toFixed(2) + ' MB'"></span>
                                            </li>
                                        </template>
                                    </ul>
                                </template>
                                @if(count($inesFiles) > 0)
                                    <ul x-show="!files.length" class="mt-2 space-y-1">
                                        @foreach($inesFiles as $uf)
                                            @if($uf && method_exists($uf, 'getClientOriginalName'))
                                                <li class="text-green-400 text-xs">{{ $uf->getClientOriginalName() }} · {{ round($uf->getSize() / 1024 / 1024, 2) }} MB</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                                <p class="text-white/40 text-xs mt-1">PDF, JPG o PNG — máx. 5 MB c/u</p>
                                @error("ines_arrendatarios.{$index}.0")
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Paso 6: Datos del Arrendador -->
            @if ($currentStep === 6)
                <div class="space-y-6 animate-fadeIn">
                    <div class="mb-8 flex justify-between items-center">
                        <div>
                            <h3 class="text-2xl sm:text-3xl lg:text-4xl font-display font-bold mb-3" style="background: linear-gradient(135deg, #FFD700 0%, #FFAA00 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                                Datos del Arrendador
                            </h3>
                            <p class="text-white/70">Información del propietario de la propiedad</p>
                        </div>
                        <button 
                            type="button"
                            wire:click="addArrendador"
                            class="px-4 py-2 rounded-xl bg-gold-accent text-purple-deep font-semibold hover:scale-105 transition-all">
                            + Agregar Arrendador
                        </button>
                    </div>

                    @foreach($arrendadores as $index => $arrendador)
                        <div class="p-6 rounded-2xl bg-white/5 border border-white/20 space-y-4">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-xl font-bold text-gold-accent">Arrendador {{ $index + 1 }}</h4>
                                @if(count($arrendadores) > 1)
                                    <button 
                                        type="button"
                                        wire:click="removeArrendador({{ $index }})"
                                        class="px-3 py-1 rounded-lg bg-red-500/20 text-red-300 hover:bg-red-500/30 transition-all text-sm">
                                        Eliminar
                                    </button>
                                @endif
                            </div>

                            <div>
                                <label class="block text-white font-semibold mb-2">Tipo de Persona</label>
                                <select 
                                    wire:model.live="arrendadores.{{ $index }}.tipo_persona"
                                    class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm">
                                    <option value="fisica" class="bg-purple-900 text-white">Persona Física</option>
                                    <option value="moral" class="bg-purple-900 text-white">Persona Moral</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-white font-semibold mb-2">Nombre *</label>
                                    <input 
                                        type="text" 
                                        wire:model="arrendadores.{{ $index }}.nombre"
                                        class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                        placeholder="Carlos">
                                    @error("arrendadores.{$index}.nombre") <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-white font-semibold mb-2">Apellido Paterno *</label>
                                    <input 
                                        type="text" 
                                        wire:model="arrendadores.{{ $index }}.apellido_paterno"
                                        class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                        placeholder="Ramírez">
                                    @error("arrendadores.{$index}.apellido_paterno") <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-white font-semibold mb-2">Apellido Materno</label>
                                    <input 
                                        type="text" 
                                        wire:model="arrendadores.{{ $index }}.apellido_materno"
                                        class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                        placeholder="González">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-white font-semibold mb-2">Teléfono Principal *</label>
                                    <input 
                                        type="tel" 
                                        wire:model="arrendadores.{{ $index }}.telefono_1"
                                        class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                        placeholder="55 1234 5678">
                                    @error("arrendadores.{$index}.telefono_1") <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-white font-semibold mb-2">Teléfono Secundario</label>
                                    <input 
                                        type="tel" 
                                        wire:model="arrendadores.{{ $index }}.telefono_2"
                                        class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                        placeholder="55 8765 4321">
                                </div>
                            </div>

                            <div>
                                <label class="block text-white font-semibold mb-2">Correo Electrónico *</label>
                                <input 
                                    type="email" 
                                    wire:model="arrendadores.{{ $index }}.email"
                                    class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                    placeholder="propietario@ejemplo.com">
                                @error("arrendadores.{$index}.email") <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <label class="flex items-center space-x-3 cursor-pointer group px-4 py-3 rounded-xl bg-white/5 hover:bg-white/10 border border-white/20 transition-all">
                                    <input 
                                        type="checkbox" 
                                        wire:model="arrendadores.{{ $index }}.tiene_representante_legal"
                                        class="w-5 h-5 rounded border-white/30 bg-white/10 text-gold-accent focus:ring-gold-accent/50">
                                    <span class="text-white group-hover:text-gold-accent transition-colors">Tiene representante legal</span>
                                </label>

                                <label class="flex items-center space-x-3 cursor-pointer group px-4 py-3 rounded-xl bg-white/5 hover:bg-white/10 border border-white/20 transition-all">
                                    <input 
                                        type="checkbox" 
                                        wire:model="arrendadores.{{ $index }}.en_proceso_sucesorio"
                                        class="w-5 h-5 rounded border-white/30 bg-white/10 text-gold-accent focus:ring-gold-accent/50">
                                    <span class="text-white group-hover:text-gold-accent transition-colors">En proceso sucesorio</span>
                                </label>
                            </div>

                            @if($arrendador['tipo_persona'] === 'moral')
                                @include('formulario.persona-moral-fields', [
                                    'prefix' => "arrendadores.{$index}",
                                    'actaModel' => "actas_arrendadores.{$index}",
                                    'poderesModel' => "poderes_arrendadores.{$index}",
                                    'constanciaModel' => "constancias_arrendadores.{$index}",
                                    'data' => $arrendador,
                                ])
                            @endif

                            {{-- INE (todos los tipos) --}}
                            @php
                                $inesArrArr = $ines_arrendadores[$index] ?? null;
                                $inesArrFiles = $inesArrArr ? (is_array($inesArrArr) ? $inesArrArr : [$inesArrArr]) : [];
                            @endphp
                            <div class="mt-4 pt-4 border-t border-white/20" x-data="{ files: [], uploaded: {{ count($inesArrFiles) }} }">
                                <label class="block text-white font-semibold mb-2 text-sm">
                                    INE / Identificación oficial
                                    <span class="text-white/40 font-normal">(opcional, puede subir varios)</span>
                                </label>
                                <label class="flex items-center gap-2 w-full px-3 py-2 rounded-xl border cursor-pointer transition-all backdrop-blur-sm text-sm"
                                       :class="(files.length || uploaded) ? 'bg-green-500/10 border-green-400/50 text-green-300' : 'bg-white/10 border-white/20 text-white/70 hover:border-gold-accent'">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    <span class="truncate flex-1" x-text="files.length ? files.length + (files.length === 1 ? ' archivo seleccionado' : ' archivos seleccionados') : (uploaded ? uploaded + (uploaded === 1 ? ' archivo subido' : ' archivos subidos') : 'Seleccionar archivos (anverso y reverso)')">Seleccionar archivos (anverso y reverso)</span>
                                    <input type="file" wire:model="ines_arrendadores.{{ $index }}" class="hidden" accept=".pdf,.jpg,.jpeg,.png" multiple
                                           @change="files = Array.from($event.target.files); uploaded = 0">
                                </label>
                                <template x-if="files.length">
                                    <ul class="mt-2 space-y-1">
                                        <template x-for="file in files" :key="file.name">
                                            <li class="text-green-400 text-xs">
                                                <span x-text="file.name + ' · ' + (file.size / 1024 / 1024).toFixed(2) + ' MB'"></span>
                                            </li>
                                        </template>
                                    </ul>
                                </template>
                                @if(count($inesArrFiles) > 0)
                                    <ul x-show="!files.length" class="mt-2 space-y-1">
                                        @foreach($inesArrFiles as $uf)
                                            @if($uf && method_exists($uf, 'getClientOriginalName'))
                                                <li class="text-green-400 text-xs">{{ $uf->getClientOriginalName() }} · {{ round($uf->getSize() / 1024 / 1024, 2) }} MB</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                                <p class="text-white/40 text-xs mt-1">PDF, JPG o PNG — máx. 5 MB c/u</p>
                                @error("ines_arrendadores.{$index}.0")
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Paso 7: Información del Fiador -->
            @if ($currentStep === 7)
                <div class="space-y-6 animate-fadeIn">
                    <div class="mb-8">
                        <h3 class="text-2xl sm:text-3xl lg:text-4xl font-display font-bold mb-3" style="background: linear-gradient(135deg, #FFD700 0%, #FFAA00 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                            Información del Fiador
                        </h3>
                        <p class="text-white/70">Datos del garante o aval (si aplica)</p>
                    </div>

                    <div>
                        <label class="block text-white font-semibold mb-3">¿Requiere Fiador?</label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <label class="cursor-pointer group">
                                <input type="radio" wire:model.live="fiador_tipo" value="ninguno" class="hidden peer">
                                <div class="p-4 rounded-xl bg-white/5 border-2 border-white/20 peer-checked:border-gold-accent peer-checked:bg-gold-accent/10 transition-all text-center">
                                    <div class="text-3xl mb-2">🚫</div>
                                    <p class="text-white font-semibold">Sin Fiador</p>
                                </div>
                            </label>

                            <label class="cursor-pointer group">
                                <input type="radio" wire:model.live="fiador_tipo" value="persona" class="hidden peer">
                                <div class="p-4 rounded-xl bg-white/5 border-2 border-white/20 peer-checked:border-gold-accent peer-checked:bg-gold-accent/10 transition-all text-center">
                                    <div class="text-3xl mb-2">👤</div>
                                    <p class="text-white font-semibold">Persona Física</p>
                                </div>
                            </label>

                            <label class="cursor-pointer group">
                                <input type="radio" wire:model.live="fiador_tipo" value="empresa" class="hidden peer">
                                <div class="p-4 rounded-xl bg-white/5 border-2 border-white/20 peer-checked:border-gold-accent peer-checked:bg-gold-accent/10 transition-all text-center">
                                    <div class="text-3xl mb-2">🏢</div>
                                    <p class="text-white font-semibold">Persona Moral</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    @if($fiador_tipo !== 'ninguno')
                        <div class="space-y-4 mt-6 p-6 rounded-2xl bg-white/5 border border-white/20">
                            <h4 class="text-xl font-bold text-gold-accent mb-4">Datos del Fiador</h4>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-white font-semibold mb-2">Nombre *</label>
                                    <input 
                                        type="text" 
                                        wire:model="fiador_nombre"
                                        class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                        placeholder="Roberto">
                                    @error('fiador_nombre') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-white font-semibold mb-2">Apellido Paterno *</label>
                                    <input 
                                        type="text" 
                                        wire:model="fiador_apellido_paterno"
                                        class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                        placeholder="Sánchez">
                                    @error('fiador_apellido_paterno') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-white font-semibold mb-2">Apellido Materno</label>
                                    <input 
                                        type="text" 
                                        wire:model="fiador_apellido_materno"
                                        class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                        placeholder="Cruz">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-white font-semibold mb-2">Teléfono Principal *</label>
                                    <input 
                                        type="tel" 
                                        wire:model="fiador_telefono_1"
                                        class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                        placeholder="55 1234 5678">
                                    @error('fiador_telefono_1') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-white font-semibold mb-2">Teléfono Secundario</label>
                                    <input 
                                        type="tel" 
                                        wire:model="fiador_telefono_2"
                                        class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                        placeholder="55 8765 4321">
                                </div>
                            </div>

                            <div>
                                <label class="block text-white font-semibold mb-2">Correo Electrónico *</label>
                                <input 
                                    type="email" 
                                    wire:model="fiador_email"
                                    class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm"
                                    placeholder="fiador@ejemplo.com">
                                @error('fiador_email') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>

                            @if($fiador_tipo === 'empresa')
                                @include('formulario.persona-moral-fields', [
                                    'prefix' => 'fiador',
                                    'sep'    => '_',
                                    'actaModel' => 'fiador_acta_constitutiva',
                                    'poderesModel' => 'fiador_poderes_representante',
                                    'constanciaModel' => 'fiador_constancia_situacion_fiscal',
                                    'data' => [
                                        'no_acta_constitutiva' => $fiador_no_acta_constitutiva,
                                        'fecha_acta_constitutiva' => $fiador_fecha_acta_constitutiva,
                                        'fecha_registro_acta' => $fiador_fecha_registro_acta,
                                        'estado_inscrita' => $fiador_estado_inscrita,
                                        'nombre_notario' => $fiador_nombre_notario,
                                        'no_notario' => $fiador_no_notario,
                                        'estado_notario' => $fiador_estado_notario,
                                        'ciudad_notario' => $fiador_ciudad_notario,
                                        'folio_mercantil' => $fiador_folio_mercantil,
                                        'poder_en_acta' => $fiador_poder_en_acta,
                                    ],
                                ])
                            @endif

                            {{-- Comprobantes de ingresos (todos los tipos) --}}
                            @php
                                $comprFidArr = $comprobantes_fiador ?? [];
                                $comprFidFiles = is_array($comprFidArr) ? $comprFidArr : ($comprFidArr ? [$comprFidArr] : []);
                            @endphp
                            <div class="mt-4 pt-4 border-t border-white/20" x-data="{ files: [], uploaded: {{ count($comprFidFiles) }} }">
                                <label class="block text-white font-semibold mb-2 text-sm">
                                    Comprobantes de ingresos
                                    <span class="text-white/40 font-normal">(mínimo 3, opcional)</span>
                                </label>
                                <label class="flex items-center gap-2 w-full px-3 py-2 rounded-xl border cursor-pointer transition-all backdrop-blur-sm text-sm"
                                       :class="(files.length || uploaded) ? 'bg-green-500/10 border-green-400/50 text-green-300' : 'bg-white/10 border-white/20 text-white/70 hover:border-gold-accent'">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    <span class="truncate flex-1" x-text="files.length ? files.length + (files.length === 1 ? ' archivo seleccionado' : ' archivos seleccionados') : (uploaded ? uploaded + (uploaded === 1 ? ' archivo subido' : ' archivos subidos') : 'Seleccionar archivos (puede elegir varios)')">Seleccionar archivos (puede elegir varios)</span>
                                    <input type="file" wire:model="comprobantes_fiador" class="hidden" accept=".pdf,.jpg,.jpeg,.png" multiple
                                           @change="files = Array.from($event.target.files); uploaded = 0">
                                </label>
                                <template x-if="files.length">
                                    <ul class="mt-2 space-y-1">
                                        <template x-for="file in files" :key="file.name">
                                            <li class="text-green-400 text-xs">
                                                <span x-text="file.name + ' · ' + (file.size / 1024 / 1024).toFixed(2) + ' MB'"></span>
                                            </li>
                                        </template>
                                    </ul>
                                </template>
                                @if(count($comprFidFiles) > 0)
                                    <ul x-show="!files.length" class="mt-2 space-y-1">
                                        @foreach($comprFidFiles as $uf)
                                            @if($uf && method_exists($uf, 'getClientOriginalName'))
                                                <li class="text-green-400 text-xs">{{ $uf->getClientOriginalName() }} · {{ round($uf->getSize() / 1024 / 1024, 2) }} MB</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                                <p class="text-white/40 text-xs mt-1">Últimos 3 meses — PDF, JPG o PNG — máx. 5 MB c/u</p>
                                @error('comprobantes_fiador.*')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- INE (todos los tipos) --}}
                            @php
                                $ineFidArr = $ine_fiador ?? [];
                                $ineFidFiles = is_array($ineFidArr) ? $ineFidArr : ($ineFidArr ? [$ineFidArr] : []);
                            @endphp
                            <div class="mt-4 pt-4 border-t border-white/20" x-data="{ files: [], uploaded: {{ count($ineFidFiles) }} }">
                                <label class="block text-white font-semibold mb-2 text-sm">
                                    INE / Identificación oficial
                                    <span class="text-white/40 font-normal">(opcional, puede subir varios)</span>
                                </label>
                                <label class="flex items-center gap-2 w-full px-3 py-2 rounded-xl border cursor-pointer transition-all backdrop-blur-sm text-sm"
                                       :class="(files.length || uploaded) ? 'bg-green-500/10 border-green-400/50 text-green-300' : 'bg-white/10 border-white/20 text-white/70 hover:border-gold-accent'">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    <span class="truncate flex-1" x-text="files.length ? files.length + (files.length === 1 ? ' archivo seleccionado' : ' archivos seleccionados') : (uploaded ? uploaded + (uploaded === 1 ? ' archivo subido' : ' archivos subidos') : 'Seleccionar archivos (anverso y reverso)')">Seleccionar archivos (anverso y reverso)</span>
                                    <input type="file" wire:model="ine_fiador" class="hidden" accept=".pdf,.jpg,.jpeg,.png" multiple
                                           @change="files = Array.from($event.target.files); uploaded = 0">
                                </label>
                                <template x-if="files.length">
                                    <ul class="mt-2 space-y-1">
                                        <template x-for="file in files" :key="file.name">
                                            <li class="text-green-400 text-xs">
                                                <span x-text="file.name + ' · ' + (file.size / 1024 / 1024).toFixed(2) + ' MB'"></span>
                                            </li>
                                        </template>
                                    </ul>
                                </template>
                                @if(count($ineFidFiles) > 0)
                                    <ul x-show="!files.length" class="mt-2 space-y-1">
                                        @foreach($ineFidFiles as $uf)
                                            @if($uf && method_exists($uf, 'getClientOriginalName'))
                                                <li class="text-green-400 text-xs">{{ $uf->getClientOriginalName() }} · {{ round($uf->getSize() / 1024 / 1024, 2) }} MB</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                                <p class="text-white/40 text-xs mt-1">PDF, JPG o PNG — máx. 5 MB c/u</p>
                                @error('ine_fiador.*')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Paso 8: Complementos Adicionales -->
            @if ($currentStep === 8)
                <div class="space-y-6 animate-fadeIn">
                    <div class="mb-8">
                        <h3 class="text-2xl sm:text-3xl lg:text-4xl font-display font-bold mb-3" style="background: linear-gradient(135deg, #FFD700 0%, #FFAA00 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                            Complementos Adicionales
                        </h3>
                        <p class="text-white/70">Servicios y cláusulas opcionales para el contrato</p>
                    </div>

                    <div>
                        <label class="block text-white font-semibold mb-3">Complementos Opcionales</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach([
                                'inventario' => ['🏠', 'Inventario de Inmueble', 'Lista detallada de muebles y acabados'],
                                'poliza_seguro' => ['🛡️', 'Póliza de Seguro', 'Seguro de daños y responsabilidad civil'],
                                'clausula_mascotas' => ['🐕', 'Cláusula de Mascotas', 'Especifica condiciones para mascotas'],
                                'opcion_compra' => ['💰', 'Opción a Compra', 'Derecho de adquisición preferente'],
                                'renovacion_automatica' => ['🔄', 'Renovación Automática', 'Prorroga automática del contrato'],
                                'penalizacion_anticipada' => ['⚖️', 'Penalización por Término Anticipado', 'Cláusula de salida anticipada']
                            ] as $key => $data)
                                <label class="cursor-pointer group">
                                    <input type="checkbox" wire:model="complementos" value="{{ $key }}" class="hidden peer">
                                    <div class="p-4 rounded-xl bg-white/5 border-2 border-white/20 peer-checked:border-gold-accent peer-checked:bg-gold-accent/10 transition-all">
                                        <div class="flex items-start gap-3">
                                            <div class="text-3xl">{{ $data[0] }}</div>
                                            <div class="flex-1">
                                                <p class="text-white font-semibold">{{ $data[1] }}</p>
                                                <p class="text-white/60 text-sm mt-1">{{ $data[2] }}</p>
                                            </div>
                                            <div class="w-6 h-6 rounded-full border-2 border-white/30 peer-checked:border-gold-accent peer-checked:bg-gold-accent flex items-center justify-center">
                                                <svg class="w-4 h-4 text-white opacity-0 peer-checked:opacity-100" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="block text-white font-semibold mb-2">Observaciones Adicionales</label>
                        <textarea 
                            wire:model="observaciones"
                            rows="5"
                            class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm resize-none"
                            placeholder="Ingresa cualquier comentario, solicitud especial o cláusula adicional que desees incluir en el contrato..."></textarea>
                        <p class="text-white/50 text-sm mt-2">Este campo es opcional y nos ayudará a personalizar mejor tu contrato.</p>
                    </div>
                </div>
            @endif

            <!-- Paso 9: Confirmación y Términos -->
            @if ($currentStep === 9)
                <div class="space-y-6 animate-fadeIn">
                    <div class="mb-8 text-center">
                        <h3 class="text-2xl sm:text-3xl lg:text-4xl font-display font-bold mb-3" style="background: linear-gradient(135deg, #FFD700 0%, #FFAA00 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                            Confirmación Final
                        </h3>
                        <p class="text-white/70">Revisa y acepta los términos para generar tu contrato</p>
                    </div>

                    <!-- Resumen del contrato -->
                    <div class="p-6 rounded-2xl bg-gradient-to-br from-gold-accent/10 to-purple-deep/20 border border-gold-accent/30">
                        <h4 class="text-2xl font-bold text-gold-accent mb-4 flex items-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Resumen de tu Contrato
                        </h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-white">
                            <div class="p-4 rounded-xl bg-white/5">
                                <p class="text-white/60 text-sm">Producto</p>
                                <p class="font-semibold text-lg">{{ ucfirst($tipo_producto ?? 'No seleccionado') }}</p>
                            </div>
                            <div class="p-4 rounded-xl bg-white/5">
                                <p class="text-white/60 text-sm">Renta Mensual</p>
                                <p class="font-semibold text-lg">${{ number_format((float)($monto_renta_mensual ?? 0), 2) }}</p>
                            </div>
                            <div class="p-4 rounded-xl bg-white/5">
                                <p class="text-white/60 text-sm">Tramitante</p>
                                <p class="font-semibold">{{ $tramitante_nombre }} {{ $tramitante_apellido_paterno }}</p>
                            </div>
                            <div class="p-4 rounded-xl bg-white/5">
                                <p class="text-white/60 text-sm">Inmueble</p>
                                <p class="font-semibold">{{ $inmueble_calle ?? 'No especificado' }} #{{ $inmueble_numero_exterior ?? '' }}</p>
                            </div>
                            <div class="p-4 rounded-xl bg-white/5">
                                <p class="text-white/60 text-sm">Arrendatarios</p>
                                <p class="font-semibold">{{ count($arrendatarios) }} persona(s)</p>
                            </div>
                            <div class="p-4 rounded-xl bg-white/5">
                                <p class="text-white/60 text-sm">Arrendadores</p>
                                <p class="font-semibold">{{ count($arrendadores) }} persona(s)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Términos y condiciones -->
                    <div class="space-y-4">
                        <div class="p-6 rounded-2xl bg-white/5 border border-white/20">
                            <h5 class="text-xl font-bold text-white mb-4">Términos y Condiciones</h5>
                            <div class="max-h-60 overflow-y-auto space-y-3 text-white/80 text-sm pr-2">
                                <p>Al generar este contrato de arrendamiento, usted acepta que:</p>
                                <ul class="list-disc list-inside space-y-2 ml-4">
                                    <li>Toda la información proporcionada es verídica y exacta.</li>
                                    <li>El contrato generado tendrá validez legal conforme a la legislación vigente.</li>
                                    <li>Es responsable de verificar que todos los datos sean correctos antes de la firma.</li>
                                    <li>Poder Legal actúa únicamente como facilitador de la generación del documento.</li>
                                    <li>Se recomienda la revisión del contrato por un profesional legal antes de su firma.</li>
                                    <li>Los pagos y transacciones se realizan conforme a los términos acordados.</li>
                                </ul>
                            </div>
                        </div>

                        <label class="flex items-start space-x-3 cursor-pointer group p-4 rounded-xl bg-white/5 hover:bg-white/10 border-2 border-white/20 hover:border-gold-accent/50 transition-all">
                            <input 
                                type="checkbox" 
                                wire:model="acepto_terminos"
                                class="w-5 h-5 mt-1 rounded border-white/30 bg-white/10 text-gold-accent focus:ring-gold-accent/50">
                            <span class="text-white flex-1">
                                <span class="font-semibold">Acepto los términos y condiciones *</span>
                                <span class="block text-sm text-white/60 mt-1">He leído y acepto las condiciones para la generación del contrato de arrendamiento</span>
                            </span>
                        </label>
                        @error('acepto_terminos') <span class="text-red-400 text-sm ml-8">{{ $message }}</span> @enderror

                        <label class="flex items-start space-x-3 cursor-pointer group p-4 rounded-xl bg-white/5 hover:bg-white/10 border-2 border-white/20 hover:border-gold-accent/50 transition-all">
                            <input 
                                type="checkbox" 
                                wire:model="acepto_privacidad"
                                class="w-5 h-5 mt-1 rounded border-white/30 bg-white/10 text-gold-accent focus:ring-gold-accent/50">
                            <span class="text-white flex-1">
                                <span class="font-semibold">Acepto el aviso de privacidad *</span>
                                <span class="block text-sm text-white/60 mt-1">Autorizo el tratamiento de mis datos personales conforme al aviso de privacidad</span>
                            </span>
                        </label>
                        @error('acepto_privacidad') <span class="text-red-400 text-sm ml-8">{{ $message }}</span> @enderror
                    </div>

                    <!-- Mensaje de confirmación -->
                    <div class="text-center p-6 rounded-2xl bg-gradient-to-r from-green-500/10 to-green-600/10 border border-green-500/30">
                        <div class="text-5xl mb-3">✨</div>
                        <p class="text-white text-lg font-semibold mb-2">¡Estás listo para generar tu contrato!</p>
                        <p class="text-white/70 text-sm">Al hacer clic en "Generar Contrato", crearemos tu documento personalizado.</p>
                    </div>
                </div>
            @endif

            <!-- Navigation Buttons -->
            <div class="flex justify-between mt-8 sm:mt-10 md:mt-12 pt-6 sm:pt-8 border-t border-white/10">
                @if ($currentStep > 1)
                    <button 
                        type="button"
                        wire:click="previousStep"
                        class="group px-4 py-3 sm:px-6 sm:py-3.5 md:px-8 md:py-4 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-semibold transition-all duration-300 hover:scale-105 hover:shadow-xl backdrop-blur-sm text-sm sm:text-base">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            <span class="hidden xs:inline">Anterior</span>
                            <span class="xs:hidden">Atrás</span>
                        </span>
                    </button>
                @else
                    <div></div>
                @endif

                @if ($currentStep < $totalSteps)
                    <button 
                        type="button"
                        wire:click="nextStep"
                        class="group px-4 py-3 sm:px-6 sm:py-3.5 md:px-8 md:py-4 rounded-xl font-bold transition-all duration-300 hover:scale-105 hover:shadow-2xl text-sm sm:text-base"
                        style="background: linear-gradient(135deg, #FFD700 0%, #FFAA00 100%); color: #1A0933; box-shadow: 0 10px 30px rgba(255, 215, 0, 0.4);">
                        <span class="flex items-center gap-2">
                            Siguiente
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </button>
                @else
                    <button 
                        type="submit"
                        class="group px-4 py-3 sm:px-6 sm:py-3.5 md:px-8 md:py-4 rounded-xl font-bold transition-all duration-300 hover:scale-105 hover:shadow-2xl text-white text-sm sm:text-base"
                        style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="hidden xs:inline">Generar Contrato</span>
                            <span class="xs:hidden">Generar</span>
                        </span>
                    </button>
                @endif
            </div>
        </form>
    </div>
</div>
