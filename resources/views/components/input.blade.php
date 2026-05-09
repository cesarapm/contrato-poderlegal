@props([
    'type' => 'text',
    'name',
    'label' => null,
    'placeholder' => '',
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
    
    <input 
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->class([
            'input-error' => $error,
        ]) }}
    >
    
    @if($error)
        <span class="error-message">{{ $error }}</span>
    @elseif($errors->has($name))
        <span class="error-message">{{ $errors->first($name) }}</span>
    @endif
</div>
