document.addEventListener('DOMContentLoaded', function () {
    // --- Mobile Filter Toggle ---
    const filterToggle = document.getElementById('filterToggle');
    const filterPanel = document.getElementById('filterPanel');
    if (filterToggle && filterPanel) {
        filterToggle.addEventListener('click', function () {
            filterPanel.classList.toggle('hidden');
            filterToggle.querySelector('span').textContent =
                filterPanel.classList.contains('hidden') ? 'Tampilkan Filter' : 'Sembunyikan Filter';
        });
    }

    // --- Modal ---
    window.openModal = function (id) {
        const el = document.getElementById(id);
        if (el) {
            el.classList.remove('hidden');
            el.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
    };
    window.closeModal = function (id) {
        const el = document.getElementById(id);
        if (el) {
            el.classList.add('hidden');
            el.classList.remove('flex');
            document.body.style.overflow = '';
        }
    };
    document.querySelectorAll('[data-modal-close]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            closeModal(btn.dataset.modalClose);
        });
    });
    document.querySelectorAll('[data-modal-overlay]').forEach(function (overlay) {
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) {
                closeModal(overlay.dataset.modalOverlay);
            }
        });
    });

    // --- File Upload Preview ---
    document.querySelectorAll('[data-file-upload]').forEach(function (input) {
        input.addEventListener('change', function () {
            const preview = document.getElementById(input.dataset.fileUpload);
            if (!preview) return;
            preview.innerHTML = '';
            if (this.files.length > 0) {
                Array.from(this.files).forEach(function (file) {
                    const chip = document.createElement('span');
                    chip.className = 'inline-flex items-center gap-1.5 rounded-md bg-sihati-lavender px-3 py-1.5 text-sm text-sihati-primary-deep';
                    chip.innerHTML = '<svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>' + file.name;
                    preview.appendChild(chip);
                });
            }
        });
    });

    // --- Responsive Table -> Card View ---
    function handleTableResponsive() {
        document.querySelectorAll('[data-table-responsive]').forEach(function (wrapper) {
            const isMobile = window.innerWidth < 640;
            wrapper.querySelectorAll('[data-card-view]').forEach(function (card) {
                card.style.display = isMobile ? '' : 'none';
            });
            wrapper.querySelectorAll('[data-table-view]').forEach(function (table) {
                table.style.display = isMobile ? 'none' : '';
            });
        });
    }
    handleTableResponsive();
    window.addEventListener('resize', handleTableResponsive);

    // --- Alert Auto-dismiss ---
    document.querySelectorAll('[data-alert-dismiss]').forEach(function (alert) {
        setTimeout(function () {
            alert.style.transition = 'opacity 0.3s ease';
            alert.style.opacity = '0';
            setTimeout(function () { alert.remove(); }, 300);
        }, parseInt(alert.dataset.alertDismiss) || 5000);
    });

    // --- Smooth Status Updates ---
    document.querySelectorAll('[data-status-select]').forEach(function (select) {
        select.addEventListener('change', function () {
            const noteField = document.getElementById('statusNote');
            if (noteField) {
                noteField.style.display = this.value ? 'block' : 'none';
            }
        });
    });
});
