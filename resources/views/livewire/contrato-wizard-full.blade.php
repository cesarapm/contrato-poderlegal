<div class="max-w-6xl mx-auto">
    <!-- Progress Steps -->
    <div class="mb-12">
        <div class="grid grid-cols-9 gap-2 mb-4">
            @for ($i = 1; $i <= $totalSteps; $i++)
                <div class="relative">
                    <button 
                        type="button"
                        wire:click="goToStep({{ $i }})"
                        class="w-full aspect-square rounded-2xl font-bold text-lg transition-all duration-300 shadow-xl
                            {{ $currentStep == $i ? 'bg-gradient-to-br from-gold-accent to-gold-warm text-purple-deep scale-110 shadow-2xl shadow-gold-accent/50' : '' }}
                            {{ $currentStep > $i ? 'bg-gradient-to-br from-primary-purple to-purple-bishop text-white' : '' }}
                            {{ $currentStep < $i ? 'bg-white/10 backdrop-blur-sm text-white/40 border border-white/20' : '' }}
                            hover:scale-105 hover:shadow-2xl">
                        {{ $i }}
                    </button>
                </div>
            @endfor
        </div>
        <div class="text-center">
            <p class="text-gold-accent font-bold text-lg">Paso {{ $currentStep }} de {{ $totalSteps }}</p>
            <p class="text-white/60 text-sm mt-1">
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
    <div class="relative backdrop-blur-xl bg-gradient-to-br from-white/10 to-white/5 rounded-3xl p-8 md:p-12 shadow-2xl border border-white/20">
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
                <div class="space-y-6 animate-fadeIn">
                    <div class="mb-8">
                        <h3 class="text-4xl font-display font-bold text-transparent bg-clip-text bg-gradient-to-r from-gold-accent to-gold-warm mb-3">
                            Datos del Tramitante
                        </h3>
                        <p class="text-white/70">Ingresa la información de quien solicita el contrato</p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-6">
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

                    <div class="grid md:grid-cols-2 gap-6">
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
                            <option value="asesor">Asesor</option>
                            <option value="propietario">Propietario</option>
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
                        <h3 class="text-4xl font-display font-bold text-transparent bg-clip-text bg-gradient-to-r from-gold-accent to-gold-warm mb-3">
                            Selecciona tu Producto
                        </h3>
                        <p class="text-white/70">Elige el paquete que mejor se adapte a tus necesidades</p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-6">
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

            <!-- Resto de pasos (3-9) con el mismo estilo mejorado... -->
            @if ($currentStep > 2)
                <div class="text-center text-white py-12">
                    <p class="text-xl mb-4">✨ Paso {{ $currentStep }} próximamente</p>
                    <p class="text-white/60">Navegación funcionando correctamente</p>
                </div>
            @endif

            <!-- Navigation Buttons -->
            <div class="flex justify-between mt-12 pt-8 border-t border-white/10">
                @if ($currentStep > 1)
                    <button 
                        type="button"
                        wire:click="previousStep"
                        class="group px-8 py-4 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-semibold transition-all duration-300 hover:scale-105 hover:shadow-xl backdrop-blur-sm">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Anterior
                        </span>
                    </button>
                @else
                    <div></div>
                @endif

                @if ($currentStep < $totalSteps)
                    <button 
                        type="button"
                        wire:click="nextStep"
                        class="group px-8 py-4 rounded-xl bg-gradient-to-r from-gold-accent to-gold-warm text-purple-deep font-bold transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-gold-accent/50">
                        <span class="flex items-center gap-2">
                            Siguiente
                            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </button>
                @else
                    <button 
                        type="submit"
                        class="group px-8 py-4 rounded-xl bg-gradient-to-r from-green-500 to-green-600 text-white font-bold transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-green-500/50">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Generar Contrato
                        </span>
                    </button>
                @endif
            </div>
        </form>
    </div>
</div>

<style>
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fadeIn {
    animation: fadeIn 0.4s ease-out;
}

.hover-scale:hover {
    transform: scale(1.02);
}

input:focus, select:focus, textarea:focus {
    outline: none;
}
</style>
