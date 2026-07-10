<x-app-layout title="Data Pengguna - SIHATI BPPKAD">
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between pt-4">
    <div>
        <h1 class="text-xl md:text-2xl font-bold text-sihati-ink tracking-tight">Data Pengguna</h1>
        <p class="text-sihati-slate mt-1 text-sm">Kelola seluruh pengguna sistem.</p>
    </div>
    <button type="button" onclick="tambahUser()"
       class="inline-flex h-10 items-center gap-2 rounded-md bg-sihati-primary px-4 text-sm font-medium text-white transition hover:bg-sihati-primary-pressed">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Pengguna
    </button>
</div>

<div class="overflow-hidden rounded-lg border border-sihati-hairline bg-sihati-canvas shadow-subtle">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-sihati-hairline-soft">
            <thead class="bg-sihati-surface">
                <tr>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">No</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Nama</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Username</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Email</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Role</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Bidang</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Status</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-right text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-sihati-hairline-soft bg-sihati-canvas">
                @forelse ($users as $user)
                <tr class="transition hover:bg-sihati-surface-soft" data-user='{{ json_encode([
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                    'no_hp' => $user->no_hp,
                    'bidang' => $user->bidang?->nama_bidang,
                    'bidang_id' => $user->bidang_id,
                    'role' => $user->role,
                    'is_active' => $user->is_active,
                    'created_at' => $user->created_at?->format('d-m-Y H:i'),
                ]) }}'>
                    <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $users->firstItem() + $loop->index }}</td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-sm font-medium text-sihati-charcoal">{{ $user->name }}</td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $user->username }}</td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $user->email }}</td>
                    <td class="whitespace-nowrap px-4 py-3.5"><span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold bg-sihati-gray text-sihati-slate">{{ ucfirst($user->role) }}</span></td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $user->bidang?->nama_bidang ?? '-' }}</td>
                    <td class="whitespace-nowrap px-4 py-3.5">@if($user->is_active)<span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold bg-sihati-mint text-sihati-success">Aktif</span>@else<span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold bg-sihati-rose text-sihati-error">Nonaktif</span>@endif</td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button type="button" onclick="showUserDetail(this)" data-user='{{ json_encode([
                                'name' => $user->name,
                                'username' => $user->username,
                                'email' => $user->email,
                                'no_hp' => $user->no_hp,
                                'bidang' => $user->bidang?->nama_bidang,
                                'role' => $user->role,
                                'is_active' => $user->is_active,
                                'created_at' => $user->created_at?->format('d-m-Y H:i'),
                            ]) }}' class="rounded-md bg-sihati-primary px-3 py-1.5 text-xs font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed">Detail</button>
                            <button type="button" onclick="editUser(this)" data-user='{{ json_encode([
                                'id' => $user->id,
                                'name' => $user->name,
                                'username' => $user->username,
                                'email' => $user->email,
                                'no_hp' => $user->no_hp,
                                'bidang_id' => $user->bidang_id,
                                'role' => $user->role,
                                'is_active' => $user->is_active,
                            ]) }}' class="rounded-md bg-sihati-yellow-bold px-3 py-1.5 text-xs font-medium text-sihati-charcoal transition hover:bg-sihati-yellow">Edit</button>
                            @if (auth()->id() !== $user->id)
                            <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="button" onclick="confirmDelete('delete-form-{{ $user->id }}', 'pengguna {{ $user->name }}')" class="rounded-md bg-sihati-rose px-3 py-1.5 text-xs font-medium text-sihati-error transition hover:bg-red-200">Nonaktifkan</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="px-4 py-10 text-center text-sm text-sihati-slate">Belum ada data pengguna.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6">{{ $users->links() }}</div>

<div id="detailUserModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4">
    <div class="w-full max-w-lg rounded-xl bg-white p-6 shadow-modal animate-slide-up">
        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <h2 class="text-lg font-semibold text-gray-900">Detail Pengguna</h2>
            <button type="button" onclick="closeModal('detailUserModal')" class="rounded-md p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="space-y-4 py-5" id="detailUserContent"></div>
        <div class="flex justify-end border-t border-gray-200 pt-4">
            <button type="button" onclick="closeModal('detailUserModal')" class="rounded-md bg-gray-500 px-4 py-2 text-sm font-medium text-white hover:bg-gray-600">Tutup</button>
        </div>
    </div>
</div>

<div id="editUserModal" class="fixed inset-0 z-50 hidden items-start justify-center bg-black/40 px-4 overflow-y-auto">
    <div class="w-full max-w-lg rounded-xl bg-sihati-canvas p-6 shadow-modal animate-slide-up my-4 md:my-8">
        <div class="flex items-center justify-between border-b border-sihati-hairline pb-4">
            <h2 class="text-lg font-semibold text-sihati-ink">Edit Pengguna</h2>
            <button type="button" onclick="closeModal('editUserModal')" class="rounded-md p-1.5 text-sihati-stone hover:bg-sihati-surface">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="editUserForm" method="POST" class="space-y-4 pt-6">
            @csrf @method('PUT')
            <div>
                <label for="edit-name" class="block text-sm font-medium text-sihati-charcoal">Nama</label>
                <input type="text" name="name" id="edit-name" required
                    class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
            </div>
            <div>
                <label for="edit-username" class="block text-sm font-medium text-sihati-charcoal">Username</label>
                <input type="text" name="username" id="edit-username" required
                    class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
            </div>
            <div>
                <label for="edit-email" class="block text-sm font-medium text-sihati-charcoal">Email</label>
                <input type="email" name="email" id="edit-email" required
                    class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
            </div>
            <div>
                <label for="edit-no_hp" class="block text-sm font-medium text-sihati-charcoal">Nomor HP</label>
                <input type="text" name="no_hp" id="edit-no_hp"
                    class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
            </div>
            <div>
                <label for="edit-bidang_id" class="block text-sm font-medium text-sihati-charcoal">Bidang</label>
                <select name="bidang_id" id="edit-bidang_id"
                    class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                    <option value="">Pilih bidang</option>
                    @foreach ($bidangs as $b)
                    <option value="{{ $b->id }}">{{ $b->nama_bidang }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="edit-role" class="block text-sm font-medium text-sihati-charcoal">Role</label>
                <select name="role" id="edit-role" required
                    class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                    <option value="">Pilih role</option>
                    <option value="pegawai">Pegawai</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div>
                <label for="edit-password" class="block text-sm font-medium text-sihati-charcoal">Password Baru</label>
                <input type="password" name="password" id="edit-password"
                    class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                <p class="mt-1.5 text-xs text-sihati-stone">Kosongkan jika tidak ingin mengubah password.</p>
            </div>
            <div>
                <label for="edit-password_confirmation" class="block text-sm font-medium text-sihati-charcoal">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="edit-password_confirmation"
                    class="mt-1.5 block w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2.5 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
            </div>
            <div class="flex items-center gap-2 pt-1">
                <input type="checkbox" name="is_active" id="edit-is_active" value="1" checked
                    class="h-4 w-4 rounded border-sihati-hairline-strong text-sihati-primary focus:ring-sihati-primary/20">
                <label for="edit-is_active" class="text-sm text-sihati-charcoal">Akun aktif</label>
            </div>
            <div class="flex items-center justify-end gap-3 border-t border-sihati-hairline pt-4">
                <button type="button" onclick="closeModal('editUserModal')" class="rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2 text-sm font-medium text-sihati-ink hover:bg-sihati-surface">Batal</button>
                <button type="submit" class="rounded-md bg-sihati-primary px-4 py-2 text-sm font-medium text-sihati-on-primary hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="tambahUserModal" class="fixed inset-0 z-50 hidden items-start justify-center bg-black/40 px-4 overflow-y-auto">
    <div class="w-full max-w-lg rounded-xl bg-white p-6 shadow-modal my-4 md:my-8">
        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <h2 class="text-lg font-semibold text-gray-900">Tambah Pengguna</h2>
            <button type="button" onclick="closeModal('tambahUserModal')" class="rounded-md p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4 pt-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" required
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Nomor HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Bidang</label>
                <select name="bidang_id"
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <option value="">-- Pilih Bidang --</option>
                    @foreach ($bidangs as $b)
                    <option value="{{ $b->id }}" {{ old('bidang_id') == $b->id ? 'selected' : '' }}>{{ $b->nama_bidang }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" required
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <option value="">-- Pilih Role --</option>
                    <option value="pegawai" {{ old('role') === 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" required
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter, mengandung huruf besar/kecil dan angka.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1" checked class="rounded border-gray-300">
                <label class="text-sm text-gray-700">Akun aktif</label>
            </div>
            <div class="flex justify-end gap-3 border-t border-gray-200 pt-4">
                <button type="button" onclick="closeModal('tambahUserModal')" class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Batal</button>
                <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Simpan</button>
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

function tambahUser() {
    var m = document.getElementById('tambahUserModal');
    var c = m.querySelector('div:first-child');
    c.classList.remove('animate-slide-up');
    m.classList.remove('hidden'); m.classList.add('flex'); document.body.style.overflow = 'hidden';
    void c.offsetWidth; c.classList.add('animate-slide-up');
}

function showUserDetail(btn) {
    var u = JSON.parse(btn.getAttribute('data-user'));
    var fields = [
        { label: 'Nama', value: u.name },
        { label: 'Username', value: u.username },
        { label: 'Email', value: u.email },
        { label: 'Nomor HP', value: u.no_hp || '-' },
        { label: 'Bidang', value: u.bidang || '-' },
        { label: 'Role', value: u.role.charAt(0).toUpperCase() + u.role.slice(1) },
        { label: 'Status', value: u.is_active ? '<span class="px-2 py-0.5 text-xs font-semibold bg-green-100 text-green-700 rounded">Aktif</span>' : '<span class="px-2 py-0.5 text-xs font-semibold bg-red-100 text-red-700 rounded">Nonaktif</span>' },
        { label: 'Dibuat Pada', value: u.created_at || '-' }
    ];
    var html = '';
    fields.forEach(function(f) {
        html += '<div class="border-b border-gray-100 pb-3"><p class="text-xs text-gray-500">' + f.label + '</p><p class="mt-0.5 text-sm font-medium text-gray-900">' + f.value + '</p></div>';
    });
    document.getElementById('detailUserContent').innerHTML = html;
    var m = document.getElementById('detailUserModal');
    var c = m.querySelector('div:first-child');
    c.classList.remove('animate-slide-up');
    m.classList.remove('hidden'); m.classList.add('flex'); document.body.style.overflow = 'hidden';
    void c.offsetWidth; c.classList.add('animate-slide-up');
}

function editUser(btn) {
    var u = JSON.parse(btn.getAttribute('data-user'));
    document.getElementById('editUserForm').action = '{{ url('admin/users') }}/' + u.id;
    document.getElementById('edit-name').value = u.name;
    document.getElementById('edit-username').value = u.username;
    document.getElementById('edit-email').value = u.email;
    document.getElementById('edit-no_hp').value = u.no_hp || '';
    document.getElementById('edit-bidang_id').value = u.bidang_id || '';
    document.getElementById('edit-role').value = u.role;
    document.getElementById('edit-password').value = '';
    document.getElementById('edit-is_active').checked = u.is_active;
    var m = document.getElementById('editUserModal');
    var c = m.querySelector('div:first-child');
    c.classList.remove('animate-slide-up');
    m.classList.remove('hidden'); m.classList.add('flex'); document.body.style.overflow = 'hidden';
    void c.offsetWidth; c.classList.add('animate-slide-up');
}
</script>
@endpush
</x-app-layout>
