@props([
    'variant' => 'primary',
    'type' => 'button',
    'disabled' => false,
    'size' => 'md',
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-lg gap-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2';
    
    $sizeClasses = match($size) {
        'sm' => 'px-3 py-1.5 text-sm h-9',
        'md' => 'px-4 py-2 text-sm h-10',
        'lg' => 'px-6 py-3 text-base h-11',
        default => 'px-4 py-2 text-sm h-10'
    };
    
    $variantClasses = match($variant) {
        'primary' => 'bg-primary text-white hover:bg-primary-dark focus:ring-primary disabled:bg-primary/50 shadow-lg shadow-primary/20 hover:shadow-primary/30',
        'secondary' => 'bg-surface text-text-ink hover:bg-hairline focus:ring-primary disabled:bg-surface/50 border border-hairline',
        'dark' => 'bg-navy text-white hover:bg-navy-deep focus:ring-navy disabled:bg-navy/50 shadow-lg shadow-navy/20',
        'warning' => 'bg-warning text-white hover:bg-warning/80 focus:ring-warning disabled:bg-warning/50 shadow-lg shadow-warning/20',
        'danger' => 'bg-error text-white hover:bg-error/80 focus:ring-error disabled:bg-error/50 shadow-lg shadow-error/20',
        'ghost' => 'bg-transparent text-text-ink hover:bg-surface focus:ring-primary disabled:text-text-muted',
        'link' => 'bg-transparent text-primary hover:text-primary-dark hover:underline focus:ring-primary p-0',
        default => 'bg-primary text-white hover:bg-primary-dark focus:ring-primary shadow-lg shadow-primary/20'
    };
    
    $disabledClasses = $disabled ? 'cursor-not-allowed opacity-60' : '';
@endphp

<button {{ $attributes->merge(['type' => $type, 'disabled' => $disabled, 'class' => "$baseClasses $sizeClasses $variantClasses $disabledClasses"]) }}>
    {{ $slot }}
</button>
