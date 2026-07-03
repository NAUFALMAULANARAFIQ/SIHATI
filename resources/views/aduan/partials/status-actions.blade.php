@props(['aduan' => null, 'statusKey' => ''])

<div {{ $attributes->merge(['class' => 'flex flex-wrap gap-2']) }}>
    {{-- Admin Actions --}}
    @if(auth()->user()?->role === 'admin')
        @if($statusKey === 'diterima')
            <button type="button" onclick="openModal('updateStatusModal')"
                class="inline-flex h-10 items-center gap-1.5 rounded-md bg-sihati-primary px-4 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Terima & Proses
            </button>
        @endif
        @if($statusKey === 'diproses')
            <button type="button" onclick="openModal('updateStatusModal')"
                class="inline-flex h-10 items-center gap-1.5 rounded-md bg-sihati-mint px-4 text-sm font-medium text-sihati-success transition hover:bg-sihati-mint/70">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Selesaikan
            </button>
            <button type="button" onclick="openModal('addNoteModal')"
                class="inline-flex h-10 items-center gap-1.5 rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Tambah Catatan
            </button>
        @endif
        @if($statusKey === 'selesai')
            <span class="inline-flex h-10 items-center gap-1.5 rounded-md bg-sihati-mint px-4 text-sm font-medium text-sihati-success">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Aduan Selesai
            </span>
        @endif
        <button type="button" onclick="openModal('updateStatusModal')"
            class="inline-flex h-10 items-center gap-1.5 rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm font-medium text-sihati-slate transition hover:bg-sihati-surface">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Ubah Status
        </button>
    @endif

    {{-- Pegawai Actions --}}
    @if(auth()->user()?->role === 'pegawai')
        @if($statusKey === 'selesai')
            <button type="button" onclick="openModal('ratingModal')"
                class="inline-flex h-10 items-center gap-1.5 rounded-md bg-sihati-yellow-bold px-4 text-sm font-medium text-sihati-charcoal transition hover:bg-sihati-yellow">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
                Beri Rating
            </button>
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
