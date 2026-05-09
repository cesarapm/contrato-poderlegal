@props([
    'steps' => [],
    'currentStep' => 1,
])

<div class="wizard-steps mb-8">
    @foreach($steps as $index => $step)
        @php
            $stepNumber = $index + 1;
            $isActive = $currentStep === $stepNumber;
            $isCompleted = $currentStep > $stepNumber;
        @endphp
        
        <div class="wizard-step {{ $isActive ? 'active' : '' }} {{ $isCompleted ? 'completed' : '' }}">
            <div class="wizard-step-circle">
                @if($isCompleted)
                    <!-- Checkmark icon -->
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                @else
                    {{ $stepNumber }}
                @endif
            </div>
            
            <span class="wizard-step-label">{{ $step }}</span>
        </div>
        
        @if($stepNumber < count($steps))
            <div class="wizard-line {{ $isCompleted ? 'completed' : '' }}"></div>
        @endif
    @endforeach
</div>
