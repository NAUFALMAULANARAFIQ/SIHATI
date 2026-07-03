@php
$judulHalaman = 'Profil Saya';
$deskripsiHalaman = 'Kelola informasi profil pengguna.';
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
                <span class="text-sm text-sihati-slate">{{ $user?->name ?? auth()->user()?->name ?? 'Pengguna' }}</span>
                <div class="h-8 w-8 rounded-full bg-sihati-lavender flex items-center justify-center text-xs font-semibold text-sihati-primary-deep">
                    {{ strtoupper(substr($user?->name ?? auth()->user()?->name ?? 'U', 0, 2)) }}
                </div>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-3xl px-4 py-6 md:px-6 lg:py-8">

        <div class="mb-6">
            <p class="text-xs font-semibold uppercase tracking-[0.08em] text-sihati-steel">Pengguna</p>
            <h1 class="mt-1 text-2xl font-semibold tracking-[-0.02em] text-sihati-ink">{{ $judulHalaman }}</h1>
            <p class="mt-1 text-sm leading-6 text-sihati-slate">{{ $deskripsiHalaman }}</p>
        </div>

        @php
        $profileUser = $user ?? auth()->user() ?? (object)[
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@bppkad.go.id',
            'no_hp' => '08123456789',
            'role' => 'admin',
            'bidang' => (object)['nama_bidang' => 'Sekretariat'],
            'is_active' => true,
        ];
        @endphp

        <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-6 shadow-subtle md:p-8">
            <div class="flex flex-col items-center gap-4 sm:flex-row sm:items-start">
                <div class="flex h-20 w-20 items-center justify-center rounded-full bg-sihati-lavender text-2xl font-bold text-sihati-primary-deep">
                    {{ strtoupper(substr($profileUser->name, 0, 2)) }}
                </div>
                <div class="text-center sm:text-left">
                    <h2 class="text-xl font-semibold text-sihati-ink">{{ $profileUser->name }}</h2>
                    <div class="mt-1 flex flex-wrap items-center justify-center gap-2 sm:justify-start">
                        @php
                        $roleBadge = ($profileUser->role ?? 'pegawai') === 'admin' ? 'bg-sihati-lavender text-sihati-primary-deep' : 'bg-sihati-gray text-sihati-slate';
                        @endphp
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $roleBadge }}">
                            {{ ucfirst($profileUser->role ?? 'pegawai') }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 text-xs {{ ($profileUser->is_active ?? true) ? 'text-sihati-success' : 'text-sihati-error' }}">
                            <span class="h-2 w-2 rounded-full {{ ($profileUser->is_active ?? true) ? 'bg-sihati-success' : 'bg-sihati-error' }}"></span>
                            {{ ($profileUser->is_active ?? true) ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ $updateRoute ?? '#' }}" class="mt-8 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-medium text-sihati-charcoal">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $profileUser->name) }}"
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="username" class="block text-sm font-medium text-sihati-charcoal">Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username', $profileUser->username) }}"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-sihati-charcoal">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $profileUser->email) }}"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="no_hp" class="block text-sm font-medium text-sihati-charcoal">Nomor HP</label>
                        <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $profileUser->no_hp ?? '') }}"
                            placeholder="Contoh: 08123456789"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-sihati-charcoal">Bidang</label>
                        <input type="text" value="{{ $profileUser->bidang?->nama_bidang ?? '-' }}" disabled
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline bg-sihati-surface px-4 text-sm text-sihati-slate">
                    </div>
                </div>

                <hr class="border-sihati-hairline-soft">

                <div>
                    <label for="password" class="block text-sm font-medium text-sihati-charcoal">Password Baru (opsional)</label>
                    <input type="password" id="password" name="password"
                        placeholder="Kosongkan jika tidak ingin mengubah password"
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-sihati-charcoal">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Ulangi password baru"
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <a href="{{ url()->previous() }}"
                        class="inline-flex h-11 items-center justify-center rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-5 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex h-11 items-center justify-center rounded-md bg-sihati-primary px-5 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>

    @stack('scripts')
</body>
</html>
