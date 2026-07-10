@props([
    'id' => 'modal',
    'title' => '',
    'size' => 'md',
    'showClose' => true,
    'scrollable' => false,
])

@php
    $sizeClasses = match($size) {
        'sm' => 'max-w-sm',
        'md' => 'max-w-lg',
        'lg' => 'max-w-2xl',
        'xl' => 'max-w-4xl',
        '2xl' => 'max-w-5xl',
        'full' => 'max-w-full mx-4',
        default => 'max-w-lg'
    };
    $modalClasses = $scrollable
        ? 'relative bg-white rounded-xl shadow-xl w-full animate-slide-in flex flex-col max-h-[calc(100vh-2rem)]'
        : 'relative bg-white rounded-xl shadow-xl w-full animate-slide-in';
@endphp

<div id="{{ $id }}-backdrop" class="fixed inset-0 z-[60] hidden bg-black/50"
     onclick="this.classList.add('hidden');document.body.style.overflow=''">
    <div class="flex items-center justify-center min-h-full p-4">
        <div id="{{ $id }}" class="{{ $modalClasses }} {{ $sizeClasses }}" onclick="event.stopPropagation()">
            @if($title || $showClose)
            <div class="flex items-center justify-between px-6 py-4 border-b border-hairline {{ $scrollable ? 'flex-shrink-0' : '' }}">
                @if($title)
                <h3 class="text-lg font-semibold text-text-ink">{{ $title }}</h3>
                @endif
                @if($showClose)
                <button type="button" class="p-2 text-text-muted hover:text-text-ink hover:bg-surface rounded-lg"
                    onclick="document.getElementById('{{ $id }}-backdrop').classList.add('hidden');document.body.style.overflow=''">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                @endif
            </div>
            @endif
            
            <div class="{{ $scrollable ? 'overflow-y-auto flex-1 px-6 py-5' : 'px-6 py-4' }}">
                {{ $slot }}
            </div>
            
            @if(isset($footer))
            <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-hairline {{ $scrollable ? 'bg-white rounded-b-xl flex-shrink-0' : 'bg-surface-soft rounded-b-xl' }}">
                {{ $footer }}
            </div>
            @endif
        </div>
    </div>
</div>
