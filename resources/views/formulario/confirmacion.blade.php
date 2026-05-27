@extends('layouts.app')

@section('title', 'Confirmación de Contrato')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8" style="background: linear-gradient(135deg, #1A0933 0%, #4A148C 50%, #1A0933 100%);">
    <div class="max-w-4xl mx-auto">
        <!-- Animación de Éxito -->
        <div class="text-center mb-8 animate-fadeIn">
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gradient-to-br from-gold-accent to-gold-warm shadow-gold mb-6 animate-bounce">
                <svg class="w-12 h-12 text-purple-deep" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-display font-bold mb-4" style="background: linear-gradient(135deg, #FFD700 0%, #FFAA00 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                ¡Solicitud Creada Exitosamente!
            </h1>
            
            <p class="text-lg sm:text-xl lg:text-2xl text-white/80 mb-2">
                Tu Solicitud ha sido generada
            </p>
            
            <div class="inline-block px-8 py-4 rounded-2xl bg-white/10 border-2 border-gold-accent backdrop-blur-lg">
                <p class="text-sm text-white/60 mb-1">Número de Folio</p>
                <p class="text-2xl sm:text-3xl font-bold text-gold-accent tracking-wider">
                    {{ $contrato->folio }}
                </p>
            </div>
        </div>

        <!-- Información del Contrato -->
        <div class="bg-white/10 backdrop-blur-xl rounded-3xl border border-white/20 shadow-2xl p-8 mb-8">
            <h2 class="text-xl sm:text-2xl font-bold text-white mb-6 flex items-center">
                <svg class="w-8 h-8 mr-3 text-gold-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Detalles de la Solicitud
            </h2>

            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gold-accent/20 flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-gold-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-white/60">Tramitante</p>
                            <p class="text-lg font-semibold text-white">{{ $contrato->tramitante->nombre ?? 'Usuario' }} {{ $contrato->tramitante->apellido_paterno ?? '' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gold-accent/20 flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-gold-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-white/60">Renta Mensual</p>
                            <p class="text-lg font-semibold text-white">${{ number_format($contrato->monto_renta_mensual, 2) }} MXN</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gold-accent/20 flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-gold-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-white/60">Fecha de Creación</p>
                            <p class="text-lg font-semibold text-white">{{ $contrato->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gold-accent/20 flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-gold-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-white/60">Estado</p>
                            <p class="text-lg font-semibold text-gold-accent">{{ ucfirst($contrato->estado) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Próximos Pasos -->
        <div class="bg-gradient-to-br from-purple-bishop/40 to-purple-deep/40 backdrop-blur-xl rounded-3xl border border-white/20 shadow-2xl p-8 mb-8">
            <h2 class="text-xl sm:text-2xl font-bold text-white mb-6 flex items-center">
                <svg class="w-8 h-8 mr-3 text-gold-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                Próximos Pasos
            </h2>

            <div class="space-y-4">
                <div class="flex items-start p-4 rounded-xl bg-white/5 border border-white/10">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gold-accent flex items-center justify-center text-purple-deep font-bold mr-4">
                        1
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-1">Revisión de la Solicitud</h3>
                        <p class="text-white/70">Nuestro equipo revisará la información proporcionada para generar tu contrato.</p>
                    </div>
                </div>

                <div class="flex items-start p-4 rounded-xl bg-white/5 border border-white/10">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gold-accent flex items-center justify-center text-purple-deep font-bold mr-4">
                        2
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-1">Notificación por Email</h3>
                        <p class="text-white/70">Recibirás un correo electrónico con el enlace para descargar tu contrato en PDF.</p>
                    </div>
                </div>

                <div class="flex items-start p-4 rounded-xl bg-white/5 border border-white/10">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gold-accent flex items-center justify-center text-purple-deep font-bold mr-4">
                        3
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-1">Firma del Contrato</h3>
                        <p class="text-white/70">Procede con las firmas de todas las partes involucradas en el contrato.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/" class="btn btn-primary-gradient px-8 py-4 rounded-xl text-center">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Crear Nueva Solicitud
            </a>

            <!-- @auth
            <a href="/admin/contratos" class="px-8 py-4 rounded-xl bg-white/10 hover:bg-white/20 border-2 border-white/30 text-white font-semibold transition-all text-center">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Ver Panel Admin
            </a>
            @endauth -->
        </div>

        <!-- Nota de Ayuda -->
        <div class="mt-8 text-center">
            <p class="text-white/60 text-sm">
                ¿Necesitas ayuda? Contáctanos en 
                <a href="mailto:contacto@poderlegal.mx" class="text-gold-accent hover:text-gold-warm transition-colors">
                    contacto@poderlegal.mx
                </a>
            </p>
        </div>
    </div>
</div>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.animate-fadeIn {
    animation: fadeIn 0.6s ease-out;
}

.animate-bounce {
    animation: bounce 2s infinite;
}
</style>
@endsection
