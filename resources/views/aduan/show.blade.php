@php
    $role = auth()->user()?->role ?? 'pegawai';
    $isPegawai = $role === 'pegawai';
    $statusKey = $aduan->status?->kode_status ?? strtolower($aduan->status?->nama_status ?? '');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $aduan->nomor_tiket }} - SIHATI BPPKAD</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-sihati-surface text-sihati-ink font-notion antialiased min-h-screen">

    {{-- Simple top bar --}}
    <header class="sticky top-0 z-20 border-b border-sihati-hairline bg-sihati-canvas">
        <div class="flex h-16 items-center justify-between px-4 md:px-6">
            <div class="flex items-center gap-3">
                <a href="{{ route($isPegawai ? 'pegawai.aduan.index' : 'admin.aduan.index') }}"
                    class="flex h-9 w-9 items-center justify-center rounded-md text-sihati-slate hover:bg-sihati-surface">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div class="flex h-9 w-9 items-center justify-center rounded-md bg-sihati-primary text-sm font-bold text-white">SI</div>
                <div class="hidden sm:block">
                    <p class="text-sm font-semibold text-sihati-ink truncate max-w-[300px]">{{ $aduan->nomor_tiket }}</p>
                    <p class="text-[11px] text-sihati-steel">Detail Aduan</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm text-sihati-slate">{{ auth()->user()?->name ?? 'Pengguna' }}</span>
                <div class="h-8 w-8 rounded-full bg-sihati-lavender flex items-center justify-center text-xs font-semibold text-sihati-primary-deep">
                    {{ strtoupper(substr(auth()->user()?->name ?? 'U', 0, 2)) }}
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="mx-auto max-w-5xl px-4 py-6 md:px-6 lg:py-8">

        {{-- Breadcrumb --}}
        <nav class="mb-4 text-sm text-sihati-steel">
            <a href="{{ route($isPegawai ? 'pegawai.aduan.index' : 'admin.aduan.index') }}" class="hover:text-sihati-link">Aduan</a>
            <span class="mx-2">/</span>
            <span class="text-sihati-charcoal">{{ $aduan->nomor_tiket }}</span>
        </nav>

        {{-- Header Tiket --}}
        <div class="mb-6 rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle md:p-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <div class="flex-1">
                    <div class="flex flex-wrap items-center gap-3">
                        <h1 class="text-xl font-semibold tracking-[-0.02em] text-sihati-primary md:text-2xl">
                            {{ $aduan->nomor_tiket }}
                        </h1>
                        @php
                            $s = $aduan->status?->nama_status ?? $aduan->status?->kode_status ?? 'diterima';
                            $sKey = strtolower($s);
                            $sClasses = match($sKey) {
                                'diterima' => 'bg-sihati-lavender text-sihati-primary-deep',
                                'diproses' => 'bg-sihati-sky text-sihati-link-pressed',
                                'selesai' => 'bg-sihati-mint text-sihati-success',
                                default => 'bg-sihati-gray text-sihati-slate',
                            };
                            $p = $aduan->priority?->nama_prioritas ?? $aduan->prioritas ?? 'Rendah';
                            $pClasses = match(strtolower($p)) {
                                'rendah' => 'bg-sihati-gray text-sihati-slate',
                                'sedang' => 'bg-sihati-sky text-sihati-link-pressed',
                                'tinggi' => 'bg-sihati-yellow-bold text-sihati-charcoal',
                                'mendesak' => 'bg-sihati-rose text-sihati-error',
                                default => 'bg-sihati-gray text-sihati-slate',
                            };
                        @endphp
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $sClasses }}">{{ $s }}</span>
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $pClasses }}">{{ $p }}</span>
                    </div>
                    <h2 class="mt-3 text-lg font-semibold text-sihati-charcoal md:text-xl">{{ $aduan->judul }}</h2>
                    <p class="mt-1 text-sm text-sihati-steel">
                        Dibuat {{ \Carbon\Carbon::parse($aduan->tanggal_aduan ?? $aduan->created_at)->isoFormat('DD MMMM YYYY, HH:mm') }}
                    </p>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-wrap gap-2">
                    @if($isPegawai && $statusKey === 'selesai')
                        <button type="button" onclick="openModal('ratingModal')"
                            class="inline-flex h-10 items-center gap-1.5 rounded-md bg-sihati-yellow-bold px-4 text-sm font-medium text-sihati-charcoal transition hover:bg-sihati-yellow">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                            Beri Rating
                        </button>
                    @endif
                    @if(!$isPegawai)
                        <button type="button" onclick="openModal('updateStatusModal')"
                            class="inline-flex h-10 items-center gap-1.5 rounded-md bg-sihati-primary px-4 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Ubah Status
                        </button>
                    @endif
                </div>
            </div>
        </div>

        {{-- Two-Column Content --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            {{-- Left: Main Content --}}
            <div class="space-y-6 lg:col-span-2">

                {{-- Deskripsi --}}
                <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
                    <h3 class="text-sm font-semibold uppercase tracking-[0.06em] text-sihati-steel">Deskripsi Masalah</h3>
                    <div class="mt-3 text-sm leading-6 text-sihati-slate whitespace-pre-line">
                        {{ $aduan->deskripsi ?? 'Tidak ada deskripsi.' }}
                    </div>
                </div>

                {{-- Lampiran --}}
                @if(($aduan->attachments ?? $aduan->lampiran ?? null) && count($aduan->attachments ?? []) > 0)
                <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
                    <h3 class="text-sm font-semibold uppercase tracking-[0.06em] text-sihati-steel">Lampiran</h3>
                    <div class="mt-3 grid grid-cols-2 gap-3 sm:grid-cols-3">
                        @foreach ($aduan->attachments as $att)
                        <a href="{{ asset('storage/' . $att->file_path) }}" target="_blank"
                            class="flex items-center gap-2 rounded-md border border-sihati-hairline-soft p-3 text-sm transition hover:bg-sihati-surface-soft">
                            <svg class="h-5 w-5 flex-shrink-0 text-sihati-stone" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                            </svg>
                            <span class="truncate">{{ $att->file_name }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Catatan Penanganan --}}
                <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-sm font-semibold uppercase tracking-[0.06em] text-sihati-steel">Catatan Penanganan</h3>
                        @if(!$isPegawai)
                        <button type="button" onclick="openModal('addNoteModal')"
                            class="inline-flex items-center gap-1 rounded-md px-3 py-1.5 text-sm font-medium text-sihati-primary hover:bg-sihati-surface">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah
                        </button>
                        @endif
                    </div>
                    @include('aduan.partials.notes', ['notes' => $aduan->notes ?? $aduan->catatan ?? [], 'aduan' => $aduan])
                </div>

                {{-- Timeline Riwayat Status --}}
                <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
                    <h3 class="mb-4 text-sm font-semibold uppercase tracking-[0.06em] text-sihati-steel">Riwayat Status</h3>
                    @include('aduan.partials.timeline', ['histories' => $aduan->statusHistories ?? $aduan->riwayatStatus ?? []])
                </div>

                {{-- Komentar / Diskusi --}}
                <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
                    <h3 class="mb-4 text-sm font-semibold uppercase tracking-[0.06em] text-sihati-steel">Komentar &amp; Diskusi</h3>
                    @include('aduan.partials.comment-box', [
                        'comments' => $aduan->comments ?? $aduan->komentar ?? [],
                        'aduan' => $aduan,
                        'action' => route($isPegawai ? 'pegawai.aduan.comments.store' : 'admin.aduan.comments.store', $aduan->id),
                        'showAttachment' => true,
                    ])
                </div>
            </div>

            {{-- Right Sidebar: Info --}}
            <div class="space-y-4">
                {{-- Informasi Pelapor --}}
                <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
                    <h3 class="text-sm font-semibold uppercase tracking-[0.06em] text-sihati-steel">Informasi Pelapor</h3>
                    <div class="mt-3 space-y-3">
                        <div>
                            <p class="text-xs text-sihati-steel">Nama</p>
                            <p class="text-sm font-medium text-sihati-charcoal">{{ $aduan->pelapor?->name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-sihati-steel">Bidang</p>
                            <p class="text-sm text-sihati-charcoal">{{ $aduan->bidang?->nama_bidang ?? '-' }}</p>
                        </div>
                        @if($aduan->no_kontak)
                        <div>
                            <p class="text-xs text-sihati-steel">Kontak</p>
                            <p class="text-sm text-sihati-charcoal">{{ $aduan->no_kontak }}</p>
                        </div>
                        @endif
                        <div>
                            <p class="text-xs text-sihati-steel">Kategori</p>
                            <span class="mt-1 inline-flex items-center rounded-md bg-sihati-surface px-2.5 py-1 text-xs font-medium text-sihati-slate">
                                {{ $aduan->category?->nama_kategori ?? '-' }}
                            </span>
                        </div>
                        @if($aduan->lokasi)
                        <div>
                            <p class="text-xs text-sihati-steel">Lokasi</p>
                            <p class="text-sm text-sihati-charcoal">{{ $aduan->lokasi }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Informasi Penanganan --}}
                <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
                    <h3 class="text-sm font-semibold uppercase tracking-[0.06em] text-sihati-steel">Penanganan</h3>
                    <div class="mt-3 space-y-3">
                        @if($aduan->petugas)
                        <div>
                            <p class="text-xs text-sihati-steel">Petugas</p>
                            <p class="text-sm font-medium text-sihati-charcoal">{{ $aduan->petugas->name }}</p>
                        </div>
                        @endif
                        @if($aduan->tanggal_diterima)
                        <div>
                            <p class="text-xs text-sihati-steel">Diterima</p>
                            <p class="text-sm text-sihati-charcoal">{{ \Carbon\Carbon::parse($aduan->tanggal_diterima)->isoFormat('DD-MM-Y HH:mm') }}</p>
                        </div>
                        @endif
                        @if($aduan->tanggal_diproses)
                        <div>
                            <p class="text-xs text-sihati-steel">Diproses</p>
                            <p class="text-sm text-sihati-charcoal">{{ \Carbon\Carbon::parse($aduan->tanggal_diproses)->isoFormat('DD-MM-Y HH:mm') }}</p>
                        </div>
                        @endif
                        @if($aduan->tanggal_selesai)
                        <div>
                            <p class="text-xs text-sihati-steel">Selesai</p>
                            <p class="text-sm font-semibold text-sihati-success">{{ \Carbon\Carbon::parse($aduan->tanggal_selesai)->isoFormat('DD-MM-Y HH:mm') }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Modal: Update Status (Admin) --}}
    <div id="updateStatusModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4" data-modal-overlay="updateStatusModal">
        <div class="w-full max-w-lg rounded-xl bg-sihati-canvas p-6 shadow-modal">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-sihati-ink">Ubah Status Aduan</h2>
                <button type="button" onclick="closeModal('updateStatusModal')" class="rounded-md p-1.5 text-sihati-slate hover:bg-sihati-surface">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <p class="mt-2 text-sm leading-6 text-sihati-slate">
                Aduan: <strong>{{ $aduan->nomor_tiket }}</strong> — Status saat ini: <strong>{{ $s }}</strong>
            </p>

            <form method="POST" action="{{ route('admin.aduan.status.update', $aduan->id) }}" class="mt-5 space-y-4">
                @csrf
                @method('PATCH')
                <div>
                    <label for="status_baru" class="block text-sm font-medium text-sihati-charcoal">Status Baru <span class="text-sihati-error">*</span></label>
                    <select id="status_baru" name="status" data-status-select
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                        <option value="">Pilih status</option>
                        @foreach ($availableStatuses ?? [] as $st)
                            <option value="{{ $st->id }}" {{ $st->kode_status === $statusKey ? 'disabled' : '' }}>
                                {{ $st->nama_status }} {{ $st->kode_status === $statusKey ? '(saat ini)' : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div id="statusNote" style="display:none">
                    <label for="catatan_status" class="block text-sm font-medium text-sihati-charcoal">Catatan (opsional)</label>
                    <textarea id="catatan_status" name="keterangan" rows="3"
                        placeholder="Tambahkan catatan perubahan status..."
                        class="mt-1.5 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-3 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20"></textarea>
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeModal('updateStatusModal')"
                        class="rounded-md border border-sihati-hairline-strong px-4 py-2 text-sm font-medium text-sihati-ink hover:bg-sihati-surface">Batal</button>
                    <button type="submit"
                        class="rounded-md bg-sihati-primary px-4 py-2 text-sm font-medium text-sihati-on-primary hover:bg-sihati-primary-pressed">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal: Tambah Catatan (Admin) --}}
    <div id="addNoteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4" data-modal-overlay="addNoteModal">
        <div class="w-full max-w-lg rounded-xl bg-sihati-canvas p-6 shadow-modal">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-sihati-ink">Tambah Catatan Penanganan</h2>
                <button type="button" onclick="closeModal('addNoteModal')" class="rounded-md p-1.5 text-sihati-slate hover:bg-sihati-surface">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <p class="mt-2 text-sm text-sihati-slate">{{ $aduan->nomor_tiket }}</p>
            <form method="POST" action="{{ route('admin.aduan.notes.store', $aduan->id) }}" class="mt-5 space-y-4">
                @csrf
                <div>
                    <label for="catatan" class="block text-sm font-medium text-sihati-charcoal">Catatan <span class="text-sihati-error">*</span></label>
                    <textarea id="catatan" name="catatan" rows="4"
                        placeholder="Tulis catatan penanganan..."
                        class="mt-1.5 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-3 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20"></textarea>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeModal('addNoteModal')"
                        class="rounded-md border border-sihati-hairline-strong px-4 py-2 text-sm font-medium text-sihati-ink hover:bg-sihati-surface">Batal</button>
                    <button type="submit"
                        class="rounded-md bg-sihati-primary px-4 py-2 text-sm font-medium text-sihati-on-primary hover:bg-sihati-primary-pressed">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal: Rating (Pegawai) --}}
    <div id="ratingModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4" data-modal-overlay="ratingModal">
        <div class="w-full max-w-md rounded-xl bg-sihati-canvas p-6 shadow-modal">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-sihati-ink">Beri Penilaian</h2>
                <button type="button" onclick="closeModal('ratingModal')" class="rounded-md p-1.5 text-sihati-slate hover:bg-sihati-surface">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <p class="mt-2 text-sm text-sihati-slate">Beri penilaian untuk penanganan aduan <strong>{{ $aduan->nomor_tiket }}</strong></p>
            <form method="POST" action="{{ route('pegawai.aduan.ratings.store', $aduan->id) }}" class="mt-5 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-sihati-charcoal">Rating</label>
                    <div class="mt-2 flex items-center gap-2" id="starRating">
                        @for ($i = 1; $i <= 5; $i++)
                        <label class="cursor-pointer">
                            <input type="radio" name="rating" value="{{ $i }}" class="peer hidden" required>
                            <svg class="h-8 w-8 text-sihati-hairline-strong transition peer-checked:text-sihati-yellow-bold hover:text-sihati-yellow" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        </label>
                        @endfor
                    </div>
                </div>
                <div>
                    <label for="rating_komentar" class="block text-sm font-medium text-sihati-charcoal">Komentar (opsional)</label>
                    <textarea id="rating_komentar" name="komentar" rows="3"
                        placeholder="Tulis kesan Anda terhadap penanganan aduan..."
                        class="mt-1.5 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-3 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20"></textarea>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeModal('ratingModal')"
                        class="rounded-md border border-sihati-hairline-strong px-4 py-2 text-sm font-medium text-sihati-ink hover:bg-sihati-surface">Batal</button>
                    <button type="submit"
                        class="rounded-md bg-sihati-primary px-4 py-2 text-sm font-medium text-sihati-on-primary hover:bg-sihati-primary-pressed">Kirim Penilaian</button>
                </div>
            </form>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
