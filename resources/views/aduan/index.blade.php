<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Aduan - SIHATI BPPKAD</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-sihati-surface text-sihati-ink font-notion antialiased min-h-screen">

    {{-- Simple top bar (temp, will use FD1's layout later) --}}
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
                <span class="text-sm text-sihati-slate">{{ auth()->user()?->name ?? 'Pengguna' }}</span>
                <div class="h-8 w-8 rounded-full bg-sihati-lavender flex items-center justify-center text-xs font-semibold text-sihati-primary-deep">
                    {{ strtoupper(substr(auth()->user()?->name ?? 'U', 0, 2)) }}
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="mx-auto max-w-7xl px-4 py-6 md:px-6 lg:px-8">

        {{-- Page Header --}}
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.08em] text-sihati-steel">Aduan</p>
                <h1 class="mt-1 text-2xl font-semibold tracking-[-0.02em] text-sihati-ink">Daftar Aduan</h1>
                <p class="mt-1 text-sm leading-6 text-sihati-slate">Pantau dan kelola seluruh aduan teknologi informasi.</p>
            </div>
            @if(auth()->user()?->role === 'pegawai')
            <a href="{{ route('pegawai.aduan.create') }}"
                class="inline-flex h-11 items-center justify-center gap-2 rounded-md bg-sihati-primary px-5 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Buat Aduan
            </a>
            @endif
        </div>

        {{-- Filter --}}
        <div class="mb-6">
            @include('aduan.partials.filter', [
                'categories' => $categories ?? [],
                'statuses' => $statuses ?? [],
                'priorities' => $priorities ?? [],
                'bidangs' => $bidangs ?? [],
                'showPelapor' => auth()->user()?->role !== 'pegawai',
                'showBidang' => auth()->user()?->role !== 'pegawai',
            ])
        </div>

        {{-- Table / Card View --}}
        <div data-table-responsive class="overflow-hidden rounded-lg border border-sihati-hairline bg-sihati-canvas shadow-subtle">
            {{-- Desktop Table --}}
            <div data-table-view class="overflow-x-auto">
                <table class="min-w-full divide-y divide-sihati-hairline-soft">
                    <thead class="bg-sihati-surface">
                        <tr>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">No. Tiket</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Judul</th>
                            @if(auth()->user()?->role !== 'pegawai')
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Pelapor</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Bidang</th>
                            @endif
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Kategori</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Prioritas</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Status</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Tanggal</th>
                            <th class="whitespace-nowrap px-4 py-3.5 text-right text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sihati-hairline-soft bg-sihati-canvas">
                        @forelse ($aduans ?? [] as $aduan)
                        <tr class="transition hover:bg-sihati-surface-soft">
                            <td class="whitespace-nowrap px-4 py-3.5">
                                <a href="{{ route(auth()->user()?->role === 'pegawai' ? 'pegawai.aduan.show' : 'admin.aduan.show', $aduan->id) }}"
                                    class="text-sm font-medium text-sihati-primary hover:text-sihati-primary-pressed">
                                    {{ $aduan->nomor_tiket }}
                                </a>
                            </td>
                            <td class="max-w-[200px] px-4 py-3.5">
                                <p class="truncate text-sm font-medium text-sihati-charcoal">{{ $aduan->judul }}</p>
                            </td>
                            @if(auth()->user()?->role !== 'pegawai')
                            <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $aduan->pelapor?->name ?? '-' }}</td>
                            <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $aduan->bidang?->nama_bidang ?? '-' }}</td>
                            @endif
                            <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $aduan->category?->nama_kategori ?? '-' }}</td>
                            <td class="whitespace-nowrap px-4 py-3.5">
                                @php
                                    $p = $aduan->priority?->nama_prioritas ?? $aduan->prioritas ?? 'Rendah';
                                    $pClasses = match(strtolower($p)) {
                                        'rendah' => 'bg-sihati-gray text-sihati-slate',
                                        'sedang' => 'bg-sihati-sky text-sihati-link-pressed',
                                        'tinggi' => 'bg-sihati-yellow-bold text-sihati-charcoal',
                                        'mendesak' => 'bg-sihati-rose text-sihati-error',
                                        default => 'bg-sihati-gray text-sihati-slate',
                                    };
                                @endphp
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $pClasses }}">
                                    {{ $p }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3.5">
                                @php
                                    $s = $aduan->status?->nama_status ?? $aduan->status?->kode_status ?? 'diterima';
                                    $sKey = strtolower($s);
                                    $sClasses = match($sKey) {
                                        'diterima' => 'bg-sihati-lavender text-sihati-primary-deep',
                                        'diproses' => 'bg-sihati-sky text-sihati-link-pressed',
                                        'selesai' => 'bg-sihati-mint text-sihati-success',
                                        default => 'bg-sihati-gray text-sihati-slate',
                                    };
                                @endphp
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $sClasses }}">
                                    {{ $s }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-steel">
                                {{ \Carbon\Carbon::parse($aduan->tanggal_aduan ?? $aduan->created_at)->isoFormat('DD-MM-Y') }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3.5 text-right">
                                <a href="{{ route(auth()->user()?->role === 'pegawai' ? 'pegawai.aduan.show' : 'admin.aduan.show', $aduan->id) }}"
                                    class="text-sm font-medium text-sihati-link transition hover:text-sihati-link-pressed">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ auth()->user()?->role !== 'pegawai' ? 9 : 6 }}" class="px-4 py-10">
                                <div class="text-center">
                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-lg bg-sihati-lavender">
                                        <svg class="h-6 w-6 text-sihati-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <h3 class="mt-4 text-base font-semibold text-sihati-ink">Belum ada aduan</h3>
                                    <p class="mt-1 text-sm text-sihati-slate">Aduan yang dibuat akan tampil di halaman ini.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Mobile Card View --}}
            <div data-card-view class="divide-y divide-sihati-hairline-soft sm:hidden">
                @forelse ($aduans ?? [] as $aduan)
                <a href="{{ route(auth()->user()?->role === 'pegawai' ? 'pegawai.aduan.show' : 'admin.aduan.show', $aduan->id) }}"
                    class="block p-4 transition hover:bg-sihati-surface-soft">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-sihati-primary">{{ $aduan->nomor_tiket }}</p>
                            <p class="mt-0.5 truncate text-sm font-medium text-sihati-charcoal">{{ $aduan->judul }}</p>
                        </div>
                        @php
                            $s = $aduan->status?->nama_status ?? $aduan->status?->kode_status ?? 'diterima';
                            $sKey = strtolower($s);
                            $sClasses = match($sKey) {
                                'diterima' => 'bg-sihati-lavender text-sihati-primary-deep',
                                'diproses' => 'bg-sihati-sky text-sihati-link-pressed',
                                'selesai' => 'bg-sihati-mint text-sihati-success',
                                default => 'bg-sihati-gray text-sihati-slate',
                            };
                        @endphp
                        <span class="inline-flex flex-shrink-0 items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $sClasses }}">
                            {{ $s }}
                        </span>
                    </div>
                    <div class="mt-2 flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-sihati-steel">
                        <span>{{ \Carbon\Carbon::parse($aduan->tanggal_aduan ?? $aduan->created_at)->isoFormat('DD-MM-Y') }}</span>
                        @if(auth()->user()?->role !== 'pegawai')
                            <span>{{ $aduan->pelapor?->name ?? '-' }}</span>
                        @endif
                        <span>{{ $aduan->category?->nama_kategori ?? '-' }}</span>
                    </div>
                </a>
                @empty
                <div class="p-8 text-center">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-lg bg-sihati-lavender">
                        <svg class="h-6 w-6 text-sihati-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-base font-semibold text-sihati-ink">Belum ada aduan</h3>
                    <p class="mt-1 text-sm text-sihati-slate">Aduan yang dibuat akan tampil di halaman ini.</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Pagination --}}
        @if (isset($aduans) && method_exists($aduans, 'links'))
        <div class="mt-6">
            {{ $aduans->links() }}
        </div>
        @endif
    </main>

    @stack('scripts')
</body>
</html>
