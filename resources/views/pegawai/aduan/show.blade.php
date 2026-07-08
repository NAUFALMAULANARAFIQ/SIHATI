@php
    $statusKey = $aduan->status?->kode_status ?? strtolower($aduan->status?->nama_status ?? '');
    $userRating = $aduan->ratings->firstWhere('user_id', auth()->id());
@endphp

<x-app-layout :title="$aduan->nomor_tiket . ' - SIHATI BPPKAD'">
<nav class="mb-4 text-sm text-sihati-steel">
    <a href="{{ route('pegawai.aduan.index') }}" class="hover:text-sihati-link">Aduan</a>
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
                    $sC = match($sKey) { 'diterima' => 'bg-sihati-lavender text-sihati-primary-deep', 'diproses' => 'bg-sihati-sky text-sihati-link-pressed', 'selesai' => 'bg-sihati-mint text-sihati-success', default => 'bg-sihati-gray text-sihati-slate' };
                    $p = $aduan->priority?->nama_prioritas ?? 'Rendah';
                    $pC = match(strtolower($p)) { 'rendah' => 'bg-sihati-gray text-sihati-slate', 'sedang' => 'bg-sihati-sky text-sihati-link-pressed', 'tinggi' => 'bg-sihati-yellow-bold text-sihati-charcoal', 'mendesak' => 'bg-sihati-rose text-sihati-error', default => 'bg-sihati-gray text-sihati-slate' };
                @endphp
                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $sC }}">{{ $s }}</span>
                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $pC }}">{{ $p }}</span>
            </div>
            <h2 class="mt-3 text-lg font-semibold text-sihati-charcoal md:text-xl">{{ $aduan->judul }}</h2>
            <p class="mt-1 text-sm text-sihati-steel">Dibuat {{ \Carbon\Carbon::parse($aduan->tanggal_aduan ?? $aduan->created_at)->isoFormat('DD MMMM YYYY, HH:mm') }}</p>
        </div>
        @if($statusKey === 'selesai')
            @if($userRating)
            <div class="inline-flex items-center gap-2 rounded-md border border-sihati-hairline bg-sihati-surface px-4 py-2">
                <span class="text-xs text-sihati-slate">Rating Anda</span>
                <div class="flex items-center gap-0.5">
                    @for ($i = 1; $i <= 5; $i++)
                    <svg class="h-4 w-4 {{ $i <= $userRating->rating ? 'text-sihati-yellow-bold' : 'text-sihati-hairline-strong' }}" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                    @endfor
                </div>
                <span class="text-sm font-medium text-sihati-charcoal">{{ $userRating->rating }}/5</span>
            </div>
            @else
            <button type="button" onclick="openModal('ratingModal')" class="inline-flex h-10 items-center gap-1.5 rounded-md bg-sihati-yellow-bold px-4 text-sm font-medium text-sihati-charcoal transition hover:bg-sihati-yellow">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                Beri Rating
            </button>
            @endif
        @endif
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
                @php
                    $fileUrl = asset('storage/' . $att->file_path);
                    $isImage = $att->file_type
                        ? str_starts_with($att->file_type, 'image/')
                        : (bool) preg_match('/\.(jpg|jpeg|png|webp)$/i', $att->file_name);
                    $isPdf = $att->file_type === 'application/pdf' || preg_match('/\.pdf$/i', $att->file_name);
                    $canPreview = $isImage || $isPdf;
                @endphp
                <div class="flex items-center gap-2 rounded-md border border-sihati-hairline-soft p-3 text-sm transition hover:bg-sihati-surface-soft">
                    <a href="{{ $fileUrl }}" target="_blank" class="flex min-w-0 flex-1 items-center gap-2 no-underline text-sihati-ink">
                        <svg class="h-5 w-5 flex-shrink-0 text-sihati-stone" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                        <span class="truncate">{{ $att->file_name }}</span>
                    </a>
                    @if($canPreview)
                    <button type="button"
                        onclick="openAttachmentPreview('{{ $fileUrl }}', '{{ $att->file_name }}', '{{ $isImage ? 'image' : 'pdf' }}')"
                        class="rounded px-2 py-0.5 text-xs font-medium text-sihati-link transition hover:bg-sihati-surface">
                        Lihat
                    </button>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
            <h3 class="mb-4 text-sm font-semibold uppercase tracking-[0.06em] text-sihati-steel">Catatan Penanganan</h3>
            @include('pegawai.aduan.partials.notes', ['notes' => $aduan->notes ?? []])
        </div>

        <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
            <h3 class="mb-4 text-sm font-semibold uppercase tracking-[0.06em] text-sihati-steel">Riwayat Status</h3>
            @include('pegawai.aduan.partials.timeline', ['histories' => $aduan->histories ?? []])
        </div>

        <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
            <h3 class="mb-4 text-sm font-semibold uppercase tracking-[0.06em] text-sihati-steel">Komentar &amp; Diskusi</h3>
            @include('pegawai.aduan.partials.comment-box', ['comments' => $aduan->comments ?? [], 'aduan' => $aduan, 'action' => route('pegawai.aduan.comments.store', $aduan)])
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

        @if($userRating)
        <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
            <h3 class="text-sm font-semibold uppercase tracking-[0.06em] text-sihati-steel">Rating & Ulasan</h3>
            <div class="mt-3 flex items-center gap-1">
                @for ($i = 1; $i <= 5; $i++)
                <svg class="h-5 w-5 {{ $i <= $userRating->rating ? 'text-sihati-yellow-bold' : 'text-sihati-hairline-strong' }}" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
                @endfor
                <span class="ml-1 text-sm font-medium text-sihati-charcoal">{{ $userRating->rating }}/5</span>
            </div>
            @if($userRating->komentar)
            <div class="mt-3 whitespace-pre-line text-sm leading-6 text-sihati-slate">{{ $userRating->komentar }}</div>
            @endif
        </div>
        @endif
    </div>
</div>

<div id="ratingModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4">
    <div id="ratingModalContent" class="w-full max-w-md rounded-xl bg-sihati-canvas p-6 shadow-modal">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-sihati-ink">Beri Penilaian</h2>
            <button type="button" onclick="closeModal('ratingModal')" class="rounded-md p-1.5 text-sihati-slate hover:bg-sihati-surface">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <p class="mt-2 text-sm text-sihati-slate">Beri penilaian untuk penanganan aduan <strong>{{ $aduan->nomor_tiket }}</strong></p>
        <form method="POST" action="{{ route('pegawai.aduan.ratings.store', $aduan) }}" class="mt-5 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-sihati-charcoal">Rating</label>
                <div class="mt-2 flex items-center gap-1" id="starRating">
                    @for ($i = 1; $i <= 5; $i++)
                    <button type="button" data-value="{{ $i }}" class="star-btn h-8 w-8 text-sihati-hairline-strong transition-colors duration-150">
                        <svg class="h-full w-full" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </button>
                    @endfor
                    <input type="hidden" name="rating" id="ratingValue" value="">
                </div>
            </div>
            <div>
                <label for="komentar" class="block text-sm font-medium text-sihati-charcoal">Komentar (opsional)</label>
                <textarea id="komentar" name="komentar" rows="3" placeholder="Tulis kesan Anda terhadap penanganan aduan..." class="mt-1.5 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-3 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20"></textarea>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('ratingModal')" class="rounded-md border border-sihati-hairline-strong px-4 py-2 text-sm font-medium text-sihati-ink hover:bg-sihati-surface">Batal</button>
                <button type="submit" class="rounded-md bg-sihati-primary px-4 py-2 text-sm font-medium text-sihati-on-primary hover:bg-sihati-primary-pressed">Kirim Penilaian</button>
            </div>
        </form>
    </div>
</div>

@include('partials.attachment-preview-popup')

@push('scripts')
<script>
function openModal(id) {
    var el = document.getElementById(id);
    el.classList.remove('hidden');
    el.classList.add('flex');
    var content = document.getElementById(id + 'Content');
    if (content) {
        content.classList.remove('animate-scale-in');
        void content.offsetWidth;
        content.classList.add('animate-scale-in');
    }
    var stars = document.querySelectorAll('.star-btn');
    stars.forEach(function (s) {
        s.classList.remove('text-sihati-yellow-bold', 'text-sihati-yellow');
        s.classList.add('text-sihati-hairline-strong');
    });
    document.getElementById('ratingValue').value = '';
}
function closeModal(id) {
    var el = document.getElementById(id);
    el.classList.add('hidden');
    el.classList.remove('flex');
    var content = document.getElementById(id + 'Content');
    if (content) content.classList.remove('animate-scale-in');
}

document.addEventListener('DOMContentLoaded', function () {
    var container = document.getElementById('starRating');
    if (!container) return;
    var stars = container.querySelectorAll('.star-btn');
    var input = document.getElementById('ratingValue');
    if (!input) return;

    stars.forEach(function (star) {
        star.addEventListener('click', function () {
            var val = parseInt(this.dataset.value);
            input.value = val;
            updateStars(val);
        });
        star.addEventListener('mouseenter', function () {
            var val = parseInt(this.dataset.value);
            previewStars(val);
        });
        star.addEventListener('mouseleave', function () {
            var val = parseInt(input.value);
            if (val) {
                updateStars(val);
            } else {
                stars.forEach(function (s) {
                    s.classList.remove('text-sihati-yellow-bold', 'text-sihati-yellow');
                    s.classList.add('text-sihati-hairline-strong');
                });
            }
        });
    });

    function updateStars(val) {
        stars.forEach(function (star) {
            var sv = parseInt(star.dataset.value);
            star.classList.remove('text-sihati-yellow', 'text-sihati-yellow-bold', 'text-sihati-hairline-strong');
            star.classList.add(sv <= val ? 'text-sihati-yellow-bold' : 'text-sihati-hairline-strong');
        });
    }

    function previewStars(val) {
        stars.forEach(function (star) {
            var sv = parseInt(star.dataset.value);
            star.classList.remove('text-sihati-yellow', 'text-sihati-yellow-bold', 'text-sihati-hairline-strong');
            star.classList.add(sv <= val ? 'text-sihati-yellow' : 'text-sihati-hairline-strong');
        });
    }
});
</script>
@endpush
</x-app-layout>
