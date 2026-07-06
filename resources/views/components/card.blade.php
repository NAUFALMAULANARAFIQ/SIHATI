@props([
    'title' => '',
    'subtitle' => '',
    'padding' => true,
    'shadow' => true,
    'hover' => false,
])

@php
    $baseClasses = 'bg-white rounded-xl border border-hairline';
    $paddingClasses = $padding ? 'p-4 md:p-6' : '';
    $shadowClasses = $shadow ? 'shadow-lg' : '';
    $hoverClasses = $hover ? 'card-hover' : '';
@endphp

<div {{ $attributes->merge(['class' => "$baseClasses $paddingClasses $shadowClasses $hoverClasses"]) }}>
    @if($title)
    <div class="mb-4">
        <h3 class="text-lg font-semibold text-text-ink">{{ $title }}</h3>
        @if($subtitle)
        <p class="text-sm text-text-muted mt-1">{{ $subtitle }}</p>
        @endif
    </div>
    @endif
    
    {{ $slot }}
</div>
