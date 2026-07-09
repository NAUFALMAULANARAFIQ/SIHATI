<x-app-layout title="Data Kategori - SIHATI BPPKAD">
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between pt-4">
    <div>
        <h1 class="text-xl md:text-2xl font-bold text-sihati-ink tracking-tight">Data Kategori</h1>
        <p class="text-sihati-slate mt-1 text-sm">Kelola seluruh kategori aduan.</p>
    </div>
    <button type="button" onclick="tambahKategori()"
       class="inline-flex h-10 items-center gap-2 rounded-md bg-sihati-primary px-4 text-sm font-medium text-white transition hover:bg-sihati-primary-pressed">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Kategori
    </button>
</div>

<div class="overflow-hidden rounded-lg border border-sihati-hairline bg-sihati-canvas shadow-subtle">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-sihati-hairline-soft">
            <thead class="bg-sihati-surface">
                <tr>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">No</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Nama Kategori</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Deskripsi</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Status</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-right text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-sihati-hairline-soft bg-sihati-canvas">
                @forelse ($categories as $category)
                <tr class="transition hover:bg-sihati-surface-soft">
                    <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $categories->firstItem() + $loop->index }}</td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-sm font-medium text-sihati-charcoal">{{ $category->nama_kategori }}</td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $category->deskripsi ?? '-' }}</td>
                    <td class="whitespace-nowrap px-4 py-3.5">@if($category->is_active)<span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold bg-sihati-mint text-sihati-success">Aktif</span>@else<span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold bg-sihati-rose text-sihati-error">Nonaktif</span>@endif</td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button type="button" onclick="showKategoriDetail(this)" data-kategori='{{ json_encode([
                                'nama_kategori' => $category->nama_kategori,
                                'deskripsi' => $category->deskripsi,
                                'is_active' => $category->is_active,
                                'created_at' => $category->created_at?->format('d-m-Y H:i'),
                            ]) }}' class="rounded-md bg-sihati-primary px-3 py-1.5 text-xs font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed">Detail</button>
                            <button type="button" onclick="editKategori(this)" data-kategori='{{ json_encode([
                                'id' => $category->id,
                                'nama_kategori' => $category->nama_kategori,
                                'deskripsi' => $category->deskripsi,
                                'is_active' => $category->is_active,
                            ]) }}' class="rounded-md bg-sihati-yellow-bold px-3 py-1.5 text-xs font-medium text-sihati-charcoal transition hover:bg-sihati-yellow">Edit</button>
                            <form id="delete-form-{{ $category->id }}" action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="button" onclick="confirmDelete('delete-form-{{ $category->id }}', 'kategori {{ $category->nama_kategori }}')" class="rounded-md bg-sihati-rose px-3 py-1.5 text-xs font-medium text-sihati-error transition hover:bg-red-200">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-4 py-10 text-center text-sm text-sihati-slate">Belum ada data kategori.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6">{{ $categories->links() }}</div>

<div id="detailKategoriModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4">
    <div class="w-full max-w-lg rounded-xl bg-white p-6 shadow-modal animate-slide-up">
        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <h2 class="text-lg font-semibold text-gray-900">Detail Kategori</h2>
            <button type="button" onclick="closeModal('detailKategoriModal')" class="rounded-md p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="space-y-4 py-5" id="detailKategoriContent"></div>
        <div class="flex justify-end border-t border-gray-200 pt-4">
            <button type="button" onclick="closeModal('detailKategoriModal')" class="rounded-md bg-gray-500 px-4 py-2 text-sm font-medium text-white hover:bg-gray-600">Tutup</button>
        </div>
    </div>
</div>

<div id="editKategoriModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-4 overflow-y-auto">
    <div class="w-full max-w-lg rounded-xl bg-sihati-canvas p-6 shadow-modal animate-slide-up my-4 md:my-8">
        <div class="flex items-center justify-between border-b border-sihati-hairline pb-4">
            <h2 class="text-lg font-semibold text-sihati-ink">Edit Kategori</h2>
            <button type="button" onclick="closeModal('editKategoriModal')" class="rounded-md p-1.5 text-sihati-stone hover:bg-sihati-surface">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="editKategoriForm" method="POST" class="space-y-4 pt-6">
            @csrf @method('PUT')
            <div>
                <label for="ek-nama" class="block text-sm font-medium text-sihati-charcoal">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="ek-nama" required
                    class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
            </div>
            <div>
                <label for="ek-deskripsi" class="block text-sm font-medium text-sihati-charcoal">Deskripsi</label>
                <textarea name="deskripsi" id="ek-deskripsi" rows="4"
                    class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20"></textarea>
            </div>
            <div class="flex items-center gap-2 pt-1">
                <input type="checkbox" name="is_active" id="ek-is_active" value="1"
                    class="h-4 w-4 rounded border-sihati-hairline-strong text-sihati-primary focus:ring-sihati-primary/20">
                <label for="ek-is_active" class="text-sm text-sihati-charcoal">Kategori aktif</label>
            </div>
            <div class="flex items-center justify-end gap-3 border-t border-sihati-hairline pt-4">
                <button type="button" onclick="closeModal('editKategoriModal')" class="rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2 text-sm font-medium text-sihati-ink hover:bg-sihati-surface">Batal</button>
                <button type="submit" class="rounded-md bg-sihati-primary px-4 py-2 text-sm font-medium text-sihati-on-primary hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="tambahKategoriModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-4 overflow-y-auto">
    <div class="w-full max-w-lg rounded-xl bg-sihati-canvas p-6 shadow-modal animate-slide-up my-4 md:my-8">
        <div class="flex items-center justify-between border-b border-sihati-hairline pb-4">
            <h2 class="text-lg font-semibold text-sihati-ink">Tambah Kategori</h2>
            <button type="button" onclick="closeModal('tambahKategoriModal')" class="rounded-md p-1.5 text-sihati-stone hover:bg-sihati-surface">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-4 pt-6">
            @csrf
            <div>
                <label for="tk-nama" class="block text-sm font-medium text-sihati-charcoal">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="tk-nama" value="{{ old('nama_kategori') }}" required
                    class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
            </div>
            <div>
                <label for="tk-deskripsi" class="block text-sm font-medium text-sihati-charcoal">Deskripsi</label>
                <textarea name="deskripsi" id="tk-deskripsi" rows="4"
                    class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">{{ old('deskripsi') }}</textarea>
            </div>
            <div class="flex items-center gap-2 pt-1">
                <input type="checkbox" name="is_active" value="1" checked
                    class="h-4 w-4 rounded border-sihati-hairline-strong text-sihati-primary focus:ring-sihati-primary/20">
                <label class="text-sm text-sihati-charcoal">Kategori aktif</label>
            </div>
            <div class="flex items-center justify-end gap-3 border-t border-sihati-hairline pt-4">
                <button type="button" onclick="closeModal('tambahKategoriModal')" class="rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2 text-sm font-medium text-sihati-ink hover:bg-sihati-surface">Batal</button>
                <button type="submit" class="rounded-md bg-sihati-primary px-4 py-2 text-sm font-medium text-sihati-on-primary hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">Simpan</button>
            </div>
        </form>
    </div>
</div>

@include('partials.delete-confirm-modal')

@push('scripts')
<script>
if (typeof window.closeModal !== 'function') {
    window.closeModal = function(id) {
        var el = document.getElementById(id);
        if (el) { el.classList.add('hidden'); el.classList.remove('flex'); document.body.style.overflow = ''; }
    };
}

function tambahKategori() {
    var m = document.getElementById('tambahKategoriModal');
    var c = m.querySelector('div:first-child');
    c.classList.remove('animate-slide-up');
    m.classList.remove('hidden'); m.classList.add('flex'); document.body.style.overflow = 'hidden';
    void c.offsetWidth; c.classList.add('animate-slide-up');
}

function showKategoriDetail(btn) {
    var d = JSON.parse(btn.getAttribute('data-kategori'));
    var fields = [
        { label: 'Nama Kategori', value: d.nama_kategori },
        { label: 'Deskripsi', value: d.deskripsi || '-' },
        { label: 'Status', value: d.is_active ? '<span class="px-2 py-0.5 text-xs font-semibold bg-green-100 text-green-700 rounded">Aktif</span>' : '<span class="px-2 py-0.5 text-xs font-semibold bg-red-100 text-red-700 rounded">Nonaktif</span>' },
        { label: 'Dibuat Pada', value: d.created_at || '-' }
    ];
    var html = '';
    fields.forEach(function(f) {
        html += '<div class="border-b border-gray-100 pb-3"><p class="text-xs text-gray-500">' + f.label + '</p><p class="mt-0.5 text-sm font-medium text-gray-900">' + f.value + '</p></div>';
    });
    document.getElementById('detailKategoriContent').innerHTML = html;
    var m = document.getElementById('detailKategoriModal');
    var c = m.querySelector('div:first-child');
    c.classList.remove('animate-slide-up');
    m.classList.remove('hidden'); m.classList.add('flex'); document.body.style.overflow = 'hidden';
    void c.offsetWidth; c.classList.add('animate-slide-up');
}

function editKategori(btn) {
    var d = JSON.parse(btn.getAttribute('data-kategori'));
    document.getElementById('editKategoriForm').action = '{{ url('admin/categories') }}/' + d.id;
    document.getElementById('ek-nama').value = d.nama_kategori;
    document.getElementById('ek-deskripsi').value = d.deskripsi || '';
    document.getElementById('ek-is_active').checked = d.is_active;
    var m = document.getElementById('editKategoriModal');
    var c = m.querySelector('div:first-child');
    c.classList.remove('animate-slide-up');
    m.classList.remove('hidden'); m.classList.add('flex'); document.body.style.overflow = 'hidden';
    void c.offsetWidth; c.classList.add('animate-slide-up');
}
</script>
@endpush
</x-app-layout>
