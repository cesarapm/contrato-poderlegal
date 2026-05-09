@props([
    'name',
    'label' => null,
    'options' => [],
    'placeholder' => 'Selecciona una opción',
    'value' => '',
    'required' => false,
    'error' => null,
])

<div class="form-group">
    @if($label)
        <label for="{{ $name }}" class="{{ $required ? 'required' : '' }}">
            {{ $label }}
            @if($required)
                <span class="text-error">*</span>
            @endif
        </label>
    @endif
    
    <select 
        id="{{ $name }}"
        name="{{ $name }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->class([
            'input-error' => $error,
        ]) }}
    >
        @if($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
        
        @foreach($options as $optValue => $optLabel)
            <option 
                value="{{ $optValue }}" 
                {{ old($name, $value) == $optValue ? 'selected' : '' }}
            >
                {{ $optLabel }}
            </option>
        @endforeach
    </select>
    
    @if($error)
        <span class="error-message">{{ $error }}</span>
    @elseif($errors->has($name))
        <span class="error-message">{{ $errors->first($name) }}</span>
    @endif
</div>
