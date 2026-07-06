<x-app-layout title="Daftar Aduan - SIHATI BPPKAD">
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="mt-1 text-2xl font-semibold tracking-[-0.02em] text-sihati-ink">Daftar Aduan</h1>
        <p class="mt-1 text-sm leading-6 text-sihati-slate">Kelola dan pantau seluruh aduan teknologi informasi.</p>
    </div>
</div>

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
                <tr class="transition hover:bg-sihati-surface-soft">
                    <td class="whitespace-nowrap px-4 py-3.5"><a href="{{ route('admin.aduan.show', $aduan) }}" class="text-sm font-medium text-sihati-primary hover:text-sihati-primary-pressed">{{ $aduan->nomor_tiket }}</a></td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-steel">{{ \Carbon\Carbon::parse($aduan->tanggal_aduan)->isoFormat('DD-MM-Y') }}</td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $aduan->pelapor?->name ?? '-' }}</td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $aduan->bidang?->nama_bidang ?? '-' }}</td>
                    <td class="max-w-[180px] px-4 py-3.5"><p class="truncate text-sm font-medium text-sihati-charcoal">{{ $aduan->judul }}</p></td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $aduan->category?->nama_kategori ?? '-' }}</td>
                    <td class="whitespace-nowrap px-4 py-3.5">@php $p = $aduan->priority?->nama_prioritas ?? 'Rendah'; $pC = match(strtolower($p)){'rendah'=>'bg-sihati-gray text-sihati-slate','sedang'=>'bg-sihati-sky text-sihati-link-pressed','tinggi'=>'bg-sihati-yellow-bold text-sihati-charcoal','mendesak'=>'bg-sihati-rose text-sihati-error',default=>'bg-sihati-gray text-sihati-slate'}; @endphp<span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $pC }}">{{ $p }}</span></td>
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
</x-app-layout>
