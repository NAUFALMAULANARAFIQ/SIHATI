<section>
    <header class="border-b border-sihati-hairline pb-4">
        <h2 class="text-lg font-semibold text-sihati-error">Nonaktifkan Akun</h2>
        <p class="mt-1 text-sm text-sihati-slate">Akun yang dinonaktifkan tidak bisa digunakan untuk login. Data Anda tetap aman dan tidak dihapus.</p>
    </header>

    <div class="mt-6">
        <button type="button" onclick="confirmDeactivate()"
            class="rounded-md bg-sihati-error px-5 py-2.5 text-sm font-medium text-white transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-sihati-error focus:ring-offset-2">
            Nonaktifkan Akun
        </button>
    </div>

    <div id="deactivateAccountModal" class="fixed inset-0 z-[90] hidden items-center justify-center bg-black/40 p-4"
        onclick="if(event.target===this)closeDeactivateModal()">
        <div class="w-full max-w-md animate-scale-in rounded-xl bg-sihati-canvas p-6 shadow-modal">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-sihati-rose">
                    <svg class="h-5 w-5 text-sihati-error" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-sihati-ink">Konfirmasi Nonaktifkan</h3>
            </div>
            <p class="mt-3 text-sm leading-relaxed text-sihati-slate">
                Apakah Anda yakin ingin menonaktifkan akun ini? Anda tidak bisa login sampai admin mengaktifkannya kembali. Masukkan password Anda untuk konfirmasi.
            </p>
            <form method="post" action="{{ route('profile.deactivate') }}" class="mt-5 space-y-4">
                @csrf
                @method('patch')
                <div>
                    <label for="deactivate_password" class="block text-sm font-medium text-sihati-charcoal">Password</label>
                    <input type="password" id="deactivate_password" name="password" placeholder="Masukkan password Anda"
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('password', 'userDeactivation') border-sihati-error @enderror">
                    @error('password', 'userDeactivation')<p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>@enderror
                </div>
                <div class="flex items-center justify-end gap-3">
                    <button type="button" onclick="closeDeactivateModal()"
                        class="rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-2 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
                        Batal
                    </button>
                    <button type="submit"
                        class="rounded-md bg-sihati-error px-5 py-2 text-sm font-medium text-white transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-sihati-error focus:ring-offset-2">
                        Nonaktifkan
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
    function confirmDeactivate() {
        document.getElementById('deactivateAccountModal').classList.remove('hidden');
        document.getElementById('deactivateAccountModal').classList.add('flex');
    }

    function closeDeactivateModal() {
        document.getElementById('deactivateAccountModal').classList.add('hidden');
        document.getElementById('deactivateAccountModal').classList.remove('flex');
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            var modal = document.getElementById('deactivateAccountModal');
            if (modal && !modal.classList.contains('hidden')) closeDeactivateModal();
        }
    });

    document.getElementById('deactivateAccountModal')?.addEventListener('click', function(e) {
        if (e.target === this) closeDeactivateModal();
    });
    </script>
    @endpush
</section>