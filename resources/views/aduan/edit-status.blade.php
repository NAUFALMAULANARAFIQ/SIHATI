@php
    $statusKey = $aduan->status?->kode_status ?? strtolower($aduan->status?->nama_status ?? '');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Status - {{ $aduan->nomor_tiket }} - SIHATI BPPKAD</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-sihati-surface text-sihati-ink font-notion antialiased min-h-screen">

    <main class="mx-auto max-w-2xl px-4 py-10">
        <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-6 shadow-card md:p-8">
            <div class="mb-6">
                <a href="{{ route('admin.aduan.show', $aduan->id) }}"
                    class="inline-flex items-center gap-1 text-sm text-sihati-steel hover:text-sihati-link">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke detail
                </a>
                <h1 class="mt-3 text-xl font-semibold tracking-[-0.02em] text-sihati-ink">Ubah Status Aduan</h1>
                <p class="mt-1.5 text-sm leading-6 text-sihati-slate">
                    Mengubah status untuk tiket <strong>{{ $aduan->nomor_tiket }}</strong>.
                    Status saat ini:
                    @php
                        $s = $aduan->status?->nama_status ?? $aduan->status?->kode_status ?? 'diterima';
                        $sKey = strtolower($s);
                        $sClasses = match($sKey) {
                            'diterima' => 'bg-sihati-lavender text-sihati-primary-deep',
                            'diproses' => 'bg-sihati-sky text-sihati-link-pressed',
                            'selesai' => 'bg-sihati-mint text-sihati-success',
                            default => 'bg-sihati-gray text-sihati-slate',
                        };
                    @endphp
                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $sClasses }} ml-1">{{ $s }}</span>
                </p>
            </div>

            <form method="POST" action="{{ route('admin.aduan.status.update', $aduan->id) }}" class="space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <label for="status" class="block text-sm font-medium text-sihati-charcoal">
                        Status Baru <span class="text-sihati-error">*</span>
                    </label>
                    <select id="status" name="status" data-status-select
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                        <option value="">Pilih status baru</option>
                        @foreach ($availableStatuses ?? [] as $st)
                            <option value="{{ $st->id }}" {{ $st->kode_status === $statusKey ? 'disabled' : '' }}>
                                {{ $st->nama_status }} {{ $st->kode_status === $statusKey ? '(saat ini)' : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div id="statusNote" style="display:none">
                    <label for="keterangan" class="block text-sm font-medium text-sihati-charcoal">Catatan Perubahan (opsional)</label>
                    <textarea id="keterangan" name="keterangan" rows="4"
                        placeholder="Tambahkan keterangan mengenai perubahan status ini..."
                        class="mt-1.5 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-3 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20"></textarea>
                </div>

                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                    <a href="{{ route('admin.aduan.show', $aduan->id) }}"
                        class="inline-flex h-11 items-center justify-center rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-5 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex h-11 items-center justify-center rounded-md bg-sihati-primary px-5 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>

    @stack('scripts')
</body>
</html>
