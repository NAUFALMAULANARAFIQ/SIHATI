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
                        <button type="button" onclick="openBuatAduan()" class="inline-flex items-center justify-center font-medium rounded-lg gap-2 transition-all bg-sihati-primary text-white hover:bg-sihati-primary-pressed px-6 py-3 text-base h-11 shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Buat Aduan
                        </button>
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
<div id="buatAduanModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4">
    <div class="w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-xl bg-white p-6 shadow-modal">
        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <h2 class="text-lg font-semibold text-gray-900">Buat Aduan Baru</h2>
            <button type="button" onclick="closeModal('buatAduanModal')" class="rounded-md p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('pegawai.aduan.store') }}" enctype="multipart/form-data" class="space-y-5 pt-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Judul Aduan <span class="text-red-500">*</span></label>
                <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Printer tidak bisa mencetak" required
                    class="mt-1.5 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Bidang <span class="text-red-500">*</span></label>
                    <select name="bidang_id" required
                        class="mt-1.5 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option value="">Pilih bidang</option>
                        @foreach ($bidangs as $b)
                        <option value="{{ $b->id }}" {{ old('bidang_id', auth()->user()->bidang_id) == $b->id ? 'selected' : '' }}>{{ $b->nama_bidang }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori <span class="text-red-500">*</span></label>
                    <select name="category_id" required
                        class="mt-1.5 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option value="">Pilih kategori</option>
                        @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Prioritas <span class="text-red-500">*</span></label>
                    <select name="priority_id"
                        class="mt-1.5 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option value="">Pilih prioritas</option>
                        @foreach ($priorities as $pr)
                        <option value="{{ $pr->id }}" {{ old('priority_id') == $pr->id ? 'selected' : '' }}>{{ $pr->nama_prioritas }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Lokasi / Ruangan</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Ruang Bidang Anggaran Lt. 2"
                        class="mt-1.5 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Nomor Kontak</label>
                <input type="text" name="no_kontak" value="{{ old('no_kontak') }}" placeholder="Contoh: 08123456789"
                    class="mt-1.5 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Deskripsi Masalah <span class="text-red-500">*</span></label>
                <textarea name="deskripsi" rows="4" placeholder="Jelaskan kendala yang dialami secara lengkap." required
                    class="mt-1.5 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">{{ old('deskripsi') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Lampiran (opsional)</label>
                <input type="file" name="attachments[]" multiple accept=".jpg,.jpeg,.png,.pdf"
                    class="mt-1.5 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p class="mt-1 text-xs text-gray-500">Format JPG, PNG, atau PDF. Maksimal 5 MB.</p>
            </div>

            <div class="flex justify-end gap-3 border-t border-gray-200 pt-5">
                <button type="button" onclick="closeModal('buatAduanModal')" class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Batal</button>
                <button type="submit" class="rounded-md bg-blue-600 px-5 py-2 text-sm font-medium text-white hover:bg-blue-700">Kirim Aduan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
if (typeof window.closeModal !== 'function') {
    window.closeModal = function(id) {
        var el = document.getElementById(id);
        if (el) { el.classList.add('hidden'); el.classList.remove('flex'); document.body.style.overflow = ''; }
    };
}

function openBuatAduan() {
    var m = document.getElementById('buatAduanModal');
    var c = m.querySelector('div:first-child');
    c.classList.remove('animate-slide-up');
    m.classList.remove('hidden'); m.classList.add('flex'); document.body.style.overflow = 'hidden';
    void c.offsetWidth; c.classList.add('animate-slide-up');
}
</script>
@endpush
</x-app-layout>
