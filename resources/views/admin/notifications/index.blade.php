<x-app-layout title="Notifikasi - SIHATI BPPKAD">
<div class="mb-6 pt-4">
    <div>
        <h1 class="text-xl md:text-2xl font-bold text-sihati-ink tracking-tight">Notifikasi</h1>
        <p class="text-sihati-slate mt-1 text-sm">Seluruh notifikasi dan aktivitas akun Anda.</p>
    </div>
</div>

<div class="overflow-hidden rounded-lg border border-sihati-hairline bg-sihati-canvas shadow-subtle">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-sihati-hairline-soft">
            <thead class="bg-sihati-surface">
                <tr>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Status</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Judul</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Pesan</th>
                    <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-sihati-hairline-soft bg-sihati-canvas">
                @forelse ($allNotifications as $notif)
                <tr class="transition hover:bg-sihati-surface-soft {{ !$notif->is_read ? 'bg-sihati-surface' : '' }}">
                    <td class="px-4 py-3.5">
                        @if(!$notif->is_read)
                            <span class="inline-flex h-2.5 w-2.5 rounded-full bg-sihati-primary" title="Belum dibaca"></span>
                        @else
                            <span class="inline-flex h-2.5 w-2.5 rounded-full bg-sihati-hairline-strong" title="Sudah dibaca"></span>
                        @endif
                    </td>
                    <td class="px-4 py-3.5 text-sm font-medium text-sihati-ink">{{ $notif->title }}</td>
                    <td class="px-4 py-3.5 text-sm text-sihati-slate">{{ $notif->description }}</td>
                    <td class="px-4 py-3.5 text-sm text-sihati-steel whitespace-nowrap">{{ $notif->created_at->isoFormat('DD-MM-Y HH:mm') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-10 text-center">
                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-lg bg-sihati-gray">
                            <svg class="h-6 w-6 text-sihati-stone" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/></svg>
                        </div>
                        <h3 class="mt-4 text-base font-semibold text-sihati-ink">Belum ada notifikasi</h3>
                        <p class="mt-1 text-sm text-sihati-slate">Tidak ada notifikasi untuk ditampilkan.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($allNotifications->hasPages())
    <div class="border-t border-sihati-hairline px-4 py-3">
        {{ $allNotifications->links() }}
    </div>
    @endif
</div>
</x-app-layout>