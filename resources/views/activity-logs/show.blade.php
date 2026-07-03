<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Log Aktivitas - SIHATI BPPKAD</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-sihati-surface text-sihati-ink font-notion antialiased min-h-screen">

    <header class="sticky top-0 z-20 border-b border-sihati-hairline bg-sihati-canvas">
        <div class="flex h-16 items-center justify-between px-4 md:px-6">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.activity-logs.index') }}" class="flex h-9 w-9 items-center justify-center rounded-md text-sihati-slate hover:bg-sihati-surface">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div class="flex h-9 w-9 items-center justify-center rounded-md bg-sihati-primary text-sm font-bold text-white">SI</div>
                <span class="text-sm font-semibold text-sihati-ink">Detail Log</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm text-sihati-slate">{{ auth()->user()?->name ?? 'Admin' }}</span>
                <div class="h-8 w-8 rounded-full bg-sihati-lavender flex items-center justify-center text-xs font-semibold text-sihati-primary-deep">
                    {{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 2)) }}
                </div>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-3xl px-4 py-6 md:px-6 lg:py-8">

        <nav class="mb-4 text-sm text-sihati-steel">
            <a href="{{ route('admin.activity-logs.index') }}" class="hover:text-sihati-link">Log Aktivitas</a>
            <span class="mx-2">/</span>
            <span class="text-sihati-charcoal">Detail #{{ $log->id ?? request()->route('id') }}</span>
        </nav>

        <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-6 shadow-subtle md:p-8">
            <div class="mb-6">
                <h1 class="text-xl font-semibold tracking-[-0.02em] text-sihati-ink">Detail Log Aktivitas</h1>
            </div>

            @php
            $logData = $log ?? (object)[
                'id' => request()->route('id'),
                'user' => (object)['name' => 'Admin'],
                'action' => 'update_status',
                'module' => 'aduan',
                'description' => 'Admin mengubah status aduan SIHATI-2026-0001 dari diterima menjadi diproses.',
                'target_table' => 'aduans',
                'target_id' => 1,
                'old_values' => '{"status_id": 1, "status": "diterima"}',
                'new_values' => '{"status_id": 2, "status": "diproses"}',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'created_at' => now(),
            ];
            @endphp

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Waktu</p>
                    <p class="mt-1 text-sm text-sihati-charcoal">{{ \Carbon\Carbon::parse($logData->created_at)->isoFormat('DD MMMM YYYY HH:mm:ss') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Pengguna</p>
                    <p class="mt-1 text-sm font-medium text-sihati-charcoal">{{ $logData->user?->name ?? $logData->nama_user ?? 'Sistem' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Aksi</p>
                    <p class="mt-1 text-sm text-sihati-charcoal">{{ ucwords(str_replace('_', ' ', $logData->action)) }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Modul</p>
                    <p class="mt-1 text-sm text-sihati-charcoal">{{ ucfirst($logData->module) }}</p>
                </div>
            </div>

            <div class="mt-6">
                <p class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Deskripsi</p>
                <p class="mt-1 text-sm leading-6 text-sihati-charcoal">{{ $logData->description }}</p>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Target</p>
                    <p class="mt-1 text-sm text-sihati-charcoal">{{ $logData->target_table ?? '-' }} #{{ $logData->target_id ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">IP Address</p>
                    <p class="mt-1 text-sm text-sihati-charcoal font-mono">{{ $logData->ip_address ?? '-' }}</p>
                </div>
            </div>

            @if($logData->old_values)
            <div class="mt-6">
                <p class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Data Lama</p>
                <pre class="mt-1 rounded-md bg-sihati-surface p-4 text-xs leading-5 text-sihati-slate overflow-x-auto">{{ is_string($logData->old_values) ? json_encode(json_decode($logData->old_values), JSON_PRETTY_PRINT) : json_encode($logData->old_values, JSON_PRETTY_PRINT) }}</pre>
            </div>
            @endif

            @if($logData->new_values)
            <div class="mt-4">
                <p class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Data Baru</p>
                <pre class="mt-1 rounded-md bg-sihati-surface p-4 text-xs leading-5 text-sihati-slate overflow-x-auto">{{ is_string($logData->new_values) ? json_encode(json_decode($logData->new_values), JSON_PRETTY_PRINT) : json_encode($logData->new_values, JSON_PRETTY_PRINT) }}</pre>
            </div>
            @endif

            @if($logData->user_agent)
            <div class="mt-6">
                <p class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">User Agent</p>
                <p class="mt-1 text-xs text-sihati-slate break-all">{{ $logData->user_agent }}</p>
            </div>
            @endif

            <div class="mt-8 flex justify-start">
                <a href="{{ route('admin.activity-logs.index') }}"
                    class="inline-flex h-11 items-center justify-center rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-5 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
                    Kembali
                </a>
            </div>
        </div>
    </main>

    @stack('scripts')
</body>
</html>
