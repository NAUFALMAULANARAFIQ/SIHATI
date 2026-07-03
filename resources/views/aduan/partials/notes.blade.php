@props(['notes' => [], 'aduan' => null])

<div class="space-y-4">
    @forelse ($notes as $note)
        <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-4 shadow-subtle">
            <div class="flex items-start justify-between gap-4">
                <div class="flex items-center gap-2">
                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-sihati-lavender text-xs font-semibold text-sihati-primary-deep">
                        {{ strtoupper(substr($note->petugas?->name ?? $note->petugas?->name ?? 'PT', 0, 2)) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-sihati-ink">{{ $note->petugas?->name ?? 'Petugas' }}</p>
                        <p class="text-xs text-sihati-steel">
                            {{ \Carbon\Carbon::parse($note->created_at)->isoFormat('DD-MM-YYYY HH:mm') }}
                        </p>
                    </div>
                </div>
                <span class="inline-flex items-center rounded-full bg-sihati-gray px-2.5 py-0.5 text-[11px] font-semibold uppercase tracking-[0.06em] text-sihati-slate">
                    Catatan
                </span>
            </div>
            <div class="mt-3 text-sm leading-6 text-sihati-slate">
                {{ $note->catatan }}
            </div>
        </div>
    @empty
        <div class="rounded-lg border border-dashed border-sihati-hairline-strong bg-sihati-surface-soft p-8 text-center">
            <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-lg bg-sihati-lavender">
                <svg class="h-5 w-5 text-sihati-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <h4 class="mt-3 text-sm font-semibold text-sihati-ink">Belum ada catatan penanganan</h4>
            <p class="mt-1 text-sm text-sihati-steel">Admin akan menambahkan catatan saat menangani aduan.</p>
        </div>
    @endforelse
</div>
