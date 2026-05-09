@props([
    'show' => false,
])

@if($show)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="loading-spinner"></div>
    </div>
@endif
