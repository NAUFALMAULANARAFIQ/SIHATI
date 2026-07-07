@php
    $user = auth()->user();
    $hour = now()->hour;
    $greeting = $hour < 12 ? 'Selamat Pagi' : ($hour < 15 ? 'Selamat Siang' : ($hour < 18 ? 'Selamat Sore' : 'Selamat Malam'));

    $stats = [
        'total' => $totalAduan,
        'baru' => $aduanDiterima,
        'diproses' => $aduanDiproses,
        'selesai' => $aduanSelesai,
    ];

    $kategori = \App\Models\Category::withCount('aduans')->get();
    $totalKategori = max($kategori->sum('aduans_count'), 1);
@endphp

<x-app-layout title="Dashboard Admin - SIHATI BPPKAD">
<div class="space-y-6 animate-fade-in">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-4">
        <div>
            <h1 class="text-xl md:text-2xl font-bold text-sihati-ink tracking-tight">{{ $greeting }}, {{ $user->name }}!</h1>
            <p class="text-sihati-slate mt-1 text-sm">Kelola dan pantau semua aduan teknologi informasi</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.laporan.index') }}" class="h-10 px-4 bg-sihati-canvas border border-sihati-hairline hover:border-sihati-primary text-sihati-ink font-medium rounded-lg flex items-center gap-2 transition-all text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Laporan
            </a>
            <a href="{{ route('admin.aduan.index') }}" class="h-10 px-4 bg-sihati-primary hover:bg-sihati-primary-pressed text-white font-medium rounded-lg flex items-center gap-2 transition-all shadow-lg text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                Semua Aduan
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
        <div class="stat-card animate-slide-up delay-100">
            <div class="flex items-center gap-4">
                <div class="stat-card-icon icon-bg-purple">
                    <svg class="w-5 h-5 text-sihati-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <div><p class="text-2xl font-bold text-sihati-ink">{{ $stats['total'] }}</p><p class="text-sm text-sihati-slate">Total Aduan</p></div>
            </div>
        </div>

        <div class="stat-card animate-slide-up delay-150">
            <div class="flex items-center gap-4">
                <div class="stat-card-icon icon-bg-blue">
                    <svg class="w-5 h-5 text-sihati-link" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div><p class="text-2xl font-bold text-sihati-ink">{{ $stats['baru'] }}</p><p class="text-sm text-sihati-slate">Diterima</p></div>
            </div>
        </div>

        <div class="stat-card animate-slide-up delay-200">
            <div class="flex items-center gap-4">
                <div class="stat-card-icon icon-bg-yellow">
                    <svg class="w-5 h-5 text-sihati-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                </div>
                <div><p class="text-2xl font-bold text-sihati-ink">{{ $stats['diproses'] }}</p><p class="text-sm text-sihati-slate">Diproses</p></div>
            </div>
        </div>

        <div class="stat-card animate-slide-up delay-300">
            <div class="flex items-center gap-4">
                <div class="stat-card-icon icon-bg-green">
                    <svg class="w-5 h-5 text-sihati-success" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div><p class="text-2xl font-bold text-sihati-ink">{{ $stats['selesai'] }}</p><p class="text-sm text-sihati-slate">Selesai</p></div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="bg-sihati-canvas rounded-xl border border-sihati-hairline shadow-soft">
                <div class="px-5 py-4 border-b border-sihati-hairline">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-semibold text-sihati-ink tracking-tight">Tiket Terbaru</h2>
                            <p class="text-sm text-sihati-slate mt-0.5">Daftar tiket aduan terbaru</p>
                        </div>
                        <a href="{{ route('admin.aduan.index') }}" class="text-sm text-sihati-primary hover:text-sihati-primary-pressed font-medium hidden sm:block">Lihat Semua</a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[600px]">
                        <thead>
                            <tr class="border-b border-sihati-hairline bg-sihati-surface/50">
                                <th class="text-left py-3 px-5 text-xs font-semibold text-sihati-slate uppercase tracking-wider">Tiket</th>
                                <th class="text-left py-3 px-5 text-xs font-semibold text-sihati-slate uppercase tracking-wider">Judul</th>
                                <th class="text-left py-3 px-5 text-xs font-semibold text-sihati-slate uppercase tracking-wider hidden md:table-cell">Pelapor</th>
                                <th class="text-left py-3 px-5 text-xs font-semibold text-sihati-slate uppercase tracking-wider">Status</th>
                                <th class="text-right py-3 px-5 text-xs font-semibold text-sihati-slate uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-sihati-hairline">
                            @forelse (($aduanTerbaru ?? [])->take(5) as $item)
                            <tr class="table-row-hover">
                                <td class="py-4 px-5"><span class="font-mono text-sm font-semibold text-sihati-primary">{{ $item->nomor_tiket }}</span></td>
                                <td class="py-4 px-5"><p class="text-sm font-medium text-sihati-ink truncate max-w-[180px]">{{ $item->judul }}</p></td>
                                <td class="py-4 px-5 hidden md:table-cell">
                                    <p class="text-sm font-medium text-sihati-ink">{{ $item->pelapor?->name ?? '-' }}</p>
                                    <p class="text-xs text-sihati-slate">{{ $item->bidang?->nama_bidang ?? '-' }}</p>
                                </td>
                                <td class="py-4 px-5">
                                    @php $s = $item->status?->kode_status ?? 'diterima'; $badge = match($s){'diterima'=>'badge-diterima','diproses'=>'badge-diproses','selesai'=>'badge-selesai',default=>'badge-dibatalkan'}; @endphp
                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full {{ $badge }}">{{ $item->status?->nama_status ?? 'Diterima' }}</span>
                                </td>
                                <td class="py-4 px-5 text-right">
                                    <a href="{{ route('admin.aduan.show', $item) }}" class="text-sm text-sihati-primary hover:text-sihati-primary-pressed font-medium">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="py-10 text-center text-sm text-sihati-slate">Belum ada aduan</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-sihati-canvas rounded-xl border border-sihati-hairline shadow-soft p-5">
                <h2 class="text-lg font-semibold text-sihati-ink mb-1 tracking-tight">Ringkasan Kategori</h2>
                <p class="text-sm text-sihati-slate mb-4">Distribusi aduan per kategori</p>
                <div class="space-y-4">
                    @foreach($kategori as $kat)
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-sihati-ink">{{ $kat->nama_kategori }}</span>
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-bold text-sihati-ink">{{ $kat->aduans_count }}</span>
                                <span class="text-xs text-sihati-slate">({{ $totalKategori > 0 ? round(($kat->aduans_count / $totalKategori) * 100) : 0 }}%)</span>
                            </div>
                        </div>
                        <div class="w-full bg-sihati-surface rounded-full h-2">
                            <div class="h-2 rounded-full bg-sihati-primary transition-all" style="width: {{ $totalKategori > 0 ? round(($kat->aduans_count / $totalKategori) * 100) : 0 }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-sihati-canvas rounded-xl border border-sihati-hairline shadow-soft p-5">
                <h2 class="text-lg font-semibold text-sihati-ink mb-4 tracking-tight">Aksi Cepat</h2>
                <div class="space-y-3">
                    <a href="{{ route('admin.aduan.index') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-sihati-surface border border-sihati-hairline transition-all group">
                        <div class="w-10 h-10 icon-bg-blue rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-sihati-link" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-sihati-ink">Semua Aduan</p>
                            <p class="text-xs text-sihati-slate">{{ $stats['total'] }} tiket total</p>
                        </div>
                        <svg class="w-4 h-4 text-sihati-slate flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>

                    <a href="{{ route('admin.laporan.index') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-sihati-surface border border-sihati-hairline transition-all group">
                        <div class="w-10 h-10 icon-bg-green rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-sihati-success" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-sihati-ink">Laporan</p>
                            <p class="text-xs text-sihati-slate">Cetak & export data</p>
                        </div>
                        <svg class="w-4 h-4 text-sihati-slate flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
