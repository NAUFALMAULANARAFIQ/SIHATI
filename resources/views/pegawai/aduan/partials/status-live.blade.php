{{-- Polling status, prioritas & riwayat status tanpa reload halaman --}}
@push('scripts')
<script>
(function () {
    const historyContainer = document.getElementById('statusHistoryContainer');
    const statusBadge = document.getElementById('statusBadge');
    const priorityBadge = document.getElementById('priorityBadge');
    if (!historyContainer) return;

    const fetchUrl = historyContainer.dataset.statusFetchUrl;
    if (!fetchUrl) return;

    let lastCount = parseInt(historyContainer.dataset.lastCount || '0', 10);

    const statusColors = {
        diterima: 'bg-sihati-lavender text-sihati-primary-deep',
        diproses: 'bg-sihati-sky text-sihati-link-pressed',
        selesai: 'bg-sihati-mint text-sihati-success',
    };
    const timelineIconColors = {
        diterima: 'bg-sihati-lavender ring-sihati-lavender text-sihati-primary-deep',
        diproses: 'bg-sihati-sky ring-sihati-sky text-sihati-link-pressed',
        selesai: 'bg-sihati-mint ring-sihati-mint text-sihati-success',
    };
    const priorityColors = {
        rendah: 'bg-sihati-gray text-sihati-slate',
        sedang: 'bg-sihati-sky text-sihati-link-pressed',
        tinggi: 'bg-sihati-yellow-bold text-sihati-charcoal',
        mendesak: 'bg-sihati-rose text-sihati-error',
    };
    const badgeBaseClass = 'inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold';

    function escapeHtml(str) {
        const div = document.createElement('div');
        div.textContent = str ?? '';
        return div.innerHTML;
    }

    function updateBadges(status, priority) {
        if (statusBadge) {
            const key = (status.kode || status.nama || '').toLowerCase();
            statusBadge.className = `${badgeBaseClass} ${statusColors[key] || 'bg-sihati-gray text-sihati-slate'}`;
            statusBadge.textContent = status.nama;
            statusBadge.dataset.key = key;
        }
        if (priorityBadge) {
            const pKey = (priority.nama || '').toLowerCase();
            priorityBadge.className = `${badgeBaseClass} ${priorityColors[pKey] || 'bg-sihati-gray text-sihati-slate'}`;
            priorityBadge.textContent = priority.nama;
        }
    }
    function renderHistoryItem(history) {
        const isSelesai = history.status_baru_kode === 'selesai';
        const iconColorClass = timelineIconColors[history.status_baru_kode] || 'bg-sihati-gray ring-sihati-gray text-sihati-slate';
        const iconSvg = isSelesai
            ? '<svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>'
            : '<svg class="h-3 w-3" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"/></svg>';
        const dariBlock = history.status_sebelumnya_nama
            ? `<span class="text-xs text-sihati-steel">dari</span>
               <span class="rounded-md bg-sihati-surface px-2 py-0.5 text-xs font-medium text-sihati-slate">${escapeHtml(history.status_sebelumnya_nama)}</span>`
            : '';
        const olehBlock = history.changed_by_name
            ? `<span>oleh ${escapeHtml(history.changed_by_name)}</span>`
            : '';
        const keteranganBlock = history.keterangan
            ? `<span class="italic">&middot; ${escapeHtml(history.keterangan)}</span>`
            : '';

        return `
            <li class="mb-8 ms-6 last:mb-0" data-history-id="${history.id}">
                <span class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full ring-4 ring-sihati-canvas ${iconColorClass}">
                    ${iconSvg}
                </span>
                <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-4 shadow-subtle">
                    <div class="flex flex-wrap items-center gap-2">
                        <h3 class="text-sm font-semibold text-sihati-ink">${escapeHtml(history.status_baru_nama)}</h3>
                        ${dariBlock}
                    </div>
                    <div class="mt-2 flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-sihati-steel">
                        <time>${escapeHtml(history.created_at)}</time>
                        ${olehBlock}
                        ${keteranganBlock}
                    </div>
                </div>
            </li>
        `;
    }

    async function checkForStatusUpdate() {
        try {
            const response = await fetch(fetchUrl, {
                headers: { 'Accept': 'application/json' },
                cache: 'no-store',
            });
            if (!response.ok) {
                console.error('Gagal fetch status aduan:', response.status);
                return;
            }

            const data = await response.json();

            // Selalu sinkronkan badge dengan data terbaru dari server,
            // tidak bergantung pada perbandingan status sebelumnya.
            updateBadges(data.status, data.priority);

            if (data.histories.length > lastCount) {
                const list = document.getElementById('statusTimelineList');
                document.getElementById('statusTimelineEmpty')?.remove();

                // histories dari server terurut terbaru lebih dulu (latest()),
                // jadi entri baru berada di paling depan array -> sisipkan di awal <ol>.
                const newCount = data.histories.length - lastCount;
                const newHistories = data.histories.slice(0, newCount).reverse();

                newHistories.forEach(history => {
                    list?.insertAdjacentHTML('afterbegin', renderHistoryItem(history));
                });

                lastCount = data.histories.length;
            }
        } catch (e) {
            console.error('Error saat polling status aduan:', e);
        }
    }

    setInterval(checkForStatusUpdate, 4000);
})();
</script>
@endpush
