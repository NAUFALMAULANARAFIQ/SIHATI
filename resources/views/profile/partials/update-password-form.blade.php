<section>
    <header class="border-b border-sihati-hairline pb-4">
        <h2 class="text-lg font-semibold text-sihati-ink">Perbarui Password</h2>
        <p class="mt-1 text-sm text-sihati-slate">Pastikan akun Anda menggunakan password yang kuat.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-sihati-charcoal">Password Saat Ini</label>
            <div class="relative">
                <input type="password" id="update_password_current_password" name="current_password" autocomplete="current-password"
                    class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone pr-10 focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('current_password', 'updatePassword') border-sihati-error @enderror">
                <button type="button" onclick="togglePassword('update_password_current_password', this)" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-sihati-stone hover:text-sihati-slate">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                    </svg>
                </button>
            </div>
            @error('current_password', 'updatePassword')<p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-medium text-sihati-charcoal">Password Baru</label>
            <div class="relative">
                <input type="password" id="update_password_password" name="password" autocomplete="new-password"
                    class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone pr-10 focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('password', 'updatePassword') border-sihati-error @enderror">
                <button type="button" onclick="togglePassword('update_password_password', this)" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-sihati-stone hover:text-sihati-slate">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                    </svg>
                </button>
            </div>
            @error('password', 'updatePassword')<p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>@enderror
            <p class="mt-1.5 text-xs text-sihati-stone">Minimal 8 karakter, mengandung huruf besar/kecil dan angka.</p>
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-sihati-charcoal">Konfirmasi Password Baru</label>
            <div class="relative">
                <input type="password" id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password"
                    class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone pr-10 focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('password_confirmation', 'updatePassword') border-sihati-error @enderror">
                <button type="button" onclick="togglePassword('update_password_password_confirmation', this)" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-sihati-stone hover:text-sihati-slate">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                    </svg>
                </button>
            </div>
            @error('password_confirmation', 'updatePassword')<p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>@enderror
        </div>

        <div class="flex items-center gap-4 border-t border-sihati-hairline pt-5">
            <button type="submit" class="rounded-md bg-sihati-primary px-5 py-2.5 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">
                Simpan
            </button>

            @if (session('status') === 'password-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                class="text-sm font-medium text-sihati-success">Tersimpan.</p>
            @endif
        </div>
    </form>
</section>

<script>
function togglePassword(id, btn) {
    var input = document.getElementById(id);
    if (!input) return;
    if (input.type === 'password') {
        input.type = 'text';
        btn.innerHTML = '<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>';
    } else {
        input.type = 'password';
        btn.innerHTML = '<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>';
    }
}
</script>