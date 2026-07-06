@props([
    'variant' => 'default',
    'size' => 'md',
])

@php
    $baseClasses = 'inline-flex items-center font-medium rounded-full';
    
    $sizeClasses = match($size) {
        'sm' => 'px-2 py-0.5 text-xs',
        'md' => 'px-2.5 py-1 text-xs',
        'lg' => 'px-3 py-1.5 text-sm',
        default => 'px-2.5 py-1 text-xs'
    };
    
    $variantClasses = match($variant) {
        'primary' => 'bg-primary-soft text-primary-dark',
        'secondary' => 'bg-surface text-text-ink',
        'success' => 'bg-success-soft text-green-800',
        'warning' => 'bg-warning-soft text-yellow-800',
        'danger' => 'bg-error-soft text-red-800',
        'info' => 'bg-blue-50 text-blue-800',
        'baru' => 'bg-pastel-blue text-blue-800',
        'diterima' => 'bg-cyan-100 text-cyan-800',
        'diproses' => 'bg-warning-soft text-yellow-800',
        'menunggu-konfirmasi' => 'bg-pastel-indigo text-indigo-800',
        'selesai' => 'bg-success-soft text-green-800',
        'ditolak' => 'bg-error-soft text-red-800',
        'dibatalkan' => 'bg-gray-100 text-gray-800',
        'rendah' => 'bg-success-soft text-green-800',
        'sedang' => 'bg-warning-soft text-yellow-800',
        'tinggi' => 'bg-pastel-orange text-orange-800',
        'mendesak' => 'bg-error-soft text-red-800',
        default => 'bg-surface text-text-ink'
    };
@endphp

<span {{ $attributes->merge(['class' => "$baseClasses $sizeClasses $variantClasses"]) }}>
    {{ $slot }}
</span>
