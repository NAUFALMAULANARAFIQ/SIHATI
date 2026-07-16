@php
    $activeFilters = array_filter([
        request()->filled('search') ? 'search' : null,
        request()->filled('date_from') ? 'date_from' : null,
        request()->filled('date_to') ? 'date_to' : null,
        request()->filled('modules') ? 'modules' : null,
        request()->filled('actions') ? 'actions' : null,
        request()->filled('user_id') ? 'user_id' : null,
    ]);
@endphp

<x-app-layout title="Log Aktivitas - SIHATI BPPKAD">
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between pt-4">
    <div>
        <h1 class="text-xl md:text-2xl font-bold text-sihati-ink tracking-tight">Log Aktivitas</h1>
        <p class="text-sihati-slate mt-1 text-sm">Riwayat aktivitas yang dilakukan oleh seluruh pengguna sistem.</p>
    </div>
    <div class="relative">
        <button onclick="toggleFilter()" class="inline-flex h-10 items-center gap-2 rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
            Filter
            @if(count($activeFilters) > 0)
            <span class="flex h-5 w-5 items-center justify-center rounded-full bg-sihati-primary text-[11px] font-bold text-white">{{ count($activeFilters) }}</span>
            @endif
        </button>

        <div id="filterPanel" class="absolute right-0 z-40 mt-2 hidden w-[360px] rounded-xl border border-sihati-hairline bg-sihati-canvas p-5 shadow-modal">
            <form method="GET" action="{{ route('admin.activity-logs.index') }}" class="space-y-4">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Pencarian</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari deskripsi, aksi, modul..."
                        class="mt-1.5 h-10 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-3 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <span class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Dari Tanggal</span>
                        <input type="date" name="date_from" value="{{ request('date_from') }}"
                            class="mt-1.5 h-10 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-3 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                    </div>
                    <div>
                        <span class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Sampai Tanggal</span>
                        <input type="date" name="date_to" value="{{ request('date_to') }}"
                            class="mt-1.5 h-10 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-3 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                    </div>
                </div>

                <div>
                    <span class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Modul</span>
                    <div class="mt-1.5 flex max-h-32 flex-wrap gap-2 overflow-y-auto">
                        @foreach ($modules as $mod)
                        <label class="flex cursor-pointer items-center gap-1.5 rounded-md border border-sihati-hairline-soft px-2.5 py-1.5 text-sm transition hover:bg-sihati-surface {{ in_array($mod, (array) request('modules', [])) ? 'border-sihati-primary bg-sihati-lavender/30 text-sihati-primary-deep' : 'text-sihati-slate' }}">
                            <input type="checkbox" name="modules[]" value="{{ $mod }}" {{ in_array($mod, (array) request('modules', [])) ? 'checked' : '' }} class="hidden" onchange="this.parentElement.classList.toggle('border-sihati-primary');this.parentElement.classList.toggle('bg-sihati-lavender/30');this.parentElement.classList.toggle('text-sihati-primary-deep')">
                            {{ ucfirst($mod) }}
                        </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <span class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Aksi</span>
                    <div class="mt-1.5 flex max-h-32 flex-wrap gap-2 overflow-y-auto">
                        @foreach ($actions as $act)
                        <label class="flex cursor-pointer items-center gap-1.5 rounded-md border border-sihati-hairline-soft px-2.5 py-1.5 text-sm transition hover:bg-sihati-surface {{ in_array($act, (array) request('actions', [])) ? 'border-sihati-primary bg-sihati-lavender/30 text-sihati-primary-deep' : 'text-sihati-slate' }}">
                            <input type="checkbox" name="actions[]" value="{{ $act }}" {{ in_array($act, (array) request('actions', [])) ? 'checked' : '' }} class="hidden" onchange="this.parentElement.classList.toggle('border-sihati-primary');this.parentElement.classList.toggle('bg-sihati-lavender/30');this.parentElement.classList.toggle('text-sihati-primary-deep')">
                            {{ str_replace('_', ' ', ucwords($act)) }}
                        </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <span class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Pengguna</span>
                    <select name="user_id" class="mt-1.5 h-10 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-3 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                        <option value="">Semua pengguna</option>
                        @foreach ($users as $u)
                        <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <span class="text-xs font-semibold uppercase tracking-[0.06em] text-sihati-steel">Urutkan</span>
                    <select name="sort" class="mt-1.5 h-10 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-3 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                        <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>Terbaru</option>
                        <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </div>

                <div class="flex gap-3 pt-1">
                    <button type="submit" class="inline-flex h-10 flex-1 items-center justify-center rounded-md bg-sihati-primary text-sm font-medium text-white transition hover:bg-sihati-primary-pressed">Terapkan</button>
                    <a href="{{ route('admin.activity-logs.index') }}" class="inline-flex h-10 flex-1 items-center justify-center rounded-md border border-sihati-hairline-strong bg-sihati-canvas text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">Reset</a>
                </div>
            </form>
        </div>
    </div>
</div>

@if(count($activeFilters) > 0)
<div class="mb-4 flex flex-wrap items-center gap-2">
    @if(request('search'))
    <span class="inline-flex items-center gap-1 rounded-md bg-sihati-lavender/40 px-2.5 py-1 text-xs font-medium text-sihati-primary-deep">
        Pencarian: "{{ request('search') }}"
        <a href="{{ removeQuery('search') }}" class="text-sihati-primary hover:text-sihati-error">&times;</a>
    </span>
    @endif
    @if(request('date_from'))
    <span class="inline-flex items-center gap-1 rounded-md bg-sihati-lavender/40 px-2.5 py-1 text-xs font-medium text-sihati-primary-deep">
        Dari: {{ \Carbon\Carbon::parse(request('date_from'))->isoFormat('DD-MM-Y') }}
        <a href="{{ removeQuery('date_from') }}" class="text-sihati-primary hover:text-sihati-error">&times;</a>
    </span>
    @endif
    @if(request('date_to'))
    <span class="inline-flex items-center gap-1 rounded-md bg-sihati-lavender/40 px-2.5 py-1 text-xs font-medium text-sihati-primary-deep">
        Sampai: {{ \Carbon\Carbon::parse(request('date_to'))->isoFormat('DD-MM-Y') }}
        <a href="{{ removeQuery('date_to') }}" class="text-sihati-primary hover:text-sihati-error">&times;</a>
    </span>
    @endif
    @if(request('modules'))
    <span class="inline-flex items-center gap-1 rounded-md bg-sihati-lavender/40 px-2.5 py-1 text-xs font-medium text-sihati-primary-deep">
        Modul: {{ implode(', ', array_map('ucfirst', (array) request('modules'))) }}
        <a href="{{ removeQuery('modules') }}" class="text-sihati-primary hover:text-sihati-error">&times;</a>
    </span>
    @endif
    @if(request('actions'))
    <span class="inline-flex items-center gap-1 rounded-md bg-sihati-lavender/40 px-2.5 py-1 text-xs font-medium text-sihati-primary-deep">
        Aksi: {{ implode(', ', array_map(fn($a) => str_replace('_', ' ', ucwords($a)), (array) request('actions'))) }}
        <a href="{{ removeQuery('actions') }}" class="text-sihati-primary hover:text-sihati-error">&times;</a>
    </span>
    @endif
    @if(request('user_id'))
    <span class="inline-flex items-center gap-1 rounded-md bg-sihati-lavender/40 px-2.5 py-1 text-xs font-medium text-sihati-primary-deep">
        Pengguna: {{ $users->firstWhere('id', request('user_id'))?->name ?? '#' . request('user_id') }}
        <a href="{{ removeQuery('user_id') }}" class="text-sihati-primary hover:text-sihati-error">&times;</a>
    </span>
    @endif
</div>
@endif

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
                </tr>
            </thead>
            <tbody class="divide-y divide-sihati-hairline-soft bg-sihati-canvas">
                @forelse ($logs as $log)
                <tr class="transition hover:bg-sihati-surface-soft">
                    <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-steel">{{ \Carbon\Carbon::parse($log->created_at)->isoFormat('DD-MM-Y HH:mm') }}</td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-sm font-medium text-sihati-charcoal">{{ $log->user?->name ?? 'Sistem' }}</td>
                    <td class="whitespace-nowrap px-4 py-3.5">@php $aC = match($log->action){'login','logout'=>'bg-sihati-gray text-sihati-slate','create_aduan','upload_file','add_comment','add_note','add_rating'=>'bg-sihati-sky text-sihati-link-pressed','update_status'=>'bg-sihati-yellow-bold text-sihati-charcoal','create','update','delete'=>'bg-sihati-lavender text-sihati-primary-deep',default=>'bg-sihati-gray text-sihati-slate'}; @endphp<span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $aC }}">{{ str_replace('_',' ',ucwords($log->action)) }}</span></td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ ucfirst($log->module) }}</td>
                    <td class="max-w-[300px] px-4 py-3.5 text-sm text-sihati-slate"><span class="truncate block">{{ $log->description ?? '-' }}</span></td>
                    <td class="whitespace-nowrap px-4 py-3.5 text-center text-sm text-sihati-slate">@if($log->target_table)<span class="text-xs">{{ $log->target_table }}#{{ $log->target_id }}</span>@else<span class="text-sihati-muted">-</span>@endif</td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-4 py-10 text-center"><div class="mx-auto flex h-12 w-12 items-center justify-center rounded-lg bg-sihati-lavender"><svg class="h-6 w-6 text-sihati-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div><h3 class="mt-4 text-base font-semibold text-sihati-ink">Belum ada log aktivitas</h3><p class="mt-1 text-sm text-sihati-slate">Aktivitas pengguna akan tercatat di sini.</p></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@if (method_exists($logs, 'links'))
<div class="mt-6">{{ $logs->links() }}</div>
@endif

@push('scripts')
<script>
function toggleFilter() {
    document.getElementById('filterPanel').classList.toggle('hidden');
}
document.addEventListener('click', function(e) {
    var panel = document.getElementById('filterPanel');
    if (!panel.closest('.relative')?.contains(e.target)) {
        panel.classList.add('hidden');
    }
});
</script>
@endpush
</x-app-layout>
