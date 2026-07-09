{{-- 
    Filter dropdown untuk halaman Aduan Saya.
    Terinspirasi dari filter Log Aktivitas admin.
--}}
@php
    $filterActive = request('search') || request('category') || request('status') || request('start_date') || request('end_date') || request('range');
    $rangeLabel = match(request('range')) { 'week' => '1 minggu terakhir', 'month' => '1 bulan terakhir', default => null };
@endphp

<div class="relative">
    <button id="filterToggleBtn" type="button" onclick="toggleAduanFilter(event)"
        class="inline-flex h-10 items-center gap-2 rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
        Filter
        @if($filterActive)
        <span class="flex h-5 w-5 items-center justify-center rounded-full bg-sihati-primary text-[11px] font-bold text-white">!</span>
        @endif
    </button>

    <div id="aduanFilterPanel"
        class="absolute right-0 z-40 mt-2 hidden w-[calc(100vw-2rem)] max-w-sm rounded-xl border border-sihati-hairline bg-sihati-canvas p-5 shadow-modal sm:w-[380px]">
        <form method="GET" action="{{ url()->current() }}" class="space-y-4">
            {{-- Search --}}
            <div>
                <label class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Cari Tiket / Judul</label>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="SIHATI-2026-... atau judul"
                    class="mt-1.5 h-10 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-3 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
            </div>

            {{-- Category + Status --}}
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Kategori</label>
                    <select name="category"
                        class="mt-1.5 h-10 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-3 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                        <option value="">Semua</option>
                        @foreach($categories ?? [] as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Status</label>
                    <select name="status"
                        class="mt-1.5 h-10 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-3 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                        <option value="">Semua</option>
                        @foreach($statuses ?? [] as $st)
                        <option value="{{ $st->kode_status }}" {{ request('status') == $st->kode_status ? 'selected' : '' }}>{{ $st->nama_status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Date range --}}
            <div>
                <label class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Rentang Tanggal</label>
                <div class="mt-1.5 grid grid-cols-2 gap-3">
                    <div>
                        <input type="date" name="start_date" value="{{ request('start_date') }}"
                            class="h-10 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-3 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                    </div>
                    <div>
                        <input type="date" name="end_date" value="{{ request('end_date') }}"
                            class="h-10 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-3 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                    </div>
                </div>
            </div>

            {{-- Shortcuts --}}
            <div class="flex flex-wrap items-center gap-2">
                <span class="text-xs font-semibold text-sihati-steel">Shortcut:</span>
                <a href="{{ url()->current() }}?range=week"
                    class="inline-flex h-8 items-center rounded-md border border-sihati-hairline-strong px-3 text-xs font-medium transition {{ request('range') === 'week' ? 'bg-sihati-lavender border-sihati-primary text-sihati-primary-deep' : 'bg-sihati-canvas text-sihati-ink hover:bg-sihati-surface' }}">
                    1 Minggu
                </a>
                <a href="{{ url()->current() }}?range=month"
                    class="inline-flex h-8 items-center rounded-md border border-sihati-hairline-strong px-3 text-xs font-medium transition {{ request('range') === 'month' ? 'bg-sihati-lavender border-sihati-primary text-sihati-primary-deep' : 'bg-sihati-canvas text-sihati-ink hover:bg-sihati-surface' }}">
                    1 Bulan
                </a>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-between gap-3 pt-1">
                <a href="{{ url()->current() }}"
                    class="inline-flex h-10 items-center justify-center rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-5 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
                    Reset
                </a>
                <button type="submit"
                    class="inline-flex h-10 items-center justify-center rounded-md bg-sihati-primary px-5 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">
                    Terapkan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function toggleAduanFilter(event) {
        if (event) event.stopPropagation();
        var panel = document.getElementById('aduanFilterPanel');
        panel.classList.toggle('hidden');
    }

    document.addEventListener('click', function(e) {
        var panel = document.getElementById('aduanFilterPanel');
        var btn = document.getElementById('filterToggleBtn');
        if (!panel || panel.classList.contains('hidden')) return;
        if (!btn.contains(e.target) && !panel.contains(e.target)) {
            panel.classList.add('hidden');
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            var panel = document.getElementById('aduanFilterPanel');
            if (panel && !panel.classList.contains('hidden')) {
                panel.classList.add('hidden');
            }
        }
    });
</script>
@endpush
