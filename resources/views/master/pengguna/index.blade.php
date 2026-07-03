@php
$judulHalaman = 'Data Pengguna';
$deskripsiHalaman = 'Kelola seluruh pengguna aplikasi SIHATI BPPKAD.';
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $judulHalaman }} - SIHATI BPPKAD</title>
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
                <p class="text-xs font-semibold uppercase tracking-[0.08em] text-sihati-steel">Master Data</p>
                <h1 class="mt-1 text-2xl font-semibold tracking-[-0.02em] text-sihati-ink">{{ $judulHalaman }}</h1>
                <p class="mt-1 text-sm leading-6 text-sihati-slate">{{ $deskripsiHalaman }}</p>
            </div>
            <button type="button" onclick="openModal('createModal')"
                class="inline-flex h-11 items-center justify-center gap-2 rounded-md bg-sihati-primary px-5 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Pengguna
            </button>
        </div>

        <div class="mb-6 rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
            <form method="GET" action="{{ url()->current() }}">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                    <div>
                        <label for="cari" class="block text-sm font-medium text-sihati-charcoal">Cari</label>
                        <input type="text" id="cari" name="cari" value="{{ request('cari') }}"
                            placeholder="Nama, username, atau email"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                    </div>
                    <div>
                        <label for="role" class="block text-sm font-medium text-sihati-charcoal">Role</label>
                        <select id="role" name="role"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                            <option value="">Semua Role</option>
                            <option value="pegawai" {{ request('role') == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
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
                    <div class="flex items-end gap-3">
                        <a href="{{ url()->current() }}"
                            class="inline-flex h-11 items-center justify-center rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
                            Reset
                        </a>
                        <button type="submit"
                            class="inline-flex h-11 items-center justify-center rounded-md bg-sihati-primary px-4 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed">
                            Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="overflow-hidden rounded-lg border border-sihati-hairline bg-sihati-canvas shadow-subtle">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-sihati-hairline-soft">
                    <thead class="bg-sihati-surface">
                        <tr>
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
                        @forelse ($users ?? [] as $user)
                        <tr class="transition hover:bg-sihati-surface-soft">
                            <td class="whitespace-nowrap px-4 py-3.5 text-sm font-medium text-sihati-charcoal">{{ $user->name ?? $user->nama }}</td>
                            <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $user->username ?? '-' }}</td>
                            <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $user->email ?? '-' }}</td>
                            <td class="whitespace-nowrap px-4 py-3.5">
                                @php
                                $roleLabel = $user->role ?? 'pegawai';
                                $roleBadge = $roleLabel === 'admin' ? 'bg-sihati-lavender text-sihati-primary-deep' : 'bg-sihati-gray text-sihati-slate';
                                @endphp
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $roleBadge }}">
                                    {{ ucfirst($roleLabel) }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $user->bidang?->nama_bidang ?? '-' }}</td>
                            <td class="whitespace-nowrap px-4 py-3.5">
                                @php
                                $isActive = $user->is_active ?? true;
                                @endphp
                                <span class="inline-flex items-center gap-1.5 text-sm {{ $isActive ? 'text-sihati-success' : 'text-sihati-error' }}">
                                    <span class="h-2 w-2 rounded-full {{ $isActive ? 'bg-sihati-success' : 'bg-sihati-error' }}"></span>
                                    {{ $isActive ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3.5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" onclick="openModal('editModal{{ $user->id }}')"
                                        class="rounded-md px-3 py-1.5 text-sm font-medium text-sihati-link transition hover:bg-sihati-surface">
                                        Edit
                                    </button>
                                    <button type="button" onclick="openModal('deleteModal{{ $user->id }}')"
                                        class="rounded-md px-3 py-1.5 text-sm font-medium text-sihati-error transition hover:bg-sihati-rose">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-4 py-10 text-center">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-lg bg-sihati-lavender">
                                    <svg class="h-6 w-6 text-sihati-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-base font-semibold text-sihati-ink">Belum ada pengguna</h3>
                                <p class="mt-1 text-sm text-sihati-slate">Pengguna yang ditambahkan akan tampil di halaman ini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if (isset($users) && method_exists($users, 'links'))
        <div class="mt-6">{{ $users->links() }}</div>
        @endif
    </main>

    {{-- Modal: Tambah Pengguna --}}
    <div id="createModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4" data-modal-overlay="createModal">
        <div class="w-full max-w-lg rounded-xl bg-sihati-canvas p-6 shadow-modal">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-sihati-ink">Tambah Pengguna</h2>
                <button type="button" onclick="closeModal('createModal')" class="rounded-md p-1.5 text-sihati-slate hover:bg-sihati-surface">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form method="POST" action="{{ $storeRoute ?? '#' }}" class="mt-5 space-y-4">
                @csrf
                <div>
                    <label for="nama" class="block text-sm font-medium text-sihati-charcoal">Nama Lengkap <span class="text-sihati-error">*</span></label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20"
                        placeholder="Masukkan nama lengkap">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="username" class="block text-sm font-medium text-sihati-charcoal">Username <span class="text-sihati-error">*</span></label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20"
                            placeholder="Username">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-sihati-charcoal">Email <span class="text-sihati-error">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20"
                            placeholder="Email">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="role" class="block text-sm font-medium text-sihati-charcoal">Role <span class="text-sihati-error">*</span></label>
                        <select id="role" name="role"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                            <option value="pegawai">Pegawai</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div>
                        <label for="bidang_id" class="block text-sm font-medium text-sihati-charcoal">Bidang</label>
                        <select id="bidang_id" name="bidang_id"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                            <option value="">Pilih Bidang</option>
                            @foreach ($bidangs ?? [] as $bd)
                            <option value="{{ $bd->id }}">{{ $bd->nama_bidang ?? $bd->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-sihati-charcoal">Password <span class="text-sihati-error">*</span></label>
                    <input type="password" id="password" name="password"
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20"
                        placeholder="Minimal 8 karakter">
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeModal('createModal')"
                        class="rounded-md border border-sihati-hairline-strong px-4 py-2 text-sm font-medium text-sihati-ink hover:bg-sihati-surface">Batal</button>
                    <button type="submit"
                        class="rounded-md bg-sihati-primary px-4 py-2 text-sm font-medium text-sihati-on-primary hover:bg-sihati-primary-pressed">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modals: Edit & Delete (dummy untuk setiap user) --}}
    @foreach ($users ?? [] as $user)
    <div id="editModal{{ $user->id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4" data-modal-overlay="editModal{{ $user->id }}">
        <div class="w-full max-w-lg rounded-xl bg-sihati-canvas p-6 shadow-modal">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-sihati-ink">Edit Pengguna</h2>
                <button type="button" onclick="closeModal('editModal{{ $user->id }}')" class="rounded-md p-1.5 text-sihati-slate hover:bg-sihati-surface">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form method="POST" action="{{ $updateRoute ?? '#' }}/{{ $user->id }}" class="mt-5 space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="edit_nama_{{ $user->id }}" class="block text-sm font-medium text-sihati-charcoal">Nama Lengkap</label>
                    <input type="text" id="edit_nama_{{ $user->id }}" name="nama" value="{{ $user->name ?? $user->nama }}"
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="edit_username_{{ $user->id }}" class="block text-sm font-medium text-sihati-charcoal">Username</label>
                        <input type="text" id="edit_username_{{ $user->id }}" name="username" value="{{ $user->username }}"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                    </div>
                    <div>
                        <label for="edit_email_{{ $user->id }}" class="block text-sm font-medium text-sihati-charcoal">Email</label>
                        <input type="email" id="edit_email_{{ $user->id }}" name="email" value="{{ $user->email }}"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="edit_role_{{ $user->id }}" class="block text-sm font-medium text-sihati-charcoal">Role</label>
                        <select id="edit_role_{{ $user->id }}" name="role"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                            <option value="pegawai" {{ ($user->role ?? 'pegawai') == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                            <option value="admin" {{ ($user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                    <div>
                        <label for="edit_bidang_id_{{ $user->id }}" class="block text-sm font-medium text-sihati-charcoal">Bidang</label>
                        <select id="edit_bidang_id_{{ $user->id }}" name="bidang_id"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                            <option value="">Pilih Bidang</option>
                            @foreach ($bidangs ?? [] as $bd)
                            <option value="{{ $bd->id }}" {{ ($user->bidang_id ?? '') == $bd->id ? 'selected' : '' }}>{{ $bd->nama_bidang ?? $bd->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <input type="checkbox" id="edit_is_active_{{ $user->id }}" name="is_active" value="1" {{ ($user->is_active ?? true) ? 'checked' : '' }}
                        class="h-4 w-4 rounded border-sihati-hairline-strong text-sihati-primary focus:ring-sihati-primary">
                    <label for="edit_is_active_{{ $user->id }}" class="text-sm text-sihati-charcoal">Akun aktif</label>
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeModal('editModal{{ $user->id }}')"
                        class="rounded-md border border-sihati-hairline-strong px-4 py-2 text-sm font-medium text-sihati-ink hover:bg-sihati-surface">Batal</button>
                    <button type="submit"
                        class="rounded-md bg-sihati-primary px-4 py-2 text-sm font-medium text-sihati-on-primary hover:bg-sihati-primary-pressed">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="deleteModal{{ $user->id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4" data-modal-overlay="deleteModal{{ $user->id }}">
        <div class="w-full max-w-md rounded-xl bg-sihati-canvas p-6 shadow-modal">
            <div class="text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-sihati-rose">
                    <svg class="h-6 w-6 text-sihati-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>
                <h2 class="mt-4 text-lg font-semibold text-sihati-ink">Hapus Pengguna</h2>
                <p class="mt-2 text-sm text-sihati-slate">
                    Yakin ingin menghapus <strong>{{ $user->name ?? $user->nama }}</strong>? Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <form method="POST" action="{{ $destroyRoute ?? '#' }}/{{ $user->id }}" class="mt-6">
                @csrf
                @method('DELETE')
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeModal('deleteModal{{ $user->id }}')"
                        class="rounded-md border border-sihati-hairline-strong px-4 py-2 text-sm font-medium text-sihati-ink hover:bg-sihati-surface">Batal</button>
                    <button type="submit"
                        class="rounded-md bg-sihati-error px-4 py-2 text-sm font-medium text-white hover:bg-sihati-error/90">Hapus</button>
                </div>
            </form>
        </div>
    </div>
    @endforeach

    @stack('scripts')
</body>
</html>
