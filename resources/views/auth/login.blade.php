@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="w-full max-w-md">
    <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-6 shadow-card sm:p-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-sihati-ink tracking-tight">Masuk ke Akun Anda</h2>
            <p class="text-sihati-slate mt-1.5 text-sm">Silakan masukkan email dan kata sandi</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-sihati-charcoal mb-1.5">
                    Email / Username <span class="text-sihati-error">*</span>
                </label>
                <input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email" required autofocus
                    class="h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('email') border-sihati-error @enderror">
                @error('email')
                    <p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>
                @enderror
            </div> 

            <div>
                <label for="password" class="block text-sm font-medium text-sihati-charcoal mb-1.5">
                    Kata Sandi <span class="text-sihati-error">*</span>
                </label>
                <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required
                    class="h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('password') border-sihati-error @enderror">
                @error('password')
                    <p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="h-4 w-4 rounded border-sihati-hairline-strong text-sihati-primary focus:ring-sihati-primary/20">
                    <span class="text-sm text-sihati-slate">Ingat saya</span>
                </label>
            </div>

            <div class="pt-2">
                <button type="submit"
                    class="flex h-11 w-full items-center justify-center gap-2 rounded-md bg-sihati-primary text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Masuk
                </button>
            </div>
        </form>

        @if(session('status'))
            <div class="mt-4 rounded-md border border-sihati-success/30 bg-sihati-mint px-4 py-3 text-sm text-sihati-success">
                {{ session('status') }}
            </div>
        @endif
    </div>
</div>
@endsection
