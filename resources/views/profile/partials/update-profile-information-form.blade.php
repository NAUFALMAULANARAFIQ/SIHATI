<section>
    <header class="border-b border-sihati-hairline pb-4">
        <h2 class="text-lg font-semibold text-sihati-ink">Informasi Profile</h2>
        <p class="mt-1 text-sm text-sihati-slate">Perbarui informasi akun Anda.</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm font-medium text-sihati-charcoal">Nama</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('name') border-sihati-error @enderror">
            @error('name')<p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="profile_username" class="block text-sm font-medium text-sihati-charcoal">Username</label>
            <input type="text" id="profile_username" name="username" value="{{ old('username', $user->username) }}" required
                class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('username') border-sihati-error @enderror">
            @error('username')<p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-sihati-charcoal">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('email') border-sihati-error @enderror">
            @error('email')<p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>@enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-3 rounded-md bg-sihati-yellow p-3 text-sm">
                <span class="text-sihati-warning">Email Anda belum diverifikasi.</span>
                <button form="send-verification" class="ml-1 underline font-medium text-sihati-link hover:text-sihati-link-pressed">
                    Klik untuk kirim ulang verifikasi.
                </button>
            </div>
            @endif

            @if (session('status') === 'verification-link-sent')
            <p class="mt-2 text-sm font-medium text-sihati-success">Link verifikasi baru telah dikirim ke email Anda.</p>
            @endif
        </div>

        <div>
            <label for="profile_no_hp" class="block text-sm font-medium text-sihati-charcoal">Nomor HP</label>
            <input type="text" id="profile_no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
                class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('no_hp') border-sihati-error @enderror">
            @error('no_hp')<p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>@enderror
        </div>

        <div class="flex items-center gap-4 border-t border-sihati-hairline pt-5">
            <button type="submit" class="rounded-md bg-sihati-primary px-5 py-2.5 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">
                Simpan
            </button>
        </div>
    </form>
</section>