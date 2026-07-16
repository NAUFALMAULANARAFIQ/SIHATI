@props(['histories' => []])

<div class="flow-root">
    <ol id="statusTimelineList" class="relative border-s border-sihati-hairline">
        @forelse ($histories as $history)
            <li class="mb-8 ms-6 last:mb-0">
                @php
                    $statusColors = [
                        'diterima' => 'bg-sihati-lavender ring-sihati-lavender text-sihati-primary-deep',
                        'diproses' => 'bg-sihati-sky ring-sihati-sky text-sihati-link-pressed',
                        'selesai' => 'bg-sihati-mint ring-sihati-mint text-sihati-success',
                    ];
                    $color = $statusColors[$history->statusBaru?->kode_status] ?? 'bg-sihati-gray ring-sihati-gray text-sihati-slate';
                @endphp
                <span class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full ring-4 ring-sihati-canvas {{ $color }}">
                    @if($history->statusBaru?->kode_status === 'selesai')
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                        </svg>
                    @else
                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="3"/>
                        </svg>
                    @endif
                </span>
                <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-4 shadow-subtle">
                    <div class="flex flex-wrap items-center gap-2">
                        <h3 class="text-sm font-semibold text-sihati-ink">
                            {{ $history->statusBaru?->nama_status }}
                        </h3>
                        @if($history->statusSebelumnya)
                            <span class="text-xs text-sihati-steel">dari</span>
                            <span class="rounded-md bg-sihati-surface px-2 py-0.5 text-xs font-medium text-sihati-slate">
                                {{ $history->statusSebelumnya?->nama_status }}
                            </span>
                        @endif
                    </div>
                    <div class="mt-2 flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-sihati-steel">
                        <time>{{ \Carbon\Carbon::parse($history->created_at)->isoFormat('DD-MM-YYYY HH:mm') }}</time>
                        @if($history->changedBy)
                            <span>oleh {{ $history->changedBy->name }}</span>
                        @endif
                        @if($history->keterangan)
                            <span class="italic">· {{ $history->keterangan }}</span>
                        @endif
                    </div>
                </div>
            </li>
        @empty
            <li id="statusTimelineEmpty" class="ms-6">
                <div class="rounded-lg border border-dashed border-sihati-hairline-strong bg-sihati-surface-soft p-6 text-center">
                    <p class="text-sm text-sihati-steel">Belum ada riwayat perubahan status.</p>
                </div>
            </li>
        @endforelse
    </ol>
</div>
