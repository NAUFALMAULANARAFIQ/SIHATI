<x-app-layout title="Kelola Status Aduan - SIHATI BPPKAD">
<div class="space-y-6 animate-fade-in">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-4">
        <div>
            <h1 class="text-xl md:text-2xl font-bold text-sihati-ink tracking-tight">Kelola Status Aduan</h1>
            <p class="text-sihati-slate mt-1 text-sm">Atur daftar status yang digunakan pada proses aduan.</p>
        </div>
        <div>
            <a href="{{ route('admin.statuses.create') }}"
               class="inline-flex h-10 items-center gap-2 rounded-md bg-sihati-primary px-4 text-sm font-medium text-white transition hover:bg-sihati-primary-pressed">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Status
            </a>
        </div>
    </div>

    <div class="overflow-hidden rounded-lg border border-sihati-hairline bg-sihati-canvas shadow-subtle">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-sihati-hairline-soft">
                <thead class="bg-sihati-surface">
                    <tr>
                        <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">No</th>
                        <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Kode Status</th>
                        <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Nama Status</th>
                        <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Urutan</th>
                        <th class="whitespace-nowrap px-4 py-3.5 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Final</th>
                        <th class="whitespace-nowrap px-4 py-3.5 text-right text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-sihati-hairline-soft bg-sihati-canvas">
                    @forelse ($statuses as $status)
                    <tr class="transition hover:bg-sihati-surface-soft">
                        <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-steel">{{ $statuses->firstItem() + $loop->index }}</td>
                        <td class="whitespace-nowrap px-4 py-3.5 text-sm font-medium text-sihati-ink">{{ $status->kode_status }}</td>
                        <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-charcoal">{{ $status->nama_status }}</td>
                        <td class="whitespace-nowrap px-4 py-3.5 text-sm text-sihati-slate">{{ $status->urutan }}</td>
                        <td class="whitespace-nowrap px-4 py-3.5">
                            @if ($status->is_final)
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold bg-sihati-mint text-sihati-success">Ya</span>
                            @else
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold bg-sihati-gray text-sihati-slate">Tidak</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-4 py-3.5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.statuses.show', $status) }}"
                                   class="rounded-md bg-sihati-primary px-3 py-1.5 text-xs font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed">Detail</a>
                                <a href="{{ route('admin.statuses.edit', $status) }}"
                                   class="rounded-md bg-sihati-yellow-bold px-3 py-1.5 text-xs font-medium text-sihati-charcoal transition hover:bg-sihati-yellow">Edit</a>
                                <form id="delete-form-{{ $status->id }}" action="{{ route('admin.statuses.destroy', $status) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete('delete-form-{{ $status->id }}', 'status {{ $status->nama_status }}')"
                                            class="rounded-md bg-sihati-rose px-3 py-1.5 text-xs font-medium text-sihati-error transition hover:bg-red-200">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-10 text-center text-sm text-sihati-slate">Belum ada data status.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(method_exists($statuses, 'links'))
        <div class="border-t border-sihati-hairline px-4 py-3">{{ $statuses->links() }}</div>
        @endif
    </div>

</div>

@include('partials.delete-confirm-modal')
</x-app-layout>
