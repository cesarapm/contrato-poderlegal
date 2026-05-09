@props([
    'name',
    'label' => null,
    'placeholder' => '',
    'rows' => 4,
    'value' => '',
    'required' => false,
    'error' => null,
    'maxlength' => null,
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
    
    <textarea 
        id="{{ $name }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        rows="{{ $rows }}"
        {{ $required ? 'required' : '' }}
        {{ $maxlength ? "maxlength={$maxlength}" : '' }}
        {{ $attributes->class([
            'input-error' => $error,
        ]) }}
    >{{ old($name, $value) }}</textarea>
    
    @if($maxlength)
        <div class="text-xs text-gray-500 mt-1 text-right">
            <span id="{{ $name }}-count">0</span> / {{ $maxlength }} caracteres
        </div>
        <script>
            document.getElementById('{{ $name }}').addEventListener('input', function(e) {
                document.getElementById('{{ $name }}-count').textContent = e.target.value.length;
            });
            // Initialize count
            document.getElementById('{{ $name }}-count').textContent = document.getElementById('{{ $name }}').value.length;
        </script>
    @endif
    
    @if($error)
        <span class="error-message">{{ $error }}</span>
    @elseif($errors->has($name))
        <span class="error-message">{{ $errors->first($name) }}</span>
    @endif
</div>
