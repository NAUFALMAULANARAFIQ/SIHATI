@props(['comments' => [], 'aduan' => null, 'action' => ''])

<div class="space-y-4">
    @forelse ($comments as $comment)
        @php
            $isPetugas = ($comment->user?->role ?? $comment->role) === 'admin' || ($comment->user?->role ?? $comment->role) === 'petugas';
        @endphp
        <div class="rounded-lg border p-4 shadow-subtle transition hover:shadow-card {{ $isPetugas ? 'border-l-4 border-l-sihati-primary border-sihati-hairline bg-sihati-lavender/30' : 'border-sihati-hairline bg-sihati-canvas' }}">
            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center gap-2.5">
                    <div class="flex h-8 w-8 items-center justify-center rounded-full text-xs font-semibold {{ $isPetugas ? 'bg-sihati-primary text-sihati-on-primary' : 'bg-sihati-gray text-sihati-slate' }}">
                        {{ strtoupper(substr($comment->user?->name ?? 'U', 0, 2)) }}
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <p class="text-sm font-semibold text-sihati-ink">{{ $comment->user?->name ?? 'User' }}</p>
                            @if($isPetugas)
                                <span class="rounded-full bg-sihati-primary/10 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-[0.06em] text-sihati-primary">Petugas</span>
                            @endif
                        </div>
                        <p class="text-xs text-sihati-steel">{{ \Carbon\Carbon::parse($comment->created_at)->isoFormat('DD-MM-YYYY HH:mm') }}</p>
                    </div>
                </div>
            </div>
            <div class="mt-3 text-sm leading-6 text-sihati-slate">
                {{ $comment->komentar ?? $comment->comment }}
            </div>
        </div>
    @empty
        <div class="rounded-lg border border-dashed border-sihati-hairline-strong bg-sihati-surface-soft p-8 text-center">
            <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-lg bg-sihati-sky">
                <svg class="h-5 w-5 text-sihati-link-pressed" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
            </div>
            <h4 class="mt-3 text-sm font-semibold text-sihati-ink">Belum ada komentar</h4>
            <p class="mt-1 text-sm text-sihati-steel">Mulai diskusi dengan menambahkan komentar.</p>
        </div>
    @endforelse

    <div class="mt-6 rounded-lg border border-sihati-hairline bg-sihati-canvas p-4">
        <form method="POST" action="{{ $action }}">
            @csrf
            <label for="komentar" class="block text-sm font-medium text-sihati-charcoal">Tambah Komentar</label>
            <textarea id="komentar" name="komentar" rows="3"
                placeholder="Tulis komentar atau informasi tambahan..."
                class="mt-2 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-3 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20"></textarea>
            <div class="mt-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                @if(isset($showAttachment) && $showAttachment)
                <div class="flex items-center gap-2">
                    <label class="cursor-pointer rounded-md border border-sihati-hairline-strong px-3 py-2 text-sm font-medium text-sihati-slate transition hover:bg-sihati-surface">
                        <svg class="-ml-0.5 mr-1.5 inline h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                        </svg>
                        Lampirkan File
                        <input type="file" name="lampiran" class="hidden">
                    </label>
                </div>
                @endif
                <button type="submit"
                    class="inline-flex h-11 items-center justify-center rounded-md bg-sihati-primary px-5 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">
                    Kirim Komentar
                </button>
            </div>
        </form>
    </div>
</div>
