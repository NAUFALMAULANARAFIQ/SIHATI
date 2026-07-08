@props(['aduan' => null, 'statusKey' => ''])

@php $userRating = $aduan?->ratings->firstWhere('user_id', auth()->id()); @endphp

<div {{ $attributes->merge(['class' => 'flex flex-wrap gap-2']) }}>
    @if(auth()->user()?->role === 'pegawai')
        @if($statusKey === 'selesai')
            @if($userRating)
            <div class="inline-flex items-center gap-2 rounded-md border border-sihati-hairline bg-sihati-surface px-4 py-2">
                <span class="text-xs text-sihati-slate">Rating Anda</span>
                <div class="flex items-center gap-0.5">
                    @for ($i = 1; $i <= 5; $i++)
                    <svg class="h-4 w-4 {{ $i <= $userRating->rating ? 'text-sihati-yellow-bold' : 'text-sihati-hairline-strong' }}" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                    @endfor
                </div>
                <span class="text-sm font-medium text-sihati-charcoal">{{ $userRating->rating }}/5</span>
            </div>
            @else
            <button type="button" onclick="openModal('ratingModal')"
                class="inline-flex h-10 items-center gap-1.5 rounded-md bg-sihati-yellow-bold px-4 text-sm font-medium text-sihati-charcoal transition hover:bg-sihati-yellow">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
                Beri Rating
            </button>
            @endif
        @endif
        @if($statusKey === 'diproses' || $statusKey === 'diterima')
            <span class="inline-flex h-10 items-center gap-1.5 rounded-md bg-sihati-sky px-4 text-sm font-medium text-sihati-link-pressed">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Menunggu Diproses
            </span>
        @endif
    @endif
</div>
