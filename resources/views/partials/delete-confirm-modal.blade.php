{{--
    Modal konfirmasi hapus reusable.
    Dipanggil di halaman admin master data via @include.

    Cara pakai di tombol hapus:
        <button type="button"
            onclick="confirmDelete('formId', 'Nama Item')"
            class="...">
            Hapus
        </button>

    Form delete harus punya ID unik, misal: delete-form-{{ $item->id }}
--}}

<div id="deleteConfirmModal"
    class="fixed inset-0 z-[90] hidden items-center justify-center bg-black/40 p-4"
    onclick="if(event.target===this)closeDeleteModal()">
    <div class="w-full max-w-sm animate-scale-in rounded-xl bg-sihati-canvas p-6 shadow-modal">
        <div class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-sihati-rose">
                <svg class="h-5 w-5 text-sihati-error" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-sihati-ink">Konfirmasi Hapus</h3>
        </div>
        <p id="deleteConfirmMessage" class="mt-3 text-sm leading-relaxed text-sihati-slate">Apakah Anda yakin ingin menghapus data ini?</p>
        <div class="mt-6 flex items-center justify-end gap-3">
            <button type="button" onclick="closeDeleteModal()"
                class="rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
                Batal
            </button>
            <button type="button" onclick="submitDelete()"
                class="rounded-md bg-sihati-error px-5 py-2 text-sm font-medium text-white transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-sihati-error focus:ring-offset-2">
                Hapus
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    /* ── Delete confirmation modal ── */
    var deleteTargetForm = null;

    window.confirmDelete = function(formId, itemName) {
        deleteTargetForm = document.getElementById(formId);
        if (!deleteTargetForm) return;

        var msgEl = document.getElementById('deleteConfirmMessage');
        if (itemName) {
            msgEl.textContent = 'Apakah Anda yakin ingin menghapus ' + itemName + '?';
        } else {
            msgEl.textContent = 'Apakah Anda yakin ingin menghapus data ini?';
        }

        var modal = document.getElementById('deleteConfirmModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    };

    window.closeDeleteModal = function() {
        var modal = document.getElementById('deleteConfirmModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        deleteTargetForm = null;
    };

    window.submitDelete = function() {
        if (deleteTargetForm) {
            deleteTargetForm.submit();
        }
        closeDeleteModal();
    };

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            var modal = document.getElementById('deleteConfirmModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeDeleteModal();
            }
        }
    });
</script>
@endpush
