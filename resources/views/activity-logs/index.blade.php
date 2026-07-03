<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Log Aktivitas - SIHATI BPPKAD</title>
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

        <div class="mb-6">
            <p class="text-xs font-semibold uppercase tracking-[0.08em] text-sihati-steel">Sistem</p>
            <h1 class="mt-1 text-2xl font-semibold tracking-[-0.02em] text-sihati-ink">Log Aktivitas</h1>
            <p class="mt-1 text-sm leading-6 text-sihati-slate">Riwayat aktivitas yang dilakukan oleh seluruh pengguna sistem.</p>
        </div>

        <div class="mb-6 rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
            <form method="GET" action="{{ url()->current() }}">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-5">
                    <div>
                        <label for="tgl_awal" class="block text-sm font-medium text-sihati-charcoal">Tanggal Awal</label>
                        <input type="date" id="tgl_awal" name="tgl_awal" value="{{ request('tgl_awal') }}"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                    </div>
                    <div>
                        <label for="tgl_akhir" class="block text-sm font-medium text-sihati-charcoal">Tanggal Akhir</label>
                        <input type="date" id="tgl_akhir" name="tgl_akhir" value="{{ request('tgl_akhir') }}"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                    </div>
                    <div>
                        <label for="user" class="block text-sm font-medium text-sihati-charcoal">Pengguna</label>
                        <input type="text" id="user" name="user" value="{{ request('user') }}"
                            placeholder="Nama pengguna"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                    </div>
                    <div>
                        <label for="aksi" class="block text-sm font-medium text-sihati-charcoal">Aksi</label>
                        <select id="aksi" name="aksi"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                            <option value="">Semua Aksi</option>
                            <option value="login" {{ request('aksi') == 'login' ? 'selected' : '' }}>Login</option>
                            <option value="logout" {{ request('aksi') == 'logout' ? 'selected' : '' }}>Logout</option>
                            <option value="create_aduan" {{ request('aksi') == 'create_aduan' ? 'selected' : '' }}>Buat Aduan</option>
                            <option value="update_status" {{ request('aksi') == 'update_status' ? 'selected' : '' }}>Ubah Status</option>
                            <option value="add_comment" {{ request('aksi') == 'add_comment' ? 'selected' : '' }}>Tambah Komentar</option>
                            <option value="add_note" {{ request('aksi') == 'add_note' ? 'selected' : '' }}>Tambah Catatan</option>
                            <option value="upload_file" {{ request('aksi') == 'upload_file' ? 'selected' : '' }}>Upload Lampiran</option>
                            <option value="add_rating" {{ request('aksi') == 'add_rating' ? 'selected' : '' }}>Beri Rating</option>
                        </select>
                    </div>
                    <div>
                        <label for="module" class="block text-sm font-medium text-sihati-charcoal">Modul</label>
                        <select id="module" name="module"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                            <option value="">Semua Modul</option>
                            <option value="auth" {{ request('module') == 'auth' ? 'selected' : '' }}>Auth</option>
                            <option value="aduan" {{ request('module') == 'aduan' ? 'selected' : '' }}>Aduan</option>
                            <option value="master" {{ request('module') == 'master' ? 'selected' : '' }}>Master Data</option>
                            <option value="laporan" {{ request('module') == 'laporan' ? 'selected' : '' }}>Laporan</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 flex justify-end gap-3">
                    <a href="{{ url()->current() }}"
                        class="inline-flex h-11 items-center justify-center rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-5 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
                        Reset
                    </a>
                    <button type="submit"
                        class="inline-flex h-11 items-center justify-center rounded-md bg-sihati-primary px-5 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">
                        Cari
                    </button>
                </div>
            </form>
        </div>

        <div class="overflow-hidden rounded-lg border border-sihati-hairline bg-sihati-canvas shadow-subtle">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-sihati-hairline-soft">
                    <thead class="bg-sihati-surface">
                        <tr>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Waktu</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Pengguna</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Aksi</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Modul</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Deskripsi</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-center text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Target</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-right text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Detail</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sihati-hairline-soft bg-sihati-canvas">
                        @forelse ($logs ?? [] as $log)
                        <tr class="transition hover:bg-sihati-surface-soft">
                            <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-steel">
                                {{ \Carbon\Carbon::parse($log->created_at)->isoFormat('DD-MM-Y HH:mm') }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3.5 text-sm font-medium text-sihati-charcoal">{{ $log->user?->name ?? $log->nama_user ?? 'Sistem' }}</td>
                            <td class="whitespace-nowrap px-4 py-3.5">
                                @php
                                $actionClasses = match($log->action) {
                                    'login', 'logout' => 'bg-sihati-gray text-sihati-slate',
                                    'create_aduan', 'upload_file', 'add_comment', 'add_note', 'add_rating' => 'bg-sihati-sky text-sihati-link-pressed',
                                    'update_status' => 'bg-sihati-yellow-bold text-sihati-charcoal',
                                    default => 'bg-sihati-gray text-sihati-slate',
                                };
                                @endphp
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $actionClasses }}">
                                    {{ str_replace('_', ' ', ucwords($log->action ?? $log->aksi)) }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ ucfirst($log->module ?? $log->modul) }}</td>
                            <td class="max-w-[300px] px-4 py-3.5 text-sm text-sihati-slate">
                                <span class="truncate block">{{ $log->description ?? $log->deskripsi ?? '-' }}</span>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3.5 text-center text-sm text-sihati-slate">
                                @if($log->target_table)
                                <span class="text-xs">{{ $log->target_table }}#{{ $log->target_id }}</span>
                                @else
                                <span class="text-sihati-muted">-</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-3.5 text-right">
                                <a href="{{ route('admin.activity-logs.show', $log->id) }}"
                                    class="text-sm font-medium text-sihati-link hover:text-sihati-link-pressed">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-4 py-10 text-center">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-lg bg-sihati-lavender">
                                    <svg class="h-6 w-6 text-sihati-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-base font-semibold text-sihati-ink">Belum ada log aktivitas</h3>
                                <p class="mt-1 text-sm text-sihati-slate">Aktivitas pengguna akan tercatat di sini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if (isset($logs) && method_exists($logs, 'links'))
        <div class="mt-6">{{ $logs->links() }}</div>
        @endif
    </main>

    @stack('scripts')
</body>
</html>
