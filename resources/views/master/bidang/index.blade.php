@php
$judulHalaman = 'Data Bidang';
$deskripsiHalaman = 'Kelola bidang atau unit kerja di lingkungan BPPKAD.';
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

    <main class="mx-auto max-w-5xl px-4 py-6 md:px-6 lg:px-8">

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
                Tambah Bidang
            </button>
        </div>

        <div class="overflow-hidden rounded-lg border border-sihati-hairline bg-sihati-canvas shadow-subtle">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-sihati-hairline-soft">
                    <thead class="bg-sihati-surface">
                        <tr>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Nama Bidang</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Keterangan</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-center text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Jumlah Pengguna</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-right text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sihati-hairline-soft bg-sihati-canvas">
                        @forelse ($bidangs ?? [] as $bidang)
                        <tr class="transition hover:bg-sihati-surface-soft">
                            <td class="whitespace-nowrap px-4 py-3.5 text-sm font-medium text-sihati-charcoal">{{ $bidang->nama_bidang ?? $bidang->name }}</td>
                            <td class="px-4 py-3.5 text-sm text-sihati-slate max-w-[300px]">
                                <span class="truncate block">{{ $bidang->keterangan ?? '-' }}</span>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3.5 text-center text-sm text-sihati-slate">{{ $bidang->users_count ?? $bidang->jumlah_pengguna ?? 0 }}</td>
                            <td class="whitespace-nowrap px-4 py-3.5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" onclick="openModal('editModal{{ $bidang->id }}')"
                                        class="rounded-md px-3 py-1.5 text-sm font-medium text-sihati-link transition hover:bg-sihati-surface">
                                        Edit
                                    </button>
                                    <button type="button" onclick="openModal('deleteModal{{ $bidang->id }}')"
                                        class="rounded-md px-3 py-1.5 text-sm font-medium text-sihati-error transition hover:bg-sihati-rose">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-10 text-center">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-lg bg-sihati-lavender">
                                    <svg class="h-6 w-6 text-sihati-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-base font-semibold text-sihati-ink">Belum ada bidang</h3>
                                <p class="mt-1 text-sm text-sihati-slate">Bidang/unit kerja yang ditambahkan akan tampil di sini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if (isset($bidangs) && method_exists($bidangs, 'links'))
        <div class="mt-6">{{ $bidangs->links() }}</div>
        @endif
    </main>

    <div id="createModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4" data-modal-overlay="createModal">
        <div class="w-full max-w-lg rounded-xl bg-sihati-canvas p-6 shadow-modal">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-sihati-ink">Tambah Bidang</h2>
                <button type="button" onclick="closeModal('createModal')" class="rounded-md p-1.5 text-sihati-slate hover:bg-sihati-surface">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form method="POST" action="{{ $storeRoute ?? '#' }}" class="mt-5 space-y-4">
                @csrf
                <div>
                    <label for="nama_bidang" class="block text-sm font-medium text-sihati-charcoal">Nama Bidang <span class="text-sihati-error">*</span></label>
                    <input type="text" id="nama_bidang" name="nama_bidang" value="{{ old('nama_bidang') }}"
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20"
                        placeholder="Contoh: Bidang Anggaran">
                </div>
                <div>
                    <label for="keterangan" class="block text-sm font-medium text-sihati-charcoal">Keterangan</label>
                    <textarea id="keterangan" name="keterangan" rows="3"
                        class="mt-1.5 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-3 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20"
                        placeholder="Keterangan tambahan (opsional)">{{ old('keterangan') }}</textarea>
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

    @foreach ($bidangs ?? [] as $bidang)
    <div id="editModal{{ $bidang->id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4" data-modal-overlay="editModal{{ $bidang->id }}">
        <div class="w-full max-w-lg rounded-xl bg-sihati-canvas p-6 shadow-modal">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-sihati-ink">Edit Bidang</h2>
                <button type="button" onclick="closeModal('editModal{{ $bidang->id }}')" class="rounded-md p-1.5 text-sihati-slate hover:bg-sihati-surface">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form method="POST" action="{{ $updateRoute ?? '#' }}/{{ $bidang->id }}" class="mt-5 space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="edit_nama_bidang_{{ $bidang->id }}" class="block text-sm font-medium text-sihati-charcoal">Nama Bidang</label>
                    <input type="text" id="edit_nama_bidang_{{ $bidang->id }}" name="nama_bidang" value="{{ $bidang->nama_bidang ?? $bidang->name }}"
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                </div>
                <div>
                    <label for="edit_keterangan_{{ $bidang->id }}" class="block text-sm font-medium text-sihati-charcoal">Keterangan</label>
                    <textarea id="edit_keterangan_{{ $bidang->id }}" name="keterangan" rows="3"
                        class="mt-1.5 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-3 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">{{ $bidang->keterangan ?? '' }}</textarea>
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeModal('editModal{{ $bidang->id }}')"
                        class="rounded-md border border-sihati-hairline-strong px-4 py-2 text-sm font-medium text-sihati-ink hover:bg-sihati-surface">Batal</button>
                    <button type="submit"
                        class="rounded-md bg-sihati-primary px-4 py-2 text-sm font-medium text-sihati-on-primary hover:bg-sihati-primary-pressed">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="deleteModal{{ $bidang->id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4" data-modal-overlay="deleteModal{{ $bidang->id }}">
        <div class="w-full max-w-md rounded-xl bg-sihati-canvas p-6 shadow-modal">
            <div class="text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-sihati-rose">
                    <svg class="h-6 w-6 text-sihati-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>
                <h2 class="mt-4 text-lg font-semibold text-sihati-ink">Hapus Bidang</h2>
                <p class="mt-2 text-sm text-sihati-slate">
                    Yakin ingin menghapus <strong>{{ $bidang->nama_bidang ?? $bidang->name }}</strong>? Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <form method="POST" action="{{ $destroyRoute ?? '#' }}/{{ $bidang->id }}" class="mt-6">
                @csrf
                @method('DELETE')
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeModal('deleteModal{{ $bidang->id }}')"
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
