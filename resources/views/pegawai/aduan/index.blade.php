<x-app-layout title="Aduan Saya - SIHATI BPPKAD">
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="mt-1 text-2xl font-semibold tracking-[-0.02em] text-sihati-ink">Aduan Saya</h1>
        <p class="mt-1 text-sm leading-6 text-sihati-slate">Pantau aduan yang telah Anda buat.</p>
    </div>
    <button type="button" onclick="openBuatAduan()"
        class="inline-flex h-11 items-center justify-center gap-2 rounded-md bg-sihati-primary px-5 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Buat Aduan
    </button>
</div>

<div class="overflow-hidden rounded-lg border border-sihati-hairline bg-sihati-canvas shadow-subtle">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-sihati-hairline-soft">
            <thead class="bg-sihati-surface">
                <tr>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">No. Tiket</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Judul</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Kategori</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Prioritas</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Status</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Tanggal</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-right text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-sihati-hairline-soft bg-sihati-canvas">
                @forelse ($aduans as $aduan)
                <tr class="transition hover:bg-sihati-surface-soft">
                    <td class="whitespace-nowrap px-4 py-3.5">
                        <a href="{{ route('pegawai.aduan.show', $aduan) }}" class="text-sm font-medium text-sihati-primary hover:text-sihati-primary-pressed">{{ $aduan->nomor_tiket }}</a>
                    </td>
                    <td class="max-w-[200px] px-4 py-3.5"><p class="truncate text-sm font-medium text-sihati-charcoal">{{ $aduan->judul }}</p></td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $aduan->category?->nama_kategori ?? '-' }}</td>
                    <td class="whitespace-nowrap px-4 py-3.5">
                        @php $p = $aduan->priority?->nama_prioritas ?? 'Rendah'; $pC = match(strtolower($p)) { 'rendah' => 'bg-sihati-gray text-sihati-slate', 'sedang' => 'bg-sihati-sky text-sihati-link-pressed', 'tinggi' => 'bg-sihati-yellow-bold text-sihati-charcoal', 'mendesak' => 'bg-sihati-rose text-sihati-error', default => 'bg-sihati-gray text-sihati-slate' }; @endphp
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $pC }}">{{ $p }}</span>
                    </td>
                    <td class="whitespace-nowrap px-4 py-3.5">
                        @php $s = $aduan->status?->nama_status ?? $aduan->status?->kode_status ?? 'diterima'; $sC = match(strtolower($s)) { 'diterima' => 'bg-sihati-lavender text-sihati-primary-deep', 'diproses' => 'bg-sihati-sky text-sihati-link-pressed', 'selesai' => 'bg-sihati-mint text-sihati-success', default => 'bg-sihati-gray text-sihati-slate' }; @endphp
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $sC }}">{{ $s }}</span>
                    </td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-steel">{{ \Carbon\Carbon::parse($aduan->tanggal_aduan ?? $aduan->created_at)->isoFormat('DD-MM-Y') }}</td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-right">
                        <a href="{{ route('pegawai.aduan.show', $aduan) }}" class="text-sm font-medium text-sihati-link transition hover:text-sihati-link-pressed">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-10">
                        <div class="text-center">
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-lg bg-sihati-lavender">
                                <svg class="h-6 w-6 text-sihati-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <h3 class="mt-4 text-base font-semibold text-sihati-ink">Belum ada aduan</h3>
                            <p class="mt-1 text-sm text-sihati-slate">Aduan yang dibuat akan tampil di halaman ini.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@if (method_exists($aduans, 'links'))
<div class="mt-6">{{ $aduans->links() }}</div>
@endif

<div id="buatAduanModal" class="fixed inset-0 z-50 hidden items-start justify-center bg-black/40 px-4 overflow-y-auto">
    <div class="w-full max-w-2xl rounded-xl bg-sihati-canvas p-6 shadow-modal animate-slide-up my-4 md:my-8">
        <div class="flex items-center justify-between border-b border-sihati-hairline pb-4">
            <h2 class="text-lg font-semibold text-sihati-ink">Buat Aduan Baru</h2>
            <button type="button" onclick="closeModal('buatAduanModal')" class="rounded-md p-1.5 text-sihati-stone hover:bg-sihati-surface">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('pegawai.aduan.store') }}" enctype="multipart/form-data" class="space-y-5 pt-6">
            @csrf
            <div>
                <label for="judul" class="block text-sm font-medium text-sihati-charcoal">Judul Aduan <span class="text-sihati-error">*</span></label>
                <input type="text" name="judul" id="judul" value="{{ old('judul') }}" placeholder="Contoh: Printer tidak bisa mencetak" required
                    class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
            </div>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label for="bidang_id" class="block text-sm font-medium text-sihati-charcoal">Bidang <span class="text-sihati-error">*</span></label>
                    <select name="bidang_id" id="bidang_id" required
                        class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                        <option value="">Pilih bidang</option>
                        @foreach ($bidangs as $b)
                        <option value="{{ $b->id }}" {{ old('bidang_id', auth()->user()->bidang_id) == $b->id ? 'selected' : '' }}>{{ $b->nama_bidang }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="category_id" class="block text-sm font-medium text-sihati-charcoal">Kategori <span class="text-sihati-error">*</span></label>
                    <select name="category_id" id="category_id" required
                        class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                        <option value="">Pilih kategori</option>
                        @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label for="priority_id" class="block text-sm font-medium text-sihati-charcoal">Prioritas <span class="text-sihati-error">*</span></label>
                    <select name="priority_id" id="priority_id"
                        class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                        <option value="">Pilih prioritas</option>
                        @foreach ($priorities as $pr)
                        <option value="{{ $pr->id }}" {{ old('priority_id') == $pr->id ? 'selected' : '' }}>{{ $pr->nama_prioritas }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-sihati-charcoal">Lokasi / Ruangan</label>
                    <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Ruang Bidang Anggaran Lt. 2"
                        class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                </div>
            </div>
            <div>
                <label for="no_kontak" class="block text-sm font-medium text-sihati-charcoal">Nomor Kontak</label>
                <input type="text" name="no_kontak" id="no_kontak" value="{{ old('no_kontak') }}" placeholder="Contoh: 08123456789"
                    class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
            </div>
            <div>
                <label for="deskripsi" class="block text-sm font-medium text-sihati-charcoal">Deskripsi Masalah <span class="text-sihati-error">*</span></label>
                <textarea name="deskripsi" id="deskripsi" rows="4" placeholder="Jelaskan kendala yang dialami secara lengkap." required
                    class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">{{ old('deskripsi') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-sihati-charcoal">Lampiran (opsional)</label>
                <label for="attachments" class="mt-1.5 flex cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-sihati-hairline-strong bg-sihati-surface-soft p-5 transition hover:border-sihati-primary hover:bg-sihati-lavender/20">
                    <svg class="mb-2 h-8 w-8 text-sihati-stone" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                    <p class="text-sm font-medium text-sihati-charcoal">Upload lampiran</p>
                    <p class="mt-1 text-xs text-sihati-steel">Format JPG, PNG, atau PDF. Maksimal 5 MB.</p>
                    <input type="file" id="attachments" name="attachments[]" class="hidden" accept=".jpg,.jpeg,.png,.pdf" multiple data-file-upload="attachmentPreview">
                </label>
                <div id="attachmentPreview" class="mt-2 flex flex-wrap gap-2"></div>
            </div>
            <div class="flex items-center justify-end gap-3 border-t border-sihati-hairline pt-6">
                <button type="button" onclick="closeModal('buatAduanModal')" class="rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2 text-sm font-medium text-sihati-ink hover:bg-sihati-surface">Batal</button>
                <button type="submit" class="rounded-md bg-sihati-primary px-5 py-2 text-sm font-medium text-sihati-on-primary hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">Kirim Aduan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
if (typeof window.closeModal !== 'function') {
    window.closeModal = function(id) {
        var el = document.getElementById(id);
        if (el) { el.classList.add('hidden'); el.classList.remove('flex'); document.body.style.overflow = ''; }
    };
}

function openBuatAduan() {
    var m = document.getElementById('buatAduanModal');
    var c = m.querySelector('div:first-child');
    c.classList.remove('animate-slide-up');
    m.classList.remove('hidden'); m.classList.add('flex'); document.body.style.overflow = 'hidden';
    void c.offsetWidth; c.classList.add('animate-slide-up');
}
</script>
@endpush
</x-app-layout>
