
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Genera tu contrato de arrendamiento en línea de forma rápida y segura. Sistema profesional con validación legal incluida. Poder Legal - Protección jurídica inmobiliaria en México.">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#4A148C">

    <title>Genera tu Contrato de Arrendamiento - Poder Legal</title>

    <!-- Favicons -->
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Genera tu Póliza de Arrendamiento - Poder Legal">
    <meta property="og:description" content="Sistema profesional para generar pólizas de arrendamiento en línea. 9 pasos simples, validación legal incluida.">
    <meta property="og:url" content="https://contrato.poderlegal.mx">
    <meta property="og:locale" content="es_MX">

    <!-- Fuentes Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen" style="background: linear-gradient(135deg, #1A0933 0%, #4A148C 50%, #663399 100%);">

    <!-- Header -->
    <header class="bg-white/10 backdrop-blur-md border-b border-white/20 sticky top-0 z-50">
        <div class="container mx-auto px-4 md:px-6 py-3 md:py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2 md:space-x-3">
                    <img src="/logo.webp" alt="Poder Legal Logo" class="w-9 h-9 md:w-12 md:h-12 rounded-xl shadow-gold" style="object-fit: contain; width: 36px; height: 36px; flex-shrink: 0;">
                    <h1 class="text-lg md:text-2xl font-display font-bold text-white leading-tight whitespace-nowrap">Poder Legal</h1>
                </div>
                <a href="/admin" class="px-5 py-2 md:px-8 md:py-3 bg-white/20 hover:bg-white/30 text-white rounded-xl border border-white/30 backdrop-blur-sm transition-all duration-300 text-sm md:text-base">
                    <span class="font-semibold">Acceso Admin</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="py-20">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-block px-6 py-2 bg-gold-accent/20 border border-gold-accent rounded-full mb-6">
                    <span class="text-gold-accent font-semibold">🎯 Proceso 100% Digital</span>
                </div>
                
               <h2 class="text-3xl md:text-6xl font-display font-bold text-white mb-6 leading-tight">
    Genera tu Póliza de Arrendamiento
</h2>
                
                <p class="text-xl text-white/80 mb-10 leading-relaxed">
                    Crea la solicitud profesional en minutos con nuestro asistente paso a paso.
                    <br class="hidden md:block">
                    Seguro, rápido y completamente legal.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                    <a href="#formulario" class="btn btn-primary-gradient btn-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Comenzar Ahora
                    </a>
                    <a href="#como-funciona" class="btn btn-outline-white btn-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        ¿Cómo funciona?
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 max-w-2xl mx-auto">
    
    <div class="card-gradient p-4 md:p-6 text-center">
        <div class="text-2xl md:text-3xl font-bold text-gold-accent mb-2">9</div>
        <div class="text-xs md:text-sm text-white/70">Pasos Simples</div>
    </div>

    <div class="card-gradient p-4 md:p-6 text-center">
        <div class="text-2xl md:text-3xl font-bold text-gold-accent mb-2">5 min</div>
        <div class="text-xs md:text-sm text-white/70">Tiempo Promedio</div>
    </div>

    <div class="card-gradient p-4 md:p-6 text-center">
        <div class="text-2xl md:text-3xl font-bold text-gold-accent mb-2">100%</div>
        <div class="text-xs md:text-sm text-white/70">Legal</div>
    </div>

</div>
            </div>
        </div>
    </section>

    <!-- Cómo Funciona -->
    <section id="como-funciona" class="py-20 bg-white/5 backdrop-blur-sm">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <h3 class="text-3xl font-display font-bold text-white text-center mb-12">
                    Proceso en 9 Pasos
                </h3>

                <div class="grid md:grid-cols-3 gap-6">
                    <div class="card-gradient p-6 hover-scale">
                        <div class="w-12 h-12 bg-gold-accent rounded-xl flex items-center justify-center mb-4">
                            <span class="text-2xl font-bold text-purple-deep">1-3</span>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-2">Datos Básicos</h4>
                        <p class="text-white/70">Información del tramitante, producto y tipo de contrato</p>
                    </div>

                    <div class="card-gradient p-6 hover-scale">
                        <div class="w-12 h-12 bg-gold-accent rounded-xl flex items-center justify-center mb-4">
                            <span class="text-2xl font-bold text-purple-deep">4-6</span>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-2">Partes Involucradas</h4>
                        <p class="text-white/70">Arrendatario, arrendador y datos del inmueble</p>
                    </div>

                    <div class="card-gradient p-6 hover-scale">
                        <div class="w-12 h-12 bg-gold-accent rounded-xl flex items-center justify-center mb-4">
                            <span class="text-2xl font-bold text-purple-deep">7-9</span>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-2">Finalizar</h4>
                        <p class="text-white/70">Fiador, términos legales y generación del contrato</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Formulario -->
    <section id="formulario" class="py-20">
      <div class="w-full md:container px-2 md:px-0">
            @livewire('contrato-wizard')
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-8 bg-white/5 backdrop-blur-sm border-t border-white/10">
        <div class="container mx-auto px-6">
            <div class="text-center text-white/60">
                <p>&copy; {{ date('Y') }} Poder Legal. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
