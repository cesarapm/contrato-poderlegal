{{--
  Partial: Campos adicionales para Persona Moral (Acta Constitutiva + Poder + Documentos)

  Variables esperadas:
    $prefix          – prefijo del wire:model, p.ej. "arrendadores.0" o "fiador"
    $sep             – separador entre prefix y campo (por defecto ".", usar "_" para propiedades planas)
    $actaModel       – wire:model para el archivo del acta
    $poderesModel    – wire:model para los poderes del representante
    $constanciaModel – wire:model para la constancia de situación fiscal
    $data            – array con los valores actuales
--}}
@php $sep = $sep ?? '.'; @endphp

<div class="mt-4 space-y-4 pt-4 border-t border-white/20">
    {{-- Título sección --}}
    <h5 class="text-base font-bold text-white/80 uppercase tracking-wide">Acta Constitutiva</h5>

    {{-- Fila 1: No. acta | Fecha acta | Fecha registro | Estado inscrita | Copia (archivo) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <div>
            <label class="block text-white font-semibold mb-2 text-sm">No. de acta constitutiva</label>
            <input
                type="text"
                wire:model="{{ $prefix }}{{ $sep }}no_acta_constitutiva"
                class="w-full px-3 py-2 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm text-sm"
                placeholder="12345">
        </div>

        <div>
            <label class="block text-white font-semibold mb-2 text-sm">Fecha del acta constitutiva</label>
            <input
                type="date"
                wire:model="{{ $prefix }}{{ $sep }}fecha_acta_constitutiva"
                class="w-full px-3 py-2 rounded-xl bg-white/10 border border-white/20 text-white focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm text-sm">
        </div>

        <div>
            <label class="block text-white font-semibold mb-2 text-sm">Fecha de registro</label>
            <input
                type="date"
                wire:model="{{ $prefix }}{{ $sep }}fecha_registro_acta"
                class="w-full px-3 py-2 rounded-xl bg-white/10 border border-white/20 text-white focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm text-sm">
        </div>

        <div>
            <label class="block text-white font-semibold mb-2 text-sm">Estado donde está inscrita</label>
            <input
                type="text"
                wire:model="{{ $prefix }}{{ $sep }}estado_inscrita"
                class="w-full px-3 py-2 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm text-sm"
                placeholder="Ciudad de México">
        </div>

        <div>
            <label class="block text-white font-semibold mb-2 text-sm">
                Copia del acta constitutiva
                <span class="text-white/40 font-normal">(opcional)</span>
            </label>
            <div x-data="{ file: null }">
                <label class="flex items-center gap-2 w-full px-3 py-2 rounded-xl border cursor-pointer transition-all backdrop-blur-sm text-sm"
                       :class="file ? 'bg-green-500/10 border-green-400/50 text-green-300' : 'bg-white/10 border-white/20 text-white/70 hover:border-gold-accent'">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    <span class="truncate flex-1" x-text="file ? file.name + ' · ' + (file.size / 1024 / 1024).toFixed(2) + ' MB' : 'Subir archivo'">Subir archivo</span>
                    <input type="file" wire:model="{{ $actaModel }}" class="hidden" accept=".pdf,.jpg,.jpeg,.png"
                           @change="file = $event.target.files[0] ?? null">
                </label>
                @error($actaModel) <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    {{-- Fila 2: Notario --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="lg:col-span-2">
            <label class="block text-white font-semibold mb-2 text-sm">Nombre completo del notario público</label>
            <input
                type="text"
                wire:model="{{ $prefix }}{{ $sep }}nombre_notario"
                class="w-full px-3 py-2 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm text-sm"
                placeholder="Lic. Juan Pérez García">
        </div>

        <div>
            <label class="block text-white font-semibold mb-2 text-sm">No. de notario</label>
            <input
                type="text"
                wire:model="{{ $prefix }}{{ $sep }}no_notario"
                class="w-full px-3 py-2 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm text-sm"
                placeholder="42">
        </div>

        <div>
            <label class="block text-white font-semibold mb-2 text-sm">Estado del notario</label>
            <input
                type="text"
                wire:model="{{ $prefix }}{{ $sep }}estado_notario"
                class="w-full px-3 py-2 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm text-sm"
                placeholder="Ciudad de México">
        </div>

        <div>
            <label class="block text-white font-semibold mb-2 text-sm">Ciudad del notario</label>
            <input
                type="text"
                wire:model="{{ $prefix }}{{ $sep }}ciudad_notario"
                class="w-full px-3 py-2 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm text-sm"
                placeholder="CDMX">
        </div>
    </div>

    {{-- Folio mercantil --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <div>
            <label class="block text-white font-semibold mb-2 text-sm">Datos registro (folio mercantil)</label>
            <input
                type="text"
                wire:model="{{ $prefix }}{{ $sep }}folio_mercantil"
                class="w-full px-3 py-2 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:border-gold-accent focus:ring-2 focus:ring-gold-accent/50 transition-all backdrop-blur-sm text-sm"
                placeholder="12345-ABC">
        </div>
    </div>

    {{-- Poder --}}
    <div class="pt-3 border-t border-white/20">
        <h5 class="text-base font-bold text-white/80 uppercase tracking-wide mb-3">Poder</h5>
        <p class="text-white/80 text-sm mb-3">¿El poder del representante está otorgado en el acta constitutiva?</p>
        <div class="flex items-center gap-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input
                    type="radio"
                    wire:model="{{ $prefix }}{{ $sep }}poder_en_acta"
                    value="1"
                    class="w-5 h-5 text-gold-accent border-white/30 bg-white/10 focus:ring-gold-accent/50">
                <span class="text-white font-semibold">Sí</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input
                    type="radio"
                    wire:model="{{ $prefix }}{{ $sep }}poder_en_acta"
                    value="0"
                    class="w-5 h-5 text-gold-accent border-white/30 bg-white/10 focus:ring-gold-accent/50">
                <span class="text-white font-semibold">No</span>
            </label>
        </div>
    </div>

    {{-- Documentos adicionales persona moral --}}
    <div class="pt-3 border-t border-white/20">
        <h5 class="text-base font-bold text-white/80 uppercase tracking-wide mb-3">Documentos adicionales</h5>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-white font-semibold mb-2 text-sm">
                    Poderes del representante legal
                    <span class="text-white/40 font-normal">(opcional)</span>
                </label>
                <div x-data="{ file: null }">
                    <label class="flex items-center gap-2 w-full px-3 py-2 rounded-xl border cursor-pointer transition-all backdrop-blur-sm text-sm"
                           :class="file ? 'bg-green-500/10 border-green-400/50 text-green-300' : 'bg-white/10 border-white/20 text-white/70 hover:border-gold-accent'">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        <span class="truncate flex-1" x-text="file ? file.name + ' · ' + (file.size / 1024 / 1024).toFixed(2) + ' MB' : 'Subir archivo'">Subir archivo</span>
                        <input type="file" wire:model="{{ $poderesModel }}" class="hidden" accept=".pdf,.jpg,.jpeg,.png"
                               @change="file = $event.target.files[0] ?? null">
                    </label>
                    @error($poderesModel) <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="block text-white font-semibold mb-2 text-sm">
                    Constancia de situación fiscal
                    <span class="text-white/40 font-normal">(opcional)</span>
                </label>
                <div x-data="{ file: null }">
                    <label class="flex items-center gap-2 w-full px-3 py-2 rounded-xl border cursor-pointer transition-all backdrop-blur-sm text-sm"
                           :class="file ? 'bg-green-500/10 border-green-400/50 text-green-300' : 'bg-white/10 border-white/20 text-white/70 hover:border-gold-accent'">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        <span class="truncate flex-1" x-text="file ? file.name + ' · ' + (file.size / 1024 / 1024).toFixed(2) + ' MB' : 'Subir archivo'">Subir archivo</span>
                        <input type="file" wire:model="{{ $constanciaModel }}" class="hidden" accept=".pdf,.jpg,.jpeg,.png"
                               @change="file = $event.target.files[0] ?? null">
                    </label>
                    @error($constanciaModel) <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>
</div>
