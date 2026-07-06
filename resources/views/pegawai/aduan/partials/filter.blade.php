@props(['showPelapor' => false, 'showBidang' => false])

<div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
    <div class="flex items-center justify-between sm:hidden">
        <span class="text-sm font-medium text-sihati-ink">Filter Pencarian</span>
        <button id="filterToggle" type="button"
            class="inline-flex items-center gap-1.5 rounded-md px-3 py-1.5 text-sm font-medium text-sihati-primary hover:bg-sihati-surface">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
            </svg>
            <span>Tampilkan Filter</span>
        </button>
    </div>
    <div id="filterPanel" class="hidden sm:block">
        <form method="GET" action="{{ url()->current() }}">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-sihati-charcoal">Cari Tiket / Judul</label>
                    <input type="text" id="search" name="search"
                        value="{{ request('search') }}"
                        placeholder="SIHATI-2026-... atau judul"
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                </div>
                <div>
                    <label for="category" class="block text-sm font-medium text-sihati-charcoal">Kategori</label>
                    <select id="category" name="category"
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                        <option value="">Semua Kategori</option>
                    </select>
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-sihati-charcoal">Status</label>
                    <select id="status" name="status"
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                        <option value="">Semua Status</option>
                    </select>
                </div>
                <div class="flex items-end gap-3">
                    <a href="{{ url()->current() }}"
                        class="inline-flex h-11 items-center justify-center rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-5 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
                        Reset
                    </a>
                    <button type="submit"
                        class="inline-flex h-11 items-center justify-center rounded-md bg-sihati-primary px-5 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">
                        Cari
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
