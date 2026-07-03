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
                    <label for="filter_tiket" class="block text-sm font-medium text-sihati-charcoal">Nomor Tiket</label>
                    <input type="text" id="filter_tiket" name="tiket"
                        value="{{ request('tiket') }}"
                        placeholder="SIHATI-2026-..."
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                </div>
                @if (isset($showPelapor) && $showPelapor)
                <div>
                    <label for="filter_pelapor" class="block text-sm font-medium text-sihati-charcoal">Pelapor</label>
                    <input type="text" id="filter_pelapor" name="pelapor"
                        value="{{ request('pelapor') }}"
                        placeholder="Nama pelapor"
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                </div>
                @endif
                <div>
                    <label for="filter_kategori" class="block text-sm font-medium text-sihati-charcoal">Kategori</label>
                    <select id="filter_kategori" name="kategori"
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories ?? [] as $cat)
                            <option value="{{ $cat->id }}" {{ request('kategori') == $cat->id ? 'selected' : '' }}>{{ $cat->nama_kategori ?? $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="filter_status" class="block text-sm font-medium text-sihati-charcoal">Status</label>
                    <select id="filter_status" name="status"
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                        <option value="">Semua Status</option>
                        @foreach ($statuses ?? [] as $st)
                            <option value="{{ $st->id }}" {{ request('status') == $st->id ? 'selected' : '' }}>{{ $st->nama_status ?? $st->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="filter_prioritas" class="block text-sm font-medium text-sihati-charcoal">Prioritas</label>
                    <select id="filter_prioritas" name="prioritas"
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                        <option value="">Semua Prioritas</option>
                        @foreach ($priorities ?? [] as $pr)
                            <option value="{{ $pr->id }}" {{ request('prioritas') == $pr->id ? 'selected' : '' }}>{{ $pr->nama_prioritas ?? $pr->name }}</option>
                        @endforeach
                    </select>
                </div>
                @if (isset($showBidang) && $showBidang)
                <div>
                    <label for="filter_bidang" class="block text-sm font-medium text-sihati-charcoal">Bidang</label>
                    <select id="filter_bidang" name="bidang"
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                        <option value="">Semua Bidang</option>
                        @foreach ($bidangs ?? [] as $bd)
                            <option value="{{ $bd->id }}" {{ request('bidang') == $bd->id ? 'selected' : '' }}>{{ $bd->nama_bidang ?? $bd->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div>
                    <label for="filter_tgl_awal" class="block text-sm font-medium text-sihati-charcoal">Tanggal Awal</label>
                    <input type="date" id="filter_tgl_awal" name="tgl_awal"
                        value="{{ request('tgl_awal') }}"
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                </div>
                <div>
                    <label for="filter_tgl_akhir" class="block text-sm font-medium text-sihati-charcoal">Tanggal Akhir</label>
                    <input type="date" id="filter_tgl_akhir" name="tgl_akhir"
                        value="{{ request('tgl_akhir') }}"
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                </div>
            </div>
            <div class="mt-5 flex flex-col gap-3 sm:flex-row sm:justify-end">
                <a href="{{ url()->current() }}"
                    class="inline-flex h-11 items-center justify-center rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-5 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
                    Reset Filter
                </a>
                <button type="submit"
                    class="inline-flex h-11 items-center justify-center rounded-md bg-sihati-primary px-5 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">
                    Cari
                </button>
            </div>
        </form>
    </div>
</div>
