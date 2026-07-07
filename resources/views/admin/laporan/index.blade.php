<x-app-layout title="Laporan Aduan - SIHATI BPPKAD">
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between pt-4">
    <div>
        <h1 class="mt-1 text-2xl font-semibold tracking-[-0.02em] text-sihati-ink">Laporan Aduan</h1>
        <p class="mt-1 text-sm leading-6 text-sihati-slate">Rekap dan analisis seluruh aduan teknologi informasi.</p>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('admin.laporan.print') }}" class="inline-flex h-11 items-center justify-center gap-2 rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-5 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            Cetak PDF
        </a>
        <a href="{{ route('admin.laporan.export') }}" class="inline-flex h-11 items-center justify-center gap-2 rounded-md bg-sihati-primary px-5 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Export Excel
        </a>
    </div>
</div>

<div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
    <div class="rounded-lg bg-sihati-lavender p-5 shadow-subtle"><p class="text-sm font-medium text-sihati-primary-deep">Total Aduan</p><p class="mt-2 text-3xl font-semibold tracking-[-0.03em] text-sihati-charcoal">{{ $totalAduan }}</p></div>
    <div class="rounded-lg bg-sihati-mint p-5 shadow-subtle"><p class="text-sm font-medium text-sihati-success">Selesai</p><p class="mt-2 text-3xl font-semibold tracking-[-0.03em] text-sihati-charcoal">{{ $selesai }}</p></div>
    <div class="rounded-lg bg-sihati-sky p-5 shadow-subtle"><p class="text-sm font-medium text-sihati-link-pressed">Diproses</p><p class="mt-2 text-3xl font-semibold tracking-[-0.03em] text-sihati-charcoal">{{ $diproses }}</p></div>
    <div class="rounded-lg bg-sihati-peach p-5 shadow-subtle"><p class="text-sm font-medium text-sihati-orange">Diterima</p><p class="mt-2 text-3xl font-semibold tracking-[-0.03em] text-sihati-charcoal">{{ $diterima }}</p></div>
</div>

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
                @forelse ($aduans as $aduan)
                <tr class="transition hover:bg-sihati-surface-soft">
                    <td class="px-4 py-3.5 text-sm text-sihati-steel">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3.5 text-sm font-medium text-sihati-primary">{{ $aduan->nomor_tiket }}</td>
                    <td class="px-4 py-3.5 text-sm text-sihati-slate">{{ \Carbon\Carbon::parse($aduan->tanggal_aduan)->isoFormat('DD-MM-Y') }}</td>
                    <td class="px-4 py-3.5 text-sm text-sihati-charcoal">{{ $aduan->pelapor?->name ?? '-' }}</td>
                    <td class="px-4 py-3.5 text-sm text-sihati-slate">{{ $aduan->bidang?->nama_bidang ?? '-' }}</td>
                    <td class="px-4 py-3.5 text-sm text-sihati-slate">{{ $aduan->category?->nama_kategori ?? '-' }}</td>
                    <td class="px-4 py-3.5">@php $p = $aduan->priority?->nama_prioritas ?? 'Rendah'; $pC = match(strtolower($p)){'rendah'=>'bg-sihati-gray text-sihati-slate','sedang'=>'bg-sihati-sky text-sihati-link-pressed','tinggi'=>'bg-sihati-yellow-bold text-sihati-charcoal','mendesak'=>'bg-sihati-rose text-sihati-error',default=>'bg-sihati-gray text-sihati-slate'}; @endphp<span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $pC }}">{{ $p }}</span></td>
                    <td class="px-4 py-3.5">@php $s = $aduan->status?->nama_status ?? $aduan->status?->kode_status ?? 'diterima'; $sC = match(strtolower($s)){'diterima'=>'bg-sihati-lavender text-sihati-primary-deep','diproses'=>'bg-sihati-sky text-sihati-link-pressed','selesai'=>'bg-sihati-mint text-sihati-success',default=>'bg-sihati-gray text-sihati-slate'}; @endphp<span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $sC }}">{{ $s }}</span></td>
                    <td class="px-4 py-3.5 text-sm text-sihati-slate">{{ $aduan->petugas?->name ?? '-' }}</td>
                    <td class="px-4 py-3.5 text-sm text-sihati-slate">{{ $aduan->tanggal_selesai ? \Carbon\Carbon::parse($aduan->tanggal_selesai)->isoFormat('DD-MM-Y') : '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="10" class="px-4 py-10 text-center"><div class="mx-auto flex h-12 w-12 items-center justify-center rounded-lg bg-sihati-lavender"><svg class="h-6 w-6 text-sihati-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div><h3 class="mt-4 text-base font-semibold text-sihati-ink">Belum ada data laporan</h3><p class="mt-1 text-sm text-sihati-slate">Tidak ada aduan yang sesuai dengan filter yang dipilih.</p></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>
