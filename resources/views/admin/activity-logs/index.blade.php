<x-app-layout title="Log Aktivitas - SIHATI BPPKAD">
<div class="mb-6">
    <h1 class="mt-1 text-2xl font-semibold tracking-[-0.02em] text-sihati-ink">Log Aktivitas</h1>
    <p class="mt-1 text-sm leading-6 text-sihati-slate">Riwayat aktivitas yang dilakukan oleh seluruh pengguna sistem.</p>
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
</x-app-layout>
