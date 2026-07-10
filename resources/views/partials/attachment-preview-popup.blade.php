{{--
    Preview popup untuk lampiran halaman detail aduan.
    Dipanggil dari pegawai/aduan/show & admin/aduan/show via @include.

    Menyediakan fungsi global:
        openAttachmentPreview(url, fileName, type)
            type = 'image' | 'pdf' | 'other'
        closeAttachmentPreview()
--}}

<div id="attachmentPreviewPopup"
    class="fixed inset-0 z-[70] hidden items-center justify-center bg-black/60 p-4"
    onclick="if(event.target===this)closeAttachmentPreview()">
    <div class="relative flex max-h-[90vh] w-full max-w-4xl flex-col rounded-xl bg-sihati-canvas shadow-modal">
        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-sihati-hairline px-5 py-3">
            <h3 id="attachmentPreviewTitle"
                class="truncate pr-4 text-sm font-semibold text-sihati-ink">Preview</h3>
            <button type="button" onclick="closeAttachmentPreview()"
                class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-md text-sihati-stone transition hover:bg-sihati-surface hover:text-sihati-slate">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        {{-- Content --}}
        <div id="attachmentPreviewBody"
            class="flex min-h-[240px] items-center justify-center overflow-auto p-4"></div>
    </div>
</div>

@push('scripts')
<script>
(function() {
    'use strict';

    var popup = document.getElementById('attachmentPreviewPopup');
    var title = document.getElementById('attachmentPreviewTitle');
    var body  = document.getElementById('attachmentPreviewBody');

    if (!popup) return;

    /**
     * Open attachment preview popup.
     *
     * @param {string} url      - Direct URL to the file
     * @param {string} fileName - Original file name
     * @param {string} type     - 'image' | 'pdf' | 'other'
     */
    window.openAttachmentPreview = function(url, fileName, type) {
        title.textContent = fileName;

        var html = '';

        if (type === 'image') {
            html = '<img src="' + url + '" alt="' + fileName.replace(/"/g,'&quot;') + '"' +
                   ' class="max-h-[75vh] max-w-full rounded-lg object-contain" />';
        } else if (type === 'pdf') {
            html =
                '<div class="flex flex-col items-center gap-4 py-8 text-center">' +
                    '<svg class="h-16 w-16 text-sihati-error" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.2">' +
                        '<path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>' +
                    '</svg>' +
                    '<p class="text-sm font-medium text-sihati-ink">' + fileName + '</p>' +
                    '<a href="' + url + '" target="_blank" rel="noopener"' +
                    ' class="inline-flex items-center gap-2 rounded-md bg-sihati-primary px-5 py-2 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed">' +
                        '<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>' +
                        'Buka File' +
                    '</a>' +
                '</div>';
        } else {
            html =
                '<div class="flex flex-col items-center gap-3 py-10 text-center">' +
                    '<svg class="h-14 w-14 text-sihati-stone" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.2">' +
                        '<path d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32a1.5 1.5 0 01-2.122-2.122L16.28 6.53"/>' +
                    '</svg>' +
                    '<p class="text-sm text-sihati-steel">Tidak dapat menampilkan preview.</p>' +
                    '<a href="' + url + '" target="_blank" rel="noopener"' +
                    ' class="inline-flex items-center gap-2 rounded-md border border-sihati-hairline-strong px-4 py-2 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">' +
                        '<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>' +
                        'Buka File' +
                    '</a>' +
                '</div>';
        }

        body.innerHTML = html;
        popup.classList.remove('hidden');
        popup.classList.add('flex');
        document.body.style.overflow = 'hidden';
    };

    /**
     * Close the preview popup.
     */
    window.closeAttachmentPreview = function() {
        popup.classList.add('hidden');
        popup.classList.remove('flex');
        body.innerHTML = '';
        document.body.style.overflow = '';
    };

    /**
     * Escape closes the popup.
     */
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && popup && !popup.classList.contains('hidden')) {
            window.closeAttachmentPreview();
            e.preventDefault();
        }
    });
})();
</script>
@endpush
