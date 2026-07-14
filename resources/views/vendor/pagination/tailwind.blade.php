@if ($paginator->hasPages())
    @php
        $current = $paginator->currentPage();
        $last = $paginator->lastPage();
        $window = 4;
        if ($current <= 4) {
            $start = 1;
            $end = min($last, $window);
        } else {
            $start = $current - 1;
            $end = min($last, $current + 2);
            if ($end - $start < $window - 1) {
                $start = max(1, $end - $window + 1);
            }
        }
        $showPrevDots = $start > 1;
        $showNextDots = $end < $last;
    @endphp

    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        <div class="flex items-center justify-center gap-1">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center justify-center w-9 h-9 text-sm font-medium text-sihati-stone rounded-md cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="inline-flex items-center justify-center w-9 h-9 text-sm font-medium text-sihati-slate bg-sihati-canvas border border-sihati-hairline-strong rounded-md hover:bg-sihati-surface transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </a>
            @endif

            {{-- Dots (left) --}}
            @if ($showPrevDots)
                <span class="inline-flex items-center justify-center w-9 h-9 text-sm font-medium text-sihati-stone">...</span>
            @endif

            {{-- Pages --}}
            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $current)
                    <span class="inline-flex items-center justify-center w-9 h-9 text-sm font-semibold text-sihati-on-primary bg-sihati-primary rounded-md">{{ $i }}</span>
                @else
                    <a href="{{ $paginator->url($i) }}" class="inline-flex items-center justify-center w-9 h-9 text-sm font-medium text-sihati-slate bg-sihati-canvas border border-sihati-hairline-strong rounded-md hover:bg-sihati-surface transition">{{ $i }}</a>
                @endif
            @endfor

            {{-- Dots (right) --}}
            @if ($showNextDots)
                <span class="inline-flex items-center justify-center w-9 h-9 text-sm font-medium text-sihati-stone">...</span>
            @endif

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="inline-flex items-center justify-center w-9 h-9 text-sm font-medium text-sihati-slate bg-sihati-canvas border border-sihati-hairline-strong rounded-md hover:bg-sihati-surface transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            @else
                <span class="inline-flex items-center justify-center w-9 h-9 text-sm font-medium text-sihati-stone rounded-md cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            @endif

        </div>
    </nav>
@endif
