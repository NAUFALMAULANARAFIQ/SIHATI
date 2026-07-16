<div id="toggleConfirmModal"
    class="fixed inset-0 z-90 hidden items-center justify-center bg-black/40 p-4"
    onclick="if(event.target===this)closeToggleModal()">
    <div class="w-full max-w-sm animate-scale-in rounded-xl bg-sihati-canvas p-6 shadow-modal">
        <div class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-sihati-yellow">
                <svg class="h-5 w-5 text-sihati-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-sihati-ink">Konfirmasi</h3>
        </div>
        <p id="toggleConfirmMessage" class="mt-3 text-sm leading-relaxed text-sihati-slate">Apakah Anda yakin?</p>
        <div class="mt-6 flex items-center justify-end gap-3">
            <button type="button" onclick="closeToggleModal()"
                class="rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
                Batal
            </button>
            <button type="button" onclick="submitToggle()"
                class="rounded-md bg-sihati-warning px-5 py-2 text-sm font-medium text-white transition hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">
                Ya, Lanjutkan
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    var toggleTargetForm = null;

    window.confirmToggle = function(formId, message) {
        toggleTargetForm = document.getElementById(formId);
        if (!toggleTargetForm) return;

        var msgEl = document.getElementById('toggleConfirmMessage');
        msgEl.textContent = message || 'Apakah Anda yakin?';

        var modal = document.getElementById('toggleConfirmModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    };

    window.closeToggleModal = function() {
        var modal = document.getElementById('toggleConfirmModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        toggleTargetForm = null;
    };

    window.submitToggle = function() {
        if (toggleTargetForm) {
            toggleTargetForm.submit();
        }
        closeToggleModal();
    };

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            var modal = document.getElementById('toggleConfirmModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeToggleModal();
            }
        }
    });
</script>
@endpush
