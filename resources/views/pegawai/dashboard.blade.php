@php
    $user = auth()->user();
    $hour = now()->hour;
    $greeting = $hour < 12 ? 'Selamat Pagi' : ($hour < 15 ? 'Selamat Siang' : ($hour < 18 ? 'Selamat Sore' : 'Selamat Malam'));
@endphp

<x-app-layout title="Dashboard - SIHATI BPPKAD">
<div class="space-y-6 animate-fade-in">

    <div class="animate-slide-up">
        <h1 class="text-xl md:text-2xl font-bold text-sihati-ink tracking-tight">{{ $greeting }}, {{ $user->name }}!</h1>
        <p class="text-sihati-slate mt-1 text-sm">{{ $user->bidang?->nama_bidang ?? '-' }}</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        <div class="stat-card animate-slide-up delay-100">
            <div class="flex items-center gap-4">
                <div class="stat-card-icon icon-bg-purple">
                    <svg class="w-5 h-5 text-sihati-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <div><p class="text-2xl font-bold text-sihati-ink">{{ $totalAduan }}</p><p class="text-sm text-sihati-slate">Total Aduan Saya</p></div>
            </div>
        </div>
        <div class="stat-card animate-slide-up delay-150">
            <div class="flex items-center gap-4">
                <div class="stat-card-icon icon-bg-blue">
                    <svg class="w-5 h-5 text-sihati-link" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div><p class="text-2xl font-bold text-sihati-ink">{{ $aduanDiterima }}</p><p class="text-sm text-sihati-slate">Diterima</p></div>
            </div>
        </div>
        <div class="stat-card animate-slide-up delay-200">
            <div class="flex items-center gap-4">
                <div class="stat-card-icon icon-bg-yellow">
                    <svg class="w-5 h-5 text-sihati-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                </div>
                <div><p class="text-2xl font-bold text-sihati-ink">{{ $aduanDiproses }}</p><p class="text-sm text-sihati-slate">Diproses</p></div>
            </div>
        </div>
        <div class="stat-card animate-slide-up delay-300">
            <div class="flex items-center gap-4">
                <div class="stat-card-icon icon-bg-green">
                    <svg class="w-5 h-5 text-sihati-success" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div><p class="text-2xl font-bold text-sihati-ink">{{ $aduanSelesai }}</p><p class="text-sm text-sihati-slate">Selesai</p></div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 animate-slide-up delay-100">
        <div class="bg-sihati-canvas rounded-xl border border-sihati-hairline shadow-soft p-5 md:p-7 card-hover">
            <div class="flex flex-col sm:flex-row items-stretch gap-4">
                <div class="w-14 h-14 rounded-xl bg-sihati-lavender flex items-center justify-center flex-shrink-0 self-start">
                    <svg class="w-7 h-7 text-sihati-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </div>
                <div class="flex-1 min-w-0 flex flex-col">
                    <h2 class="text-lg md:text-xl font-bold text-sihati-ink">Buat Aduan Baru</h2>
                    <p class="text-sihati-slate text-sm md:text-base mt-1 leading-relaxed">Laporkan kendala komputer, printer, jaringan, aplikasi, atau perangkat kerja.</p>
                    <div class="mt-4">
                        <a href="{{ route('pegawai.aduan.create') }}" class="inline-flex items-center justify-center font-medium rounded-lg gap-2 transition-all bg-sihati-primary text-white hover:bg-sihati-primary-pressed px-6 py-3 text-base h-11 shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Buat Aduan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-sihati-canvas rounded-xl border border-sihati-hairline shadow-soft p-5 md:p-7 card-hover">
            <div class="flex flex-col sm:flex-row items-stretch gap-4">
                <div class="w-14 h-14 rounded-xl bg-sihati-lavender flex items-center justify-center flex-shrink-0 self-start">
                    <svg class="w-7 h-7 text-sihati-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </div>
                <div class="flex-1 min-w-0 flex flex-col">
                    <h2 class="text-lg md:text-xl font-bold text-sihati-ink">Aduan Saya</h2>
                    <p class="text-sihati-slate text-sm md:text-base mt-1 leading-relaxed">Lihat status aduan yang sudah Anda kirimkan.</p>
                    <div class="mt-4">
                        <a href="{{ route('pegawai.aduan.index') }}" class="inline-flex items-center justify-center font-medium rounded-lg gap-2 transition-all bg-sihati-primary text-white hover:bg-sihati-primary-pressed px-6 py-3 text-base h-11 shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Cek Status
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(($aduanTerbaru ?? [])->count() > 0)
    <div class="bg-sihati-canvas rounded-xl border border-sihati-hairline shadow-soft">
        <div class="px-5 py-4 border-b border-sihati-hairline">
            <h2 class="text-lg font-semibold text-sihati-ink tracking-tight">Aduan Terbaru Saya</h2>
        </div>
        <div class="divide-y divide-sihati-hairline">
            @foreach($aduanTerbaru as $aduan)
            <a href="{{ route('pegawai.aduan.show', $aduan) }}" class="flex items-center justify-between px-5 py-4 table-row-hover">
                <div>
                    <p class="text-sm font-semibold text-sihati-primary">{{ $aduan->nomor_tiket }}</p>
                    <p class="text-sm text-sihati-ink">{{ $aduan->judul }}</p>
                    <p class="text-xs text-sihati-slate">{{ $aduan->category?->nama_kategori ?? '-' }} · {{ \Carbon\Carbon::parse($aduan->tanggal_aduan)->isoFormat('DD-MM-Y') }}</p>
                </div>
                @php $s = $aduan->status?->kode_status ?? 'diterima'; $badge = match($s){'diterima'=>'badge-diterima','diproses'=>'badge-diproses','selesai'=>'badge-selesai',default=>'badge-dibatalkan'}; @endphp
                <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full {{ $badge }}">{{ $aduan->status?->nama_status ?? 'Diterima' }}</span>
            </a>
            @endforeach
        </div>
        <div class="px-5 py-3 border-t border-sihati-hairline text-center">
            <a href="{{ route('pegawai.aduan.index') }}" class="text-sm text-sihati-primary hover:text-sihati-primary-pressed font-medium">Lihat Semua</a>
        </div>
    </div>
    @endif
</div>
</x-app-layout>
