<x-app-layout title="Daftar Aduan - SIHATI BPPKAD">
@php
    $activeFilters = array_filter([
        request('bidang') ? 'bidang' : null,
        request('category') ? 'category' : null,
        request('priority') ? 'priority' : null,
        request('status') ? 'status' : null,
    ]);
@endphp

<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between pt-4">
    <div>
        <h1 class="text-xl md:text-2xl font-bold text-sihati-ink tracking-tight">Daftar Aduan</h1>
        <p class="text-sihati-slate mt-1 text-sm">Kelola dan pantau seluruh aduan teknologi informasi.</p>
    </div>
    <div class="flex items-center gap-3">
        <div class="relative">
            <button onclick="toggleFilter()" class="inline-flex h-10 items-center gap-2 rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                Filter
                @if(count($activeFilters) > 0)
                <span class="flex h-5 w-5 items-center justify-center rounded-full bg-sihati-primary text-[11px] font-bold text-white">{{ count($activeFilters) }}</span>
                @endif
            </button>
            <div id="filterPanel" class="absolute right-0 z-40 mt-2 hidden w-[280px] rounded-xl border border-sihati-hairline bg-sihati-canvas p-5 shadow-modal">
                <form method="GET" action="{{ route('admin.aduan.index') }}" class="space-y-4">
                    <div>
                        <span class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Bidang</span>
                        <select name="bidang" class="mt-1.5 h-10 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-3 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                            <option value="">Semua Bidang</option>
                            @foreach ($bidangs as $b)<option value="{{ $b->id }}" {{ request('bidang') == $b->id ? 'selected' : '' }}>{{ $b->nama_bidang }}</option>@endforeach
                        </select>
                    </div>
                    <div>
                        <span class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Kategori</span>
                        <select name="category" class="mt-1.5 h-10 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-3 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $cat)<option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->nama_kategori }}</option>@endforeach
                        </select>
                    </div>
                    <div>
                        <span class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Prioritas</span>
                        <select name="priority" class="mt-1.5 h-10 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-3 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                            <option value="">Semua Prioritas</option>
                            @foreach ($priorities as $pr)<option value="{{ $pr->id }}" {{ request('priority') == $pr->id ? 'selected' : '' }}>{{ $pr->nama_prioritas }}</option>@endforeach
                        </select>
                    </div>
                    <div>
                        <span class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Status</span>
                        <select name="status" class="mt-1.5 h-10 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-3 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                            <option value="">Semua Status</option>
                            <option value="diterima" {{ request('status') === 'diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    <div class="flex gap-3 pt-1">
                        <button type="submit" class="inline-flex h-10 flex-1 items-center justify-center rounded-md bg-sihati-primary text-sm font-medium text-white transition hover:bg-sihati-primary-pressed">Terapkan</button>
                        <a href="{{ route('admin.aduan.index') }}" class="inline-flex h-10 flex-1 items-center justify-center rounded-md border border-sihati-hairline-strong bg-sihati-canvas text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">Reset</a>
                    </div>
                </form>
            </div>
        </div>
        <button onclick="openModal('createAduanModal')" class="inline-flex h-10 items-center gap-2 rounded-md bg-sihati-primary px-4 text-sm font-medium text-white transition hover:bg-sihati-primary-pressed">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Buat Aduan
        </button>
    </div>
</div>

@if(count($activeFilters) > 0)
<div class="mb-4 flex flex-wrap items-center gap-2">
    @if(request('bidang'))
    <span class="inline-flex items-center gap-1 rounded-md bg-sihati-lavender/40 px-2.5 py-1 text-xs font-medium text-sihati-primary-deep">
        Bidang: {{ $bidangs->firstWhere('id', (int) request('bidang'))?->nama_bidang ?? '#' . request('bidang') }}
        <a href="{{ removeQuery('bidang') }}" class="text-sihati-primary hover:text-sihati-error">&times;</a>
    </span>
    @endif
    @if(request('category'))
    <span class="inline-flex items-center gap-1 rounded-md bg-sihati-lavender/40 px-2.5 py-1 text-xs font-medium text-sihati-primary-deep">
        Kategori: {{ $categories->firstWhere('id', (int) request('category'))?->nama_kategori ?? '#' . request('category') }}
        <a href="{{ removeQuery('category') }}" class="text-sihati-primary hover:text-sihati-error">&times;</a>
    </span>
    @endif
    @if(request('priority'))
    <span class="inline-flex items-center gap-1 rounded-md bg-sihati-lavender/40 px-2.5 py-1 text-xs font-medium text-sihati-primary-deep">
        Prioritas: {{ $priorities->firstWhere('id', (int) request('priority'))?->nama_prioritas ?? '#' . request('priority') }}
        <a href="{{ removeQuery('priority') }}" class="text-sihati-primary hover:text-sihati-error">&times;</a>
    </span>
    @endif
    @if(request('status'))
    <span class="inline-flex items-center gap-1 rounded-md bg-sihati-lavender/40 px-2.5 py-1 text-xs font-medium text-sihati-primary-deep">
        Status: {{ ucfirst(request('status')) }}
        <a href="{{ removeQuery('status') }}" class="text-sihati-primary hover:text-sihati-error">&times;</a>
    </span>
    @endif
</div>
@endif

<div class="overflow-hidden rounded-lg border border-sihati-hairline bg-sihati-canvas shadow-subtle">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-sihati-hairline-soft">
            <thead class="bg-sihati-surface">
                <tr>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">No. Tiket</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Tanggal</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Pelapor</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Bidang</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Judul</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Kategori</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Prioritas</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Status</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-right text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-sihati-hairline-soft bg-sihati-canvas">
                @forelse ($aduans as $aduan)
                <tr class="transition hover:bg-sihati-surface-soft" data-aduan-id="{{ $aduan->id }}">
                    <td class="whitespace-nowrap px-4 py-3.5"><a href="{{ route('admin.aduan.show', $aduan) }}" class="text-sm font-medium text-sihati-primary hover:text-sihati-primary-pressed">{{ $aduan->nomor_tiket }}</a></td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-steel">{{ \Carbon\Carbon::parse($aduan->tanggal_aduan)->isoFormat('DD-MM-Y') }}</td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $aduan->pelapor?->name ?? '-' }}</td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $aduan->bidang?->nama_bidang ?? '-' }}</td>
                    <td class="max-w-[180px] px-4 py-3.5"><p class="truncate text-sm font-medium text-sihati-charcoal">{{ $aduan->judul }}</p></td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $aduan->category?->nama_kategori ?? '-' }}</td>
                    <td class="whitespace-nowrap px-4 py-3.5">@php $p = $aduan->priority?->nama_prioritas ?? '-'; $pC = $p === '-' ? 'bg-sihati-gray text-sihati-stone italic' : match(strtolower($p)){'rendah'=>'bg-sihati-gray text-sihati-slate','sedang'=>'bg-sihati-sky text-sihati-link-pressed','tinggi'=>'bg-sihati-yellow-bold text-sihati-charcoal','mendesak'=>'bg-sihati-rose text-sihati-error',default=>'bg-sihati-gray text-sihati-slate'}; @endphp<span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $pC }}">{{ $p }}</span></td>
                    <td class="whitespace-nowrap px-4 py-3.5">@php $s = $aduan->status?->nama_status ?? $aduan->status?->kode_status ?? 'diterima'; $sC = match(strtolower($s)){'diterima'=>'bg-sihati-lavender text-sihati-primary-deep','diproses'=>'bg-sihati-sky text-sihati-link-pressed','selesai'=>'bg-sihati-mint text-sihati-success',default=>'bg-sihati-gray text-sihati-slate'}; @endphp<span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $sC }}">{{ $s }}</span></td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-right"><a href="{{ route('admin.aduan.show', $aduan) }}" class="text-sm font-medium text-sihati-link transition hover:text-sihati-link-pressed">Detail</a></td>
                </tr>
                @empty
                <tr><td colspan="9" class="px-4 py-10"><div class="text-center"><div class="mx-auto flex h-12 w-12 items-center justify-center rounded-lg bg-sihati-lavender"><svg class="h-6 w-6 text-sihati-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div><h3 class="mt-4 text-base font-semibold text-sihati-ink">Belum ada aduan</h3><p class="mt-1 text-sm text-sihati-slate">Semua aduan akan tampil di sini.</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@if (method_exists($aduans, 'links'))
<div class="mt-6">{{ $aduans->links() }}</div>
@endif

<x-modal id="createAduanModal" title="Buat Aduan Baru" size="lg" scrollable>
    <form method="POST" action="{{ route('admin.aduan.store') }}" enctype="multipart/form-data" class="space-y-5">
        @csrf
        <div>
            <label for="judul" class="block text-sm font-medium text-sihati-charcoal">Judul Aduan <span class="text-sihati-error">*</span></label>
            <input type="text" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Printer tidak bisa mencetak" required
                class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('judul') border-sihati-error @enderror">
            @error('judul')<p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
            <div>
                <label for="bidang_id" class="block text-sm font-medium text-sihati-charcoal">Bidang <span class="text-sihati-error">*</span></label>
                <select id="bidang_id" name="bidang_id" required
                    class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('bidang_id') border-sihati-error @enderror">
                    <option value="">Pilih bidang</option>
                    @foreach ($bidangs as $b)<option value="{{ $b->id }}" {{ old('bidang_id') == $b->id ? 'selected' : '' }}>{{ $b->nama_bidang }}</option>@endforeach
                </select>
                @error('bidang_id')<p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="category_id" class="block text-sm font-medium text-sihati-charcoal">Kategori <span class="text-sihati-error">*</span></label>
                <select id="category_id" name="category_id" required
                    class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('category_id') border-sihati-error @enderror">
                    <option value="">Pilih kategori</option>
                    @foreach ($categories as $cat)<option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nama_kategori }}</option>@endforeach
                </select>
                @error('category_id')<p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
            <div>
                <label for="priority_id" class="block text-sm font-medium text-sihati-charcoal">Prioritas <span class="text-sihati-error">*</span></label>
                <select id="priority_id" name="priority_id" class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('priority_id') border-sihati-error @enderror">
                    <option value="">Pilih prioritas</option>
                    @foreach ($priorities as $pr)<option value="{{ $pr->id }}" {{ old('priority_id') == $pr->id ? 'selected' : '' }}>{{ $pr->nama_prioritas }}</option>@endforeach
                </select>
                @error('priority_id')<p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="lokasi" class="block text-sm font-medium text-sihati-charcoal">Lokasi / Ruangan</label>
                <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Ruang Bidang Anggaran Lt. 2"
                    class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
            </div>
        </div>

        <div>
            <label for="no_kontak" class="block text-sm font-medium text-sihati-charcoal">Nomor Kontak</label>
            <input type="text" id="no_kontak" name="no_kontak" value="{{ old('no_kontak') }}" placeholder="Contoh: 08123456789"
                class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
        </div>

        <div>
            <label for="deskripsi" class="block text-sm font-medium text-sihati-charcoal">Deskripsi Masalah <span class="text-sihati-error">*</span></label>
            <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Jelaskan kendala yang dialami secara lengkap." required
                class="mt-1.5 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-3 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('deskripsi') border-sihati-error @enderror">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')<p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>@enderror
        </div>

        <div>
            <span class="block text-sm font-medium text-sihati-charcoal">Lampiran (opsional)</span>
            <label for="attachments" class="mt-1.5 flex cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-sihati-hairline-strong bg-sihati-surface-soft p-5 transition hover:border-sihati-primary hover:bg-sihati-lavender/20">
                <svg class="mb-2 h-8 w-8 text-sihati-stone" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                <p class="text-sm font-medium text-sihati-charcoal">Upload lampiran</p>
                <p class="mt-1 text-xs text-sihati-steel">Format JPG, PNG, atau PDF. Maksimal 5 MB.</p>
                <input type="file" id="attachments" name="attachments[]" class="hidden" accept=".jpg,.jpeg,.png,.pdf" multiple data-file-upload="attachmentPreview">
            </label>
            <div id="attachmentPreview" class="mt-2 flex flex-wrap gap-2"></div>
            @error('attachments')<p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>@enderror
        </div>

        <div class="flex items-center justify-end gap-3 border-t border-sihati-hairline pt-5">
            <button type="button" onclick="closeModal('createAduanModal')" class="inline-flex h-10 items-center justify-center rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">Batal</button>
            <button type="submit" class="inline-flex h-10 items-center justify-center gap-2 rounded-md bg-sihati-primary px-5 text-sm font-medium text-white transition hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                Kirim Aduan
            </button>
        </div>
    </form>
</x-modal>

@if($errors->hasAny(['judul', 'bidang_id', 'category_id', 'deskripsi', 'attachments']))
@push('scripts')
<script>openModal('createAduanModal');</script>
@endpush
@endif

@push('scripts')
<script>
function toggleFilter() {
    document.getElementById('filterPanel').classList.toggle('hidden');
}
document.addEventListener('click', function(e) {
    var panel = document.getElementById('filterPanel');
    if (panel && !panel.closest('.relative')?.contains(e.target)) {
        panel.classList.add('hidden');
    }
});
</script>
@endpush

@push('scripts')
<script>
(function () {
    const fetchUrl = '{{ route("admin.aduan.list") }}?{{ http_build_query(request()->query()) }}';
    if (!document.querySelector('tr[data-aduan-id]')) return;

    const statusColors = {
        diterima: 'bg-sihati-lavender text-sihati-primary-deep',
        diproses: 'bg-sihati-sky text-sihati-link-pressed',
        selesai: 'bg-sihati-mint text-sihati-success',
    };
    const priorityColors = {
        rendah: 'bg-sihati-gray text-sihati-slate',
        sedang: 'bg-sihati-sky text-sihati-link-pressed',
        tinggi: 'bg-sihati-yellow-bold text-sihati-charcoal',
        mendesak: 'bg-sihati-rose text-sihati-error',
    };
    const badgeBase = 'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold';

    async function poll() {
        try {
            const res = await fetch(fetchUrl, { headers: { 'Accept': 'application/json' }, cache: 'no-store' });
            if (!res.ok) return;
            const items = await res.json();
            items.forEach(function (item) {
                const row = document.querySelector('tr[data-aduan-id="' + item.id + '"]');
                if (!row) return;

                const cells = row.querySelectorAll('td');
                const priorityCell = cells[6];
                const statusCell = cells[7];
                if (!priorityCell || !statusCell) return;

                const pKey = (item.priority_nama || '').toLowerCase();
                const pColor = priorityColors[pKey] || 'bg-sihati-gray text-sihati-slate';
                priorityCell.innerHTML = '<span class="' + badgeBase + ' ' + pColor + '">' + (item.priority_nama || '-') + '</span>';

                const sKey = (item.status_kode || '').toLowerCase();
                const sColor = statusColors[sKey] || 'bg-sihati-gray text-sihati-slate';
                statusCell.innerHTML = '<span class="' + badgeBase + ' ' + sColor + '">' + (item.status_nama || '-') + '</span>';
            });
        } catch (e) {}
    }

    setInterval(poll, 4000);
})();
</script>
@endpush

</x-app-layout>
