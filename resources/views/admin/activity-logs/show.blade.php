<x-app-layout title="Detail Log - SIHATI BPPKAD">
<nav class="mb-4 text-sm text-sihati-steel">
    <a href="{{ route('admin.activity-logs.index') }}" class="hover:text-sihati-link">Log Aktivitas</a>
    <span class="mx-2">/</span>
    <span class="text-sihati-charcoal">Detail #{{ $log->id }}</span>
</nav>

<div class="mx-auto max-w-3xl">
    <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-6 shadow-subtle md:p-8">
        <div class="mb-6"><h1 class="text-xl font-semibold tracking-[-0.02em] text-sihati-ink">Detail Log Aktivitas</h1></div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div><p class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Waktu</p><p class="mt-1 text-sm text-sihati-charcoal">{{ \Carbon\Carbon::parse($log->created_at)->isoFormat('DD MMMM YYYY HH:mm:ss') }}</p></div>
            <div><p class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Pengguna</p><p class="mt-1 text-sm font-medium text-sihati-charcoal">{{ $log->user?->name ?? 'Sistem' }}</p></div>
            <div><p class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Aksi</p><p class="mt-1 text-sm text-sihati-charcoal">{{ ucwords(str_replace('_',' ',$log->action)) }}</p></div>
            <div><p class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Modul</p><p class="mt-1 text-sm text-sihati-charcoal">{{ ucfirst($log->module) }}</p></div>
        </div>

        <div class="mt-6"><p class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Deskripsi</p><p class="mt-1 text-sm leading-6 text-sihati-charcoal">{{ $log->description }}</p></div>

        <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2">
            <div><p class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Target</p><p class="mt-1 text-sm text-sihati-charcoal">{{ $log->target_table ?? '-' }} #{{ $log->target_id ?? '-' }}</p></div>
            <div><p class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">IP Address</p><p class="mt-1 text-sm text-sihati-charcoal font-mono">{{ $log->ip_address ?? '-' }}</p></div>
        </div>

        @if($log->old_values)<div class="mt-6"><p class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Data Lama</p><pre class="mt-1 rounded-md bg-sihati-surface p-4 text-xs leading-5 text-sihati-slate overflow-x-auto">{{ is_string($log->old_values) ? json_encode(json_decode($log->old_values), JSON_PRETTY_PRINT) : json_encode($log->old_values, JSON_PRETTY_PRINT) }}</pre></div>@endif
        @if($log->new_values)<div class="mt-4"><p class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Data Baru</p><pre class="mt-1 rounded-md bg-sihati-surface p-4 text-xs leading-5 text-sihati-slate overflow-x-auto">{{ is_string($log->new_values) ? json_encode(json_decode($log->new_values), JSON_PRETTY_PRINT) : json_encode($log->new_values, JSON_PRETTY_PRINT) }}</pre></div>@endif
        @if($log->user_agent)<div class="mt-6"><p class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">User Agent</p><p class="mt-1 text-xs text-sihati-slate break-all">{{ $log->user_agent }}</p></div>@endif

        <div class="mt-8 flex justify-start">
            <a href="{{ route('admin.activity-logs.index') }}" class="inline-flex h-11 items-center justify-center rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-5 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">Kembali</a>
        </div>
    </div>
</div>
</x-app-layout>
