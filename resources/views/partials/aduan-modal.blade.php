{{--
    Modal Buat Aduan Baru
    Digunakan bersama dari dashboard pegawai & halaman Aduan Saya.
    Mengirim form POST ke route('pegawai.aduan.store').

    Dependensi (harus ada di view induk):
        $bidangs   (collection of Bidang)
        $categories(collection of Category)
        $priorities(collection of Priority)
--}}

<div id="buatAduanModal" class="fixed inset-0 z-50 hidden items-start justify-center bg-black/40 px-4 overflow-y-auto">
    <div class="w-full max-w-2xl rounded-xl bg-sihati-canvas p-6 shadow-modal animate-slide-up my-4 md:my-8">
        {{-- ── Header ── --}}
        <div class="flex items-center justify-between border-b border-sihati-hairline pb-4">
            <h2 class="text-lg font-semibold text-sihati-ink">Buat Aduan Baru</h2>
            <button type="button" onclick="closeAduanModal()"
                class="rounded-md p-1.5 text-sihati-stone transition hover:bg-sihati-surface hover:text-sihati-slate">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- ── Form ── --}}
        <form method="POST" action="{{ route('pegawai.aduan.store') }}" enctype="multipart/form-data" class="space-y-5 pt-6">
            @csrf

            {{-- Judul Aduan --}}
            <div>
                <label for="judul" class="block text-sm font-medium text-sihati-charcoal">
                    Judul Aduan <span class="text-sihati-error">*</span>
                </label>
                <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                    placeholder="Contoh: Printer tidak bisa mencetak" required
                    class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 {{ $errors->has('judul') ? 'border-sihati-error' : '' }}">
                @error('judul')
                    <p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Bidang + Kategori --}}
            @php $userBidang = auth()->user()->bidang; @endphp
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-sihati-charcoal">
                        Bidang <span class="text-sihati-error">*</span>
                    </label>
                    <div class="mt-1.5 flex items-center gap-2 rounded-md border border-sihati-hairline-strong bg-sihati-surface px-4 py-2.5 text-sm text-sihati-slate">
                        <svg class="h-4 w-4 flex-shrink-0 text-sihati-stone" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span class="font-medium text-sihati-ink">{{ $userBidang?->nama_bidang ?? '-' }}</span>
                    </div>
                    <input type="hidden" name="bidang_id" value="{{ $userBidang?->id }}">
                </div>
                <div>
                    <label for="category_id" class="block text-sm font-medium text-sihati-charcoal">
                        Kategori <span class="text-sihati-error">*</span>
                    </label>
                    <select name="category_id" id="category_id" required
                        class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 {{ $errors->has('category_id') ? 'border-sihati-error' : '' }}">
                        <option value="">Pilih kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Lokasi / Ruangan --}}
            <div>
                <label for="lokasi" class="block text-sm font-medium text-sihati-charcoal">Lokasi / Ruangan</label>
                <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}"
                    placeholder="Contoh: Ruang Bidang Anggaran Lt. 2"
                    class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 {{ $errors->has('lokasi') ? 'border-sihati-error' : '' }}">
                @error('lokasi')
                    <p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nomor Kontak --}}
            <div>
                <label for="no_kontak" class="block text-sm font-medium text-sihati-charcoal">Nomor Kontak</label>
                <input type="text" name="no_kontak" id="no_kontak" value="{{ old('no_kontak') }}"
                    placeholder="Contoh: 08123456789"
                    class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 {{ $errors->has('no_kontak') ? 'border-sihati-error' : '' }}">
                @error('no_kontak')
                    <p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi Masalah --}}
            <div>
                <label for="deskripsi" class="block text-sm font-medium text-sihati-charcoal">
                    Deskripsi Masalah <span class="text-sihati-error">*</span>
                </label>
                <textarea name="deskripsi" id="deskripsi" rows="4" placeholder="Jelaskan kendala yang dialami secara lengkap." required
                    class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 {{ $errors->has('deskripsi') ? 'border-sihati-error' : '' }}">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Lampiran (Dropzone) --}}
            <div>
                <label class="block text-sm font-medium text-sihati-charcoal">Lampiran (opsional)</label>
                <label for="attachments"
                    class="mt-1.5 flex cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-sihati-hairline-strong bg-sihati-surface-soft p-5 transition hover:border-sihati-primary hover:bg-sihati-lavender/20">
                    <svg class="mb-2 h-8 w-8 text-sihati-stone" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                    </svg>
                    <p class="text-sm font-medium text-sihati-charcoal">Upload lampiran</p>
                    <p class="mt-1 text-xs text-sihati-steel">Format JPG, PNG, WEBP, atau PDF. Maksimal 5 MB per file.</p>
                    <input type="file" id="attachments" name="attachments[]" class="hidden"
                        accept=".jpg,.jpeg,.png,.webp,.pdf" multiple>
                </label>
                <div id="attachmentPreview" class="mt-2 flex flex-wrap gap-2"></div>
                @error('attachments.*')
                    <p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex items-center justify-end gap-3 border-t border-sihati-hairline pt-6">
                <button type="button" onclick="closeAduanModal()"
                    class="rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
                    Batal
                </button>
                <button type="submit"
                    class="rounded-md bg-sihati-primary px-5 py-2 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">
                    Kirim Aduan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════════
     File Preview Popup (z-index above modal)
     ═══════════════════════════════════════════════════════════════ --}}
<div id="filePreviewPopup"
    class="fixed inset-0 z-[70] hidden items-center justify-center bg-black/60 p-4"
    onclick="if(event.target===this)closeFilePreview()">
    <div class="relative flex max-h-[90vh] w-full max-w-4xl flex-col rounded-xl bg-sihati-canvas shadow-modal">
        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-sihati-hairline px-5 py-3">
            <h3 id="filePreviewTitle" class="truncate pr-4 text-sm font-semibold text-sihati-ink">Preview Lampiran</h3>
            <button type="button" onclick="closeFilePreview()"
                class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-md text-sihati-stone transition hover:bg-sihati-surface hover:text-sihati-slate">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        {{-- Content (filled by JS) --}}
        <div id="filePreviewContent" class="flex min-h-[200px] items-center justify-center overflow-auto p-4"></div>
    </div>
</div>

@push('scripts')
<script>
    (function() {
        'use strict';

        /* ─── State ─────────────────────────────────────────── */
        var attachmentFiles = [];       // File objects
        var previewUrls    = [];        // blob: URLs for active previews

        var fileInput   = document.getElementById('attachments');
        var previewEl   = document.getElementById('attachmentPreview');
        var popup       = document.getElementById('filePreviewPopup');
        var popupTitle  = document.getElementById('filePreviewTitle');
        var popupBody   = document.getElementById('filePreviewContent');

        if (!fileInput) return; // safety – partial not present on page

        /* ─── Helpers ────────────────────────────────────────── */
        function formatSize(bytes) {
            if (bytes < 1024) return bytes + ' B';
            if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
            return (bytes / 1048576).toFixed(1) + ' MB';
        }

        function isImage(file) {
            return /\.(jpg|jpeg|png|webp)$/i.test(file.name) || file.type.startsWith('image/');
        }

        function isPdf(file) {
            return /\.pdf$/i.test(file.name) || file.type === 'application/pdf';
        }

        function isPreviewable(file) {
            return isImage(file) || isPdf(file);
        }

        function getIconSvg(file) {
            if (isImage(file)) {
                return '<svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.41a2.25 2.25 0 013.182 0l2.909 2.91m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>';
            }
            if (isPdf(file)) {
                return '<svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>';
            }
            return '<svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32a1.5 1.5 0 01-2.122-2.122L16.28 6.53"/></svg>';
        }

        /* ─── Build chips ────────────────────────────────────── */
        function renderChips() {
            if (!previewEl) return;
            previewEl.innerHTML = '';

            attachmentFiles.forEach(function(file, idx) {
                var chip = document.createElement('span');
                chip.className = 'inline-flex items-center gap-1.5 rounded-md bg-sihati-lavender px-3 py-1.5 text-sm text-sihati-primary-deep';

                var sizeText = formatSize(file.size);
                var canPrev  = isPreviewable(file);

                var parts = [];
                parts.push('<span class="flex-shrink-0">' + getIconSvg(file) + '</span>');
                parts.push('<span class="max-w-[140px] truncate sm:max-w-[200px]" title="' + file.name.replace(/"/g,'&quot;') + '">' + file.name + '</span>');
                parts.push('<span class="hidden text-xs text-sihati-steel sm:inline">(' + sizeText + ')</span>');

                if (canPrev) {
                    parts.push(
                        '<button type="button" onclick="openFilePreview(' + idx + ')"' +
                        ' class="ml-0.5 rounded px-1.5 py-0.5 text-xs font-medium text-sihati-link transition hover:bg-sihati-lavender/70 hover:text-sihati-link-pressed">' +
                        'Lihat</button>'
                    );
                }

                chip.innerHTML = parts.join('');
                previewEl.appendChild(chip);
            });
        }

        /* ─── File input change ──────────────────────────────── */
        fileInput.addEventListener('change', function() {
            attachmentFiles = Array.from(this.files || []);
            renderChips();
        });

        /* ─── Open preview ───────────────────────────────────── */
        window.openFilePreview = function(idx) {
            var file = attachmentFiles[idx];
            if (!file) return;

            popupTitle.textContent = file.name;

            var url = URL.createObjectURL(file);
            previewUrls.push(url);

            var html = '';

            if (isImage(file)) {
                html = '<img src="' + url + '" alt="' + file.name.replace(/"/g,'&quot;') + '"' +
                       ' class="max-h-[75vh] max-w-full rounded-lg object-contain" />';
            } else if (isPdf(file)) {
                html =
                    '<div class="flex flex-col items-center gap-4 py-6 text-center">' +
                        '<svg class="h-16 w-16 text-sihati-error" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.2">' +
                            '<path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>' +
                        '</svg>' +
                        '<p class="text-sm font-medium text-sihati-ink">' + file.name + '</p>' +
                        '<p class="text-xs text-sihati-steel">' + formatSize(file.size) + '</p>' +
                        '<a href="' + url + '" target="_blank" rel="noopener"' +
                        ' class="inline-flex items-center gap-2 rounded-md bg-sihati-primary px-5 py-2 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed">' +
                            '<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>' +
                            'Buka File' +
                        '</a>' +
                    '</div>';
            } else {
                html =
                    '<div class="flex flex-col items-center gap-3 py-8 text-center">' +
                        '<svg class="h-12 w-12 text-sihati-stone" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>' +
                        '<p class="text-sm text-sihati-steel">Format file tidak didukung untuk preview.</p>' +
                    '</div>';
            }

            popupBody.innerHTML = html;
            popup.classList.remove('hidden');
            popup.classList.add('flex');
            document.body.style.overflow = 'hidden';
        };

        /* ─── Close preview ──────────────────────────────────── */
        window.closeFilePreview = function() {
            popup.classList.add('hidden');
            popup.classList.remove('flex');
            popupBody.innerHTML = '';
            document.body.style.overflow = '';

            // Revoke blob URLs to free memory
            previewUrls.forEach(function(u) { URL.revokeObjectURL(u); });
            previewUrls = [];
        };

        /* ─── Close modal + reset files ──────────────────────── */
        window.closeAduanModal = function() {
            // Use the global closeModal (defined in app.js)
            if (typeof window.closeModal === 'function') {
                window.closeModal('buatAduanModal');
            } else {
                // Fallback if closeModal somehow missing
                var el = document.getElementById('buatAduanModal');
                if (el) {
                    el.classList.add('hidden');
                    el.classList.remove('flex');
                    document.body.style.overflow = '';
                }
            }

            // Close preview popup if open
            if (popup && !popup.classList.contains('hidden')) {
                window.closeFilePreview();
            }

            // Reset file input and chips
            attachmentFiles = [];
            if (previewEl) previewEl.innerHTML = '';
            if (fileInput) fileInput.value = '';
        };

        /* ─── Escape closes preview ──────────────────────────── */
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                if (popup && !popup.classList.contains('hidden')) {
                    window.closeFilePreview();
                    e.preventDefault();
                }
            }
        });

        /* ─── Open modal animation ───────────────────────────── */
        window.openBuatAduan = function() {
            var m = document.getElementById('buatAduanModal');
            if (!m) return;
            var c = m.querySelector('div:first-child');
            c.classList.remove('animate-slide-up');
            m.classList.remove('hidden');
            m.classList.add('flex');
            document.body.style.overflow = 'hidden';
            void c.offsetWidth;
            c.classList.add('animate-slide-up');
        };
    })();
</script>
@endpush
