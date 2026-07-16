<x-app-layout title="Laporan Aduan - SIHATI BPPKAD">
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between pt-4">
    <div>
        <h1 class="text-xl md:text-2xl font-bold text-sihati-ink tracking-tight">Laporan Aduan</h1>
        <p class="text-sihati-slate mt-1 text-sm">Rekap dan analisis seluruh aduan teknologi informasi.</p>
    </div>
    <div class="flex flex-wrap items-center gap-3">
        <form id="filterForm" method="GET" action="{{ route('admin.laporan.index') }}" class="flex flex-wrap items-center gap-2">
            <div class="relative" id="periodeDropdown">
                <button type="button" onclick="toggleDropdown()"
                    class="inline-flex h-10 items-center justify-between gap-2 rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-3 text-sm text-sihati-ink min-w-[180px] focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                    <span id="dropdownLabel">
                        @php
                            $labelMap = ['semua' => 'Semua Periode', 'hari_ini' => 'Hari Ini', '3_hari' => '3 Hari Terakhir', '7_hari' => '7 Hari Terakhir', '1_bulan' => '1 Bulan Terakhir', 'custom' => 'Pilih Tanggal Sendiri'];
                            $selectedPeriode = $request->periode ?? 'semua';
                        @endphp
                        {{ $labelMap[$selectedPeriode] ?? 'Semua Periode' }}
                    </span>
                    <svg class="h-4 w-4 text-sihati-stone" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div id="dropdownMenu" class="absolute left-0 top-full mt-1 z-50 hidden min-w-[220px] rounded-lg border border-sihati-hairline bg-sihati-canvas p-1.5 shadow-modal">
                    @foreach (['semua' => 'Semua Periode', 'hari_ini' => 'Hari Ini', '3_hari' => '3 Hari Terakhir', '7_hari' => '7 Hari Terakhir', '1_bulan' => '1 Bulan Terakhir'] as $val => $label)
                    <button type="button" onclick="selectPreset('{{ $val }}')"
                        class="block w-full rounded-md px-3 py-2 text-left text-sm transition hover:bg-sihati-surface {{ ($request->periode ?? 'semua') === $val ? 'bg-sihati-lavender font-medium text-sihati-primary' : 'text-sihati-ink' }}">
                        {{ $label }}
                    </button>
                    @endforeach
                    <div class="my-1 border-t border-sihati-hairline"></div>
                    <button type="button" onclick="selectCustom()"
                        class="block w-full rounded-md px-3 py-2 text-left text-sm transition hover:bg-sihati-surface {{ $request->periode === 'custom' ? 'bg-sihati-lavender font-medium text-sihati-primary' : 'text-sihati-ink' }}">
                        Pilih Tanggal Sendiri
                    </button>
                    <div id="customDateFields" class="{{ $request->periode === 'custom' ? 'block' : 'hidden' }} space-y-2 px-1 pb-2 pt-1">
                        <div class="flex items-center gap-2 text-sm">
                            <input type="date" id="tanggal_dari" name="tanggal_dari" value="{{ $request->tanggal_dari }}"
                                class="h-9 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-2 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                            <span class="text-sihati-stone">—</span>
                            <input type="date" id="tanggal_sampai" name="tanggal_sampai" value="{{ $request->tanggal_sampai }}"
                                class="h-9 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-2 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                        </div>
                        <button type="submit" class="w-full rounded-md bg-sihati-primary py-1.5 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed">
                            Terapkan
                        </button>
                    </div>
                </div>
                <input type="hidden" id="periode" name="periode" value="{{ $request->periode ?? 'semua' }}">
            </div>
            @if(request()->anyFilled(['tanggal_dari', 'tanggal_sampai']) || ($request->periode ?? 'semua') !== 'semua')
            <a href="{{ route('admin.laporan.index') }}" class="inline-flex h-10 items-center justify-center rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-3 text-sm font-medium text-sihati-slate transition hover:bg-sihati-surface">
                Reset
            </a>
            @endif
        </form>
        <button type="button" onclick="openPrintModal()" class="inline-flex h-11 items-center justify-center gap-2 rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-5 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            Cetak PDF
        </button>
        <a href="{{ route('admin.laporan.export', $request->only(['status', 'category', 'priority', 'bidang', 'petugas', 'periode', 'tanggal_dari', 'tanggal_sampai'])) }}" class="inline-flex h-11 items-center justify-center gap-2 rounded-md bg-sihati-primary px-5 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed">
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
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Tgl. Selesai</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-sihati-hairline-soft bg-sihati-canvas">
                @forelse ($aduans as $aduan)
                <tr class="transition hover:bg-sihati-surface-soft">
                    <td class="px-4 py-3.5 text-sm text-sihati-steel">{{ $aduans->firstItem() + $loop->index }}</td>
                    <td class="px-4 py-3.5 text-sm font-medium text-sihati-primary">{{ $aduan->nomor_tiket }}</td>
                    <td class="px-4 py-3.5 text-sm text-sihati-slate">{{ \Carbon\Carbon::parse($aduan->tanggal_aduan)->isoFormat('DD-MM-Y') }}</td>
                    <td class="px-4 py-3.5 text-sm text-sihati-charcoal">{{ $aduan->pelapor?->name ?? '-' }}</td>
                    <td class="px-4 py-3.5 text-sm text-sihati-slate">{{ $aduan->bidang?->nama_bidang ?? '-' }}</td>
                    <td class="px-4 py-3.5 text-sm text-sihati-slate">{{ $aduan->category?->nama_kategori ?? '-' }}</td>
                    <td class="px-4 py-3.5">@php $p = $aduan->priority?->nama_prioritas ?? '-'; $pC = $p === '-' ? 'bg-sihati-gray text-sihati-stone italic' : match(strtolower($p)){'rendah'=>'bg-sihati-gray text-sihati-slate','sedang'=>'bg-sihati-sky text-sihati-link-pressed','tinggi'=>'bg-sihati-yellow-bold text-sihati-charcoal','mendesak'=>'bg-sihati-rose text-sihati-error',default=>'bg-sihati-gray text-sihati-slate'}; @endphp<span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $pC }}">{{ $p }}</span></td>
                    <td class="px-4 py-3.5">@php $s = $aduan->status?->nama_status ?? $aduan->status?->kode_status ?? 'diterima'; $sC = match(strtolower($s)){'diterima'=>'bg-sihati-lavender text-sihati-primary-deep','diproses'=>'bg-sihati-sky text-sihati-link-pressed','selesai'=>'bg-sihati-mint text-sihati-success',default=>'bg-sihati-gray text-sihati-slate'}; @endphp<span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $sC }}">{{ $s }}</span></td>
                    <td class="px-4 py-3.5 text-sm text-sihati-slate">{{ $aduan->tanggal_selesai ? \Carbon\Carbon::parse($aduan->tanggal_selesai)->isoFormat('DD-MM-Y') : '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="9" class="px-4 py-10 text-center"><div class="mx-auto flex h-12 w-12 items-center justify-center rounded-lg bg-sihati-lavender"><svg class="h-6 w-6 text-sihati-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div><h3 class="mt-4 text-base font-semibold text-sihati-ink">Belum ada data laporan</h3><p class="mt-1 text-sm text-sihati-slate">Tidak ada aduan yang sesuai dengan filter yang dipilih.</p></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($aduans->hasPages())
    <div class="border-t border-sihati-hairline px-4 py-3">
        {{ $aduans->links() }}
    </div>
    @endif
</div>

<div id="printConfirmModal" class="fixed inset-0 z-[90] hidden items-center justify-center bg-black/40 p-4"
    onclick="if(event.target===this)closePrintModal()">
    <div class="w-full max-w-sm animate-scale-in rounded-xl bg-sihati-canvas p-6 shadow-modal">
        <div class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-sihati-lavender">
                <svg class="h-5 w-5 text-sihati-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-sihati-ink">Konfirmasi Cetak</h3>
        </div>
        <p id="printConfirmMessage" class="mt-3 text-sm leading-relaxed text-sihati-slate">
            Apakah Anda yakin ingin mencetak laporan dengan periode ini?
        </p>
        <div class="mt-6 flex items-center justify-end gap-3">
            <button type="button" onclick="closePrintModal()"
                class="rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
                Batal
            </button>
            <a id="printConfirmLink" href="{{ route('admin.laporan.print', $request->only(['status', 'category', 'priority', 'bidang', 'petugas', 'periode', 'tanggal_dari', 'tanggal_sampai'])) }}"
                class="rounded-md bg-sihati-primary px-5 py-2 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">
                Yakin
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
function openPrintModal() {
    document.getElementById('printConfirmModal').classList.remove('hidden');
    document.getElementById('printConfirmModal').classList.add('flex');
}

function closePrintModal() {
    document.getElementById('printConfirmModal').classList.add('hidden');
    document.getElementById('printConfirmModal').classList.remove('flex');
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        var modal = document.getElementById('printConfirmModal');
        if (modal && !modal.classList.contains('hidden')) closePrintModal();
        var dd = document.getElementById('dropdownMenu');
        if (dd && !dd.classList.contains('hidden')) dd.classList.add('hidden');
    }
});

document.addEventListener('click', function(e) {
    var dd = document.getElementById('periodeDropdown');
    var menu = document.getElementById('dropdownMenu');
    if (dd && menu && !dd.contains(e.target)) menu.classList.add('hidden');
});

function toggleDropdown() {
    document.getElementById('dropdownMenu').classList.toggle('hidden');
}

var labelMap = {
    'semua': 'Semua Periode', 'hari_ini': 'Hari Ini', '3_hari': '3 Hari Terakhir',
    '7_hari': '7 Hari Terakhir', '1_bulan': '1 Bulan Terakhir', 'custom': 'Pilih Tanggal Sendiri'
};

function selectPreset(val) {
    var form = document.getElementById('filterForm');
    document.getElementById('periode').value = val;
    document.getElementById('dropdownMenu').classList.add('hidden');
    document.getElementById('customDateFields').classList.add('hidden');

    if (val === 'semua') {
        document.getElementById('tanggal_dari').value = '';
        document.getElementById('tanggal_sampai').value = '';
        form.submit();
        return;
    }

    var today = new Date();
    var dari, sampai;

    switch (val) {
        case 'hari_ini': dari = sampai = today; break;
        case '3_hari': dari = new Date(today); dari.setDate(dari.getDate() - 3); sampai = today; break;
        case '7_hari': dari = new Date(today); dari.setDate(dari.getDate() - 7); sampai = today; break;
        case '1_bulan': dari = new Date(today); dari.setMonth(dari.getMonth() - 1); sampai = today; break;
    }

    function fmt(d) {
        return d.getFullYear() + '-' + String(d.getMonth()+1).padStart(2,'0') + '-' + String(d.getDate()).padStart(2,'0');
    }

    document.getElementById('tanggal_dari').value = fmt(dari);
    document.getElementById('tanggal_sampai').value = fmt(sampai);
    form.submit();
}

function selectCustom() {
    document.getElementById('periode').value = 'custom';
    document.getElementById('customDateFields').classList.remove('hidden');
    document.getElementById('dropdownLabel').textContent = 'Pilih Tanggal Sendiri';
    document.getElementById('dropdownMenu').classList.remove('hidden');
}
</script>
@endpush
</x-app-layout>