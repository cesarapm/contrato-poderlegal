<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Sistema administrativo de contratos de arrendamiento. Poder Legal - Protección jurídica inmobiliaria y pólizas de arrendamiento en México.">
    <meta name="keywords" content="administración contratos, gestión arrendamiento, póliza jurídica, protección inmobiliaria, derecho inmobiliario México">
    <meta name="author" content="Poder Legal">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#4A148C">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <title>{{ config('app.name', 'Poder Legal') }} - @yield('title', 'Contratos de Arrendamiento')</title>

    <!-- Favicons -->
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://contrato.poderlegal.com{{ request()->getPathInfo() }}">

    <!-- Fuentes Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    @stack('styles')
</head>
<body class="antialiased">
    <!-- Header/Nav -->
    <nav class="bg-gradient-secondary text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-14 sm:h-16">
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <img src="/logo.webp" alt="Poder Legal Logo" class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl" style="object-fit: contain;">
                    <h1 class="font-display text-lg sm:text-xl md:text-2xl font-bold" style="background: linear-gradient(135deg, #FFD700 0%, #FFAA00 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                        Poder Legal
                    </h1>
                </div>
                
                <div class="flex items-center space-x-4">
                    <!-- Autenticación deshabilitada para formulario público -->
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen bg-light">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-purple-deep text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm">
                &copy; {{ date('Y') }} Poder Legal. Todos los derechos reservados.
            </p>
            <p class="text-xs mt-2 opacity-75">
                Protección jurídica inmobiliaria de confianza
            </p>
        </div>
    </footer>

    @livewireScripts
    @stack('scripts')
</body>
</html>
