<x-app-layout title="Data Bidang - SIHATI BPPKAD">
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-semibold tracking-[-0.02em] text-sihati-ink">Data Bidang</h1>
        <p class="mt-1 text-sm leading-6 text-sihati-slate">Kelola seluruh bidang di lingkungan BPPKAD.</p>
    </div>
    <button type="button" onclick="tambahBidang()"
       class="inline-flex h-10 items-center gap-2 rounded-md bg-sihati-primary px-4 text-sm font-medium text-white transition hover:bg-sihati-primary-pressed">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Bidang
    </button>
</div>

@if (session('success'))
    <div class="mb-4 rounded-md border border-sihati-success/30 bg-sihati-mint px-4 py-3 text-sm text-sihati-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="mb-4 rounded-md border border-sihati-error/30 bg-sihati-rose px-4 py-3 text-sm text-sihati-error">{{ session('error') }}</div>
@endif

<div class="overflow-hidden rounded-lg border border-sihati-hairline bg-sihati-canvas shadow-subtle">
    <div class="p-4 md:p-6">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="border px-3 py-2">No</th>
                    <th class="border px-3 py-2">Nama Bidang</th>
                    <th class="border px-3 py-2">Keterangan</th>
                    <th class="border px-3 py-2">Status</th>
                    <th class="border px-3 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bidangs as $bidang)
                <tr>
                    <td class="border px-3 py-2">{{ $bidangs->firstItem() + $loop->index }}</td>
                    <td class="border px-3 py-2">{{ $bidang->nama_bidang }}</td>
                    <td class="border px-3 py-2">{{ $bidang->keterangan ?? '-' }}</td>
                    <td class="border px-3 py-2">@if($bidang->is_active)<span class="px-2 py-1 text-sm bg-green-100 text-green-700 rounded">Aktif</span>@else<span class="px-2 py-1 text-sm bg-red-100 text-red-700 rounded">Nonaktif</span>@endif</td>
                    <td class="border px-3 py-2">
                        <div class="flex gap-2">
                            <button type="button" onclick="showBidangDetail(this)" data-bidang='{{ json_encode([
                                'nama_bidang' => $bidang->nama_bidang,
                                'keterangan' => $bidang->keterangan,
                                'is_active' => $bidang->is_active,
                                'created_at' => $bidang->created_at?->format('d-m-Y H:i'),
                            ]) }}' class="px-3 py-1 bg-gray-600 text-white rounded text-sm">Detail</button>
                            <button type="button" onclick="editBidang(this)" data-bidang='{{ json_encode([
                                'id' => $bidang->id,
                                'nama_bidang' => $bidang->nama_bidang,
                                'keterangan' => $bidang->keterangan,
                                'is_active' => $bidang->is_active,
                            ]) }}' class="px-3 py-1 bg-yellow-500 text-white rounded text-sm">Edit</button>
                            <form action="{{ route('admin.bidangs.destroy', $bidang) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus/nonaktifkan bidang ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded text-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="border px-3 py-4 text-center text-gray-500">Belum ada data bidang.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">{{ $bidangs->links() }}</div>
    </div>
</div>

<div id="detailBidangModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4">
    <div class="w-full max-w-lg rounded-xl bg-white p-6 shadow-modal animate-slide-up">
        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <h2 class="text-lg font-semibold text-gray-900">Detail Bidang</h2>
            <button type="button" onclick="closeModal('detailBidangModal')" class="rounded-md p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="space-y-4 py-5" id="detailBidangContent"></div>
        <div class="flex justify-end border-t border-gray-200 pt-4">
            <button type="button" onclick="closeModal('detailBidangModal')" class="rounded-md bg-gray-500 px-4 py-2 text-sm font-medium text-white hover:bg-gray-600">Tutup</button>
        </div>
    </div>
</div>

<div id="editBidangModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4">
    <div class="w-full max-w-lg rounded-xl bg-white p-6 shadow-modal">
        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <h2 class="text-lg font-semibold text-gray-900">Edit Bidang</h2>
            <button type="button" onclick="closeModal('editBidangModal')" class="rounded-md p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="editBidangForm" method="POST" class="space-y-4 pt-5">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Bidang</label>
                <input type="text" name="nama_bidang" id="eb-nama" required
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                <textarea name="keterangan" id="eb-keterangan" rows="4"
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"></textarea>
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" id="eb-is_active" value="1" class="rounded border-gray-300">
                <label class="text-sm text-gray-700">Bidang aktif</label>
            </div>
            <div class="flex justify-end gap-3 border-t border-gray-200 pt-4">
                <button type="button" onclick="closeModal('editBidangModal')" class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Batal</button>
                <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="tambahBidangModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4">
    <div class="w-full max-w-lg rounded-xl bg-white p-6 shadow-modal">
        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <h2 class="text-lg font-semibold text-gray-900">Tambah Bidang</h2>
            <button type="button" onclick="closeModal('tambahBidangModal')" class="rounded-md p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('admin.bidangs.store') }}" class="space-y-4 pt-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Bidang</label>
                <input type="text" name="nama_bidang" value="{{ old('nama_bidang') }}" required
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                <textarea name="keterangan" rows="4"
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">{{ old('keterangan') }}</textarea>
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1" checked class="rounded border-gray-300">
                <label class="text-sm text-gray-700">Bidang aktif</label>
            </div>
            <div class="flex justify-end gap-3 border-t border-gray-200 pt-4">
                <button type="button" onclick="closeModal('tambahBidangModal')" class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Batal</button>
                <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Simpan</button>
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

function tambahBidang() {
    var m = document.getElementById('tambahBidangModal');
    var c = m.querySelector('div:first-child');
    c.classList.remove('animate-slide-up');
    m.classList.remove('hidden'); m.classList.add('flex'); document.body.style.overflow = 'hidden';
    void c.offsetWidth; c.classList.add('animate-slide-up');
}

function showBidangDetail(btn) {
    var d = JSON.parse(btn.getAttribute('data-bidang'));
    var fields = [
        { label: 'Nama Bidang', value: d.nama_bidang },
        { label: 'Keterangan', value: d.keterangan || '-' },
        { label: 'Status', value: d.is_active ? '<span class="px-2 py-0.5 text-xs font-semibold bg-green-100 text-green-700 rounded">Aktif</span>' : '<span class="px-2 py-0.5 text-xs font-semibold bg-red-100 text-red-700 rounded">Nonaktif</span>' },
        { label: 'Dibuat Pada', value: d.created_at || '-' }
    ];
    var html = '';
    fields.forEach(function(f) {
        html += '<div class="border-b border-gray-100 pb-3"><p class="text-xs text-gray-500">' + f.label + '</p><p class="mt-0.5 text-sm font-medium text-gray-900">' + f.value + '</p></div>';
    });
    document.getElementById('detailBidangContent').innerHTML = html;
    var m = document.getElementById('detailBidangModal');
    var c = m.querySelector('div:first-child');
    c.classList.remove('animate-slide-up');
    m.classList.remove('hidden'); m.classList.add('flex'); document.body.style.overflow = 'hidden';
    void c.offsetWidth; c.classList.add('animate-slide-up');
}

function editBidang(btn) {
    var d = JSON.parse(btn.getAttribute('data-bidang'));
    document.getElementById('editBidangForm').action = '{{ url('admin/bidangs') }}/' + d.id;
    document.getElementById('eb-nama').value = d.nama_bidang;
    document.getElementById('eb-keterangan').value = d.keterangan || '';
    document.getElementById('eb-is_active').checked = d.is_active;
    var m = document.getElementById('editBidangModal');
    var c = m.querySelector('div:first-child');
    c.classList.remove('animate-slide-up');
    m.classList.remove('hidden'); m.classList.add('flex'); document.body.style.overflow = 'hidden';
    void c.offsetWidth; c.classList.add('animate-slide-up');
}
</script>
@endpush
</x-app-layout>
