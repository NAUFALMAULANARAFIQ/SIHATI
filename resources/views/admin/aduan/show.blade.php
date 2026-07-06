@php $statusKey = $aduan->status?->kode_status ?? strtolower($aduan->status?->nama_status ?? ''); @endphp

<x-app-layout :title="$aduan->nomor_tiket . ' - SIHATI BPPKAD'">
<nav class="mb-4 text-sm text-sihati-steel">
    <a href="{{ route('admin.aduan.index') }}" class="hover:text-sihati-link">Aduan</a>
    <span class="mx-2">/</span>
    <span class="text-sihati-charcoal">{{ $aduan->nomor_tiket }}</span>
</nav>

<div class="mb-6 rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle md:p-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
        <div class="flex-1">
            <div class="flex flex-wrap items-center gap-3">
                <h1 class="text-xl font-semibold tracking-[-0.02em] text-sihati-primary md:text-2xl">{{ $aduan->nomor_tiket }}</h1>
                @php
                    $s = $aduan->status?->nama_status ?? $aduan->status?->kode_status ?? 'diterima'; $sKey = strtolower($s);
                    $sC = match($sKey){'diterima'=>'bg-sihati-lavender text-sihati-primary-deep','diproses'=>'bg-sihati-sky text-sihati-link-pressed','selesai'=>'bg-sihati-mint text-sihati-success',default=>'bg-sihati-gray text-sihati-slate'};
                    $p = $aduan->priority?->nama_prioritas ?? 'Rendah';
                    $pC = match(strtolower($p)){'rendah'=>'bg-sihati-gray text-sihati-slate','sedang'=>'bg-sihati-sky text-sihati-link-pressed','tinggi'=>'bg-sihati-yellow-bold text-sihati-charcoal','mendesak'=>'bg-sihati-rose text-sihati-error',default=>'bg-sihati-gray text-sihati-slate'};
                @endphp
                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $sC }}">{{ $s }}</span>
                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $pC }}">{{ $p }}</span>
            </div>
            <h2 class="mt-3 text-lg font-semibold text-sihati-charcoal md:text-xl">{{ $aduan->judul }}</h2>
            <p class="mt-1 text-sm text-sihati-steel">Dibuat {{ \Carbon\Carbon::parse($aduan->tanggal_aduan)->isoFormat('DD MMMM YYYY, HH:mm') }}</p>
        </div>
        <button type="button" onclick="openModal('updateStatusModal')" class="inline-flex h-10 items-center gap-1.5 rounded-md bg-sihati-primary px-4 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            Ubah Status
        </button>
    </div>
</div>

<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    <div class="space-y-6 lg:col-span-2">
        <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
            <h3 class="text-sm font-semibold uppercase tracking-[0.06em] text-sihati-steel">Deskripsi Masalah</h3>
            <div class="mt-3 text-sm leading-6 text-sihati-slate whitespace-pre-line">{{ $aduan->deskripsi ?? 'Tidak ada deskripsi.' }}</div>
        </div>

        @if($aduan->attachments && $aduan->attachments->isNotEmpty())
        <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
            <h3 class="text-sm font-semibold uppercase tracking-[0.06em] text-sihati-steel">Lampiran</h3>
            <div class="mt-3 grid grid-cols-2 gap-3 sm:grid-cols-3">
                @foreach ($aduan->attachments as $att)
                <a href="{{ asset('storage/' . $att->file_path) }}" target="_blank" class="flex items-center gap-2 rounded-md border border-sihati-hairline-soft p-3 text-sm transition hover:bg-sihati-surface-soft">
                    <svg class="h-5 w-5 flex-shrink-0 text-sihati-stone" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                    <span class="truncate">{{ $att->file_name }}</span>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-sm font-semibold uppercase tracking-[0.06em] text-sihati-steel">Catatan Penanganan</h3>
                <button type="button" onclick="openModal('addNoteModal')" class="inline-flex items-center gap-1 rounded-md px-3 py-1.5 text-sm font-medium text-sihati-primary hover:bg-sihati-surface">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>Tambah
                </button>
            </div>
            @include('pegawai.aduan.partials.notes', ['notes' => $aduan->notes ?? []])
        </div>

        <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
            <h3 class="mb-4 text-sm font-semibold uppercase tracking-[0.06em] text-sihati-steel">Riwayat Status</h3>
            @include('pegawai.aduan.partials.timeline', ['histories' => $aduan->histories ?? []])
        </div>

        <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
            <h3 class="mb-4 text-sm font-semibold uppercase tracking-[0.06em] text-sihati-steel">Komentar &amp; Diskusi</h3>
            @include('pegawai.aduan.partials.comment-box', ['comments' => $aduan->comments ?? [], 'aduan' => $aduan, 'action' => route('admin.aduan.comments.store', $aduan), 'showAttachment' => true])
        </div>
    </div>

    <div class="space-y-4">
        <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
            <h3 class="text-sm font-semibold uppercase tracking-[0.06em] text-sihati-steel">Informasi Pelapor</h3>
            <div class="mt-3 space-y-3">
                <div><p class="text-xs text-sihati-steel">Nama</p><p class="text-sm font-medium text-sihati-charcoal">{{ $aduan->pelapor?->name ?? '-' }}</p></div>
                <div><p class="text-xs text-sihati-steel">Bidang</p><p class="text-sm text-sihati-charcoal">{{ $aduan->bidang?->nama_bidang ?? '-' }}</p></div>
                @if($aduan->no_kontak)<div><p class="text-xs text-sihati-steel">Kontak</p><p class="text-sm text-sihati-charcoal">{{ $aduan->no_kontak }}</p></div>@endif
                <div><p class="text-xs text-sihati-steel">Kategori</p><span class="mt-1 inline-flex items-center rounded-md bg-sihati-surface px-2.5 py-1 text-xs font-medium text-sihati-slate">{{ $aduan->category?->nama_kategori ?? '-' }}</span></div>
                @if($aduan->lokasi)<div><p class="text-xs text-sihati-steel">Lokasi</p><p class="text-sm text-sihati-charcoal">{{ $aduan->lokasi }}</p></div>@endif
            </div>
        </div>

        <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
            <h3 class="text-sm font-semibold uppercase tracking-[0.06em] text-sihati-steel">Penanganan</h3>
            <div class="mt-3 space-y-3">
                @if($aduan->petugas)<div><p class="text-xs text-sihati-steel">Petugas</p><p class="text-sm font-medium text-sihati-charcoal">{{ $aduan->petugas->name }}</p></div>@endif
                @if($aduan->tanggal_diterima)<div><p class="text-xs text-sihati-steel">Diterima</p><p class="text-sm text-sihati-charcoal">{{ \Carbon\Carbon::parse($aduan->tanggal_diterima)->isoFormat('DD-MM-Y HH:mm') }}</p></div>@endif
                @if($aduan->tanggal_diproses)<div><p class="text-xs text-sihati-steel">Diproses</p><p class="text-sm text-sihati-charcoal">{{ \Carbon\Carbon::parse($aduan->tanggal_diproses)->isoFormat('DD-MM-Y HH:mm') }}</p></div>@endif
                @if($aduan->tanggal_selesai)<div><p class="text-xs text-sihati-steel">Selesai</p><p class="text-sm font-semibold text-sihati-success">{{ \Carbon\Carbon::parse($aduan->tanggal_selesai)->isoFormat('DD-MM-Y HH:mm') }}</p></div>@endif
            </div>
        </div>
    </div>
</div>


<div id="updateStatusModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4">
    <div class="w-full max-w-lg rounded-xl bg-sihati-canvas p-6 shadow-modal">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-sihati-ink">Ubah Status Aduan</h2>
            <button type="button" onclick="closeModal('updateStatusModal')" class="rounded-md p-1.5 text-sihati-slate hover:bg-sihati-surface">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <p class="mt-2 text-sm leading-6 text-sihati-slate">Aduan: <strong>{{ $aduan->nomor_tiket }}</strong> — Status saat ini: <strong>{{ $s }}</strong></p>
        <form method="POST" action="{{ route('admin.aduan.status.update', $aduan) }}" class="mt-5 space-y-4">
            @csrf @method('PATCH')
            <div>
                <label for="status" class="block text-sm font-medium text-sihati-charcoal">Status Baru <span class="text-sihati-error">*</span></label>
                <select id="status" name="status" class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                    <option value="">Pilih status</option>
                    @foreach (\App\Models\Status::all() as $st)<option value="{{ $st->kode_status }}" {{ $st->kode_status === $statusKey ? 'disabled' : '' }}>{{ $st->nama_status }} {{ $st->kode_status === $statusKey ? '(saat ini)' : '' }}</option>@endforeach
                </select>
            </div>
            <div>
                <label for="keterangan" class="block text-sm font-medium text-sihati-charcoal">Catatan (opsional)</label>
                <textarea id="keterangan" name="keterangan" rows="3" placeholder="Tambahkan catatan perubahan status..." class="mt-1.5 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-3 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20"></textarea>
            </div>
            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="closeModal('updateStatusModal')" class="rounded-md border border-sihati-hairline-strong px-4 py-2 text-sm font-medium text-sihati-ink hover:bg-sihati-surface">Batal</button>
                <button type="submit" class="rounded-md bg-sihati-primary px-4 py-2 text-sm font-medium text-sihati-on-primary hover:bg-sihati-primary-pressed">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="addNoteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4">
    <div class="w-full max-w-lg rounded-xl bg-sihati-canvas p-6 shadow-modal">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-sihati-ink">Tambah Catatan Penanganan</h2>
            <button type="button" onclick="closeModal('addNoteModal')" class="rounded-md p-1.5 text-sihati-slate hover:bg-sihati-surface">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <p class="mt-2 text-sm text-sihati-slate">{{ $aduan->nomor_tiket }}</p>
        <form method="POST" action="{{ route('admin.aduan.notes.store', $aduan) }}" class="mt-5 space-y-4">
            @csrf
            <div><label for="catatan" class="block text-sm font-medium text-sihati-charcoal">Catatan <span class="text-sihati-error">*</span></label><textarea id="catatan" name="catatan" rows="4" placeholder="Tulis catatan penanganan..." class="mt-1.5 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-3 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20"></textarea></div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('addNoteModal')" class="rounded-md border border-sihati-hairline-strong px-4 py-2 text-sm font-medium text-sihati-ink hover:bg-sihati-surface">Batal</button>
                <button type="submit" class="rounded-md bg-sihati-primary px-4 py-2 text-sm font-medium text-sihati-on-primary hover:bg-sihati-primary-pressed">Simpan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openModal(id){document.getElementById(id)?.classList.remove('hidden');document.getElementById(id)?.classList.add('flex');}
function closeModal(id){document.getElementById(id)?.classList.add('hidden');document.getElementById(id)?.classList.remove('flex');}
</script>
@endpush
</x-app-layout>
