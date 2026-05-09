@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'default',
    'block' => false,
    'icon' => null,
])

@php
    $baseClasses = 'btn';
    $variantClasses = match($variant) {
        'primary' => 'btn-primary',
        'secondary' => 'btn-secondary',
        'outline-primary' => 'btn-outline-primary',
        'outline-white' => 'btn-outline-white',
        default => 'btn-primary',
    };
    $sizeClasses = match($size) {
        'small' => 'btn-small',
        'large' => 'btn-large',
        'xl' => 'btn-xl',
        default => '',
    };
    $blockClasses = $block ? 'btn-block' : '';
    
    $classes = trim("$baseClasses $variantClasses $sizeClasses $blockClasses");
@endphp

<button 
    type="{{ $type }}"
    {{ $attributes->merge(['class' => $classes]) }}
>
    @if($icon)
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
        </svg>
    @endif
    {{ $slot }}
</button>
