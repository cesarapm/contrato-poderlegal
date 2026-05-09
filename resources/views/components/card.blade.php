@props([
    'variant' => 'default',
    'hover' => true,
])

@php
    $baseClasses = 'card';
    $variantClasses = match($variant) {
        'gradient' => 'card-gradient',
        'gold' => 'card-gold',
        default => '',
    };
    $hoverClasses = !$hover ? 'hover:transform-none' : '';
    
    $classes = trim("$baseClasses $variantClasses $hoverClasses");
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
