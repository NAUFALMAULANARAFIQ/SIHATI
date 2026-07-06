@props([
    'type' => 'text',
    'label' => '',
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'help' => '',
    'error' => '',
    'required' => false,
    'disabled' => false,
])

@php
    $inputId = $name ?: 'input_' . md5(mt_rand());
    $hasError = !empty($error);
@endphp

<div class="w-full">
    @if($label)
    <label for="{{ $inputId }}" class="block text-sm font-medium text-text-ink mb-1.5">
        {{ $label }}
        @if($required)
        <span class="text-error">*</span>
        @endif
    </label>
    @endif
    
    <div class="relative">
        @if($type === 'textarea')
        <textarea 
            id="{{ $inputId }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            rows="4"
            {{ $attributes->merge(['class' => 'w-full px-4 py-2.5 bg-white border rounded-lg text-sm text-text-ink placeholder-text-muted focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary disabled:bg-surface disabled:cursor-not-allowed ' . ($hasError ? 'border-error focus:ring-error focus:border-error' : 'border-hairline')]) }}
        >{{ $value }}</textarea>
        @elseif($type === 'select')
        <select 
            id="{{ $inputId }}"
            name="{{ $name }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $attributes->merge(['class' => 'w-full px-4 py-2.5 bg-white border rounded-lg text-sm text-text-ink focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary disabled:bg-surface disabled:cursor-not-allowed ' . ($hasError ? 'border-error focus:ring-error focus:border-error' : 'border-hairline')]) }}
        >
            {{ $slot }}
        </select>
        @else
        <input 
            type="{{ $type }}"
            id="{{ $inputId }}"
            name="{{ $name }}"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $attributes->merge(['class' => 'w-full px-4 py-2.5 bg-white border rounded-lg text-sm text-text-ink placeholder-text-muted focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary disabled:bg-surface disabled:cursor-not-allowed ' . ($hasError ? 'border-error focus:ring-error focus:border-error' : 'border-hairline')]) }}
        >
        @endif
    </div>
    
    @if($help && !$hasError)
    <p class="mt-1.5 text-xs text-text-muted">{{ $help }}</p>
    @endif
    
    @if($hasError)
    <p class="mt-1.5 text-xs text-error">{{ $error }}</p>
    @endif
</div>
