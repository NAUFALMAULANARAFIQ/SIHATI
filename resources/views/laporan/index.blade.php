<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laporan Aduan - SIHATI BPPKAD</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-sihati-surface text-sihati-ink font-notion antialiased min-h-screen">

    <header class="sticky top-0 z-20 border-b border-sihati-hairline bg-sihati-canvas">
        <div class="flex h-16 items-center justify-between px-4 md:px-6">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-md bg-sihati-primary text-sm font-bold text-white">SI</div>
                <div class="hidden sm:block">
                    <h1 class="text-sm font-semibold text-sihati-ink">SIHATI BPPKAD</h1>
                    <p class="text-[11px] text-sihati-steel">Sistem Helpdesk Aduan TI</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm text-sihati-slate">{{ auth()->user()?->name ?? 'Admin' }}</span>
                <div class="h-8 w-8 rounded-full bg-sihati-lavender flex items-center justify-center text-xs font-semibold text-sihati-primary-deep">
                    {{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 2)) }}
                </div>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-6 md:px-6 lg:px-8">

        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.08em] text-sihati-steel">Laporan</p>
                <h1 class="mt-1 text-2xl font-semibold tracking-[-0.02em] text-sihati-ink">Laporan Aduan</h1>
                <p class="mt-1 text-sm leading-6 text-sihati-slate">Rekap dan analisis seluruh aduan teknologi informasi.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.laporan.print') }}"
                    class="inline-flex h-11 items-center justify-center gap-2 rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-5 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Cetak PDF
                </a>
                <a href="#"
                    class="inline-flex h-11 items-center justify-center gap-2 rounded-md bg-sihati-primary px-5 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export Excel
                </a>
            </div>
        </div>

        {{-- Filter --}}
        <div class="mb-6 rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
            <form method="GET" action="{{ url()->current() }}">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
                    <div>
                        <label for="tgl_awal" class="block text-sm font-medium text-sihati-charcoal">Tanggal Awal</label>
                        <input type="date" id="tgl_awal" name="tgl_awal" value="{{ request('tgl_awal') }}"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                    </div>
                    <div>
                        <label for="tgl_akhir" class="block text-sm font-medium text-sihati-charcoal">Tanggal Akhir</label>
                        <input type="date" id="tgl_akhir" name="tgl_akhir" value="{{ request('tgl_akhir') }}"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                    </div>
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-sihati-charcoal">Kategori</label>
                        <select id="kategori" name="kategori"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories ?? [] as $cat)
                            <option value="{{ $cat->id }}" {{ request('kategori') == $cat->id ? 'selected' : '' }}>{{ $cat->nama_kategori ?? $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-sihati-charcoal">Status</label>
                        <select id="status" name="status"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                            <option value="">Semua Status</option>
                            @foreach ($statuses ?? [] as $st)
                            <option value="{{ $st->id }}" {{ request('status') == $st->id ? 'selected' : '' }}>{{ $st->nama_status ?? $st->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="bidang" class="block text-sm font-medium text-sihati-charcoal">Bidang</label>
                        <select id="bidang" name="bidang"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                            <option value="">Semua Bidang</option>
                            @foreach ($bidangs ?? [] as $bd)
                            <option value="{{ $bd->id }}" {{ request('bidang') == $bd->id ? 'selected' : '' }}>{{ $bd->nama_bidang ?? $bd->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="petugas" class="block text-sm font-medium text-sihati-charcoal">Petugas</label>
                        <select id="petugas" name="petugas"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                            <option value="">Semua Petugas</option>
                            @foreach ($petugasList ?? [] as $pt)
                            <option value="{{ $pt->id }}" {{ request('petugas') == $pt->id ? 'selected' : '' }}>{{ $pt->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end gap-3 xl:col-span-2">
                        <a href="{{ url()->current() }}"
                            class="inline-flex h-11 items-center justify-center rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-5 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
                            Reset Filter
                        </a>
                        <button type="submit"
                            class="inline-flex h-11 items-center justify-center rounded-md bg-sihati-primary px-5 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">
                            Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Stat Cards --}}
        <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-lg bg-sihati-lavender p-5 shadow-subtle">
                <p class="text-sm font-medium text-sihati-primary-deep">Total Aduan</p>
                <p class="mt-2 text-3xl font-semibold tracking-[-0.03em] text-sihati-charcoal">{{ $totalAduan ?? $stats->total ?? 0 }}</p>
            </div>
            <div class="rounded-lg bg-sihati-mint p-5 shadow-subtle">
                <p class="text-sm font-medium text-sihati-success">Selesai</p>
                <p class="mt-2 text-3xl font-semibold tracking-[-0.03em] text-sihati-charcoal">{{ $aduanSelesai ?? $stats->selesai ?? 0 }}</p>
            </div>
            <div class="rounded-lg bg-sihati-sky p-5 shadow-subtle">
                <p class="text-sm font-medium text-sihati-link-pressed">Diproses</p>
                <p class="mt-2 text-3xl font-semibold tracking-[-0.03em] text-sihati-charcoal">{{ $aduanDiproses ?? $stats->diproses ?? 0 }}</p>
            </div>
            <div class="rounded-lg bg-sihati-peach p-5 shadow-subtle">
                <p class="text-sm font-medium text-sihati-orange">Diterima</p>
                <p class="mt-2 text-3xl font-semibold tracking-[-0.03em] text-sihati-charcoal">{{ $aduanDiterima ?? $stats->diterima ?? 0 }}</p>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-hidden rounded-lg border border-sihati-hairline bg-sihati-canvas shadow-subtle">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-sihati-hairline-soft">
                    <thead class="bg-sihati-surface">
                        <tr>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">No</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">No. Tiket</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Tanggal</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Pelapor</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Bidang</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Kategori</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Prioritas</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Status</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Petugas</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Tgl. Selesai</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sihati-hairline-soft bg-sihati-canvas">
                        @forelse ($aduans ?? [] as $i => $aduan)
                        <tr class="transition hover:bg-sihati-surface-soft">
                            <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-steel">{{ $loop?->iteration ?? $i + 1 }}</td>
                            <td class="whitespace-nowrap px-4 py-3.5 text-sm font-medium text-sihati-primary">{{ $aduan->nomor_tiket }}</td>
                            <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">
                                {{ \Carbon\Carbon::parse($aduan->tanggal_aduan ?? $aduan->created_at)->isoFormat('DD-MM-Y') }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-charcoal">{{ $aduan->pelapor?->name ?? '-' }}</td>
                            <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $aduan->bidang?->nama_bidang ?? '-' }}</td>
                            <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $aduan->category?->nama_kategori ?? '-' }}</td>
                            <td class="whitespace-nowrap px-4 py-3.5">
                                @php
                                $p = $aduan->priority?->nama_prioritas ?? 'Rendah';
                                $pC = match(strtolower($p)) { 'rendah' => 'bg-sihati-gray text-sihati-slate', 'sedang' => 'bg-sihati-sky text-sihati-link-pressed', 'tinggi' => 'bg-sihati-yellow-bold text-sihati-charcoal', 'mendesak' => 'bg-sihati-rose text-sihati-error', default => 'bg-sihati-gray text-sihati-slate' };
                                @endphp
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $pC }}">{{ $p }}</span>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3.5">
                                @php
                                $s = $aduan->status?->nama_status ?? $aduan->status?->kode_status ?? 'diterima';
                                $sC = match(strtolower($s)) { 'diterima' => 'bg-sihati-lavender text-sihati-primary-deep', 'diproses' => 'bg-sihati-sky text-sihati-link-pressed', 'selesai' => 'bg-sihati-mint text-sihati-success', default => 'bg-sihati-gray text-sihati-slate' };
                                @endphp
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $sC }}">{{ $s }}</span>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $aduan->petugas?->name ?? '-' }}</td>
                            <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">
                                {{ $aduan->tanggal_selesai ? \Carbon\Carbon::parse($aduan->tanggal_selesai)->isoFormat('DD-MM-Y') : '-' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="px-4 py-10 text-center">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-lg bg-sihati-lavender">
                                    <svg class="h-6 w-6 text-sihati-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-base font-semibold text-sihati-ink">Belum ada data laporan</h3>
                                <p class="mt-1 text-sm text-sihati-slate">Tidak ada aduan yang sesuai dengan filter yang dipilih.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if (isset($aduans) && method_exists($aduans, 'links'))
        <div class="mt-6">{{ $aduans->links() }}</div>
        @endif
    </main>

    @stack('scripts')
</body>
</html>
