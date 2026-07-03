<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Buat Aduan - SIHATI BPPKAD</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-sihati-surface text-sihati-ink font-notion antialiased min-h-screen">

    {{-- Simple top bar --}}
    <header class="sticky top-0 z-20 border-b border-sihati-hairline bg-sihati-canvas">
        <div class="flex h-16 items-center justify-between px-4 md:px-6">
            <div class="flex items-center gap-3">
                <a href="{{ url()->previous() }}" class="flex h-9 w-9 items-center justify-center rounded-md text-sihati-slate hover:bg-sihati-surface">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div class="flex h-9 w-9 items-center justify-center rounded-md bg-sihati-primary text-sm font-bold text-white">SI</div>
                <span class="text-sm font-semibold text-sihati-ink">Buat Aduan Baru</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm text-sihati-slate">{{ auth()->user()?->name ?? 'Pengguna' }}</span>
                <div class="h-8 w-8 rounded-full bg-sihati-lavender flex items-center justify-center text-xs font-semibold text-sihati-primary-deep">
                    {{ strtoupper(substr(auth()->user()?->name ?? 'U', 0, 2)) }}
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="mx-auto max-w-4xl px-4 py-6 md:px-6 lg:py-10">
        <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-6 shadow-subtle md:p-8">
            {{-- Header --}}
            <div class="mb-8">
                <h1 class="text-xl font-semibold tracking-[-0.02em] text-sihati-ink md:text-2xl">Buat Aduan Baru</h1>
                <p class="mt-1.5 text-sm leading-6 text-sihati-slate">Laporkan kendala teknologi informasi yang Anda alami. Isi data dengan lengkap agar penanganan lebih cepat.</p>
            </div>

            <form method="POST" action="{{ $action ?? '#' }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Judul Aduan --}}
                <div>
                    <label for="judul" class="block text-sm font-medium text-sihati-charcoal">
                        Judul Aduan <span class="text-sihati-error">*</span>
                    </label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                        placeholder="Contoh: Printer tidak bisa mencetak"
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('judul') border-sihati-error @enderror">
                    @error('judul')
                        <p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Two Columns --}}
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-sihati-charcoal">
                            Kategori <span class="text-sihati-error">*</span>
                        </label>
                        <select id="kategori" name="kategori"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('kategori') border-sihati-error @enderror">
                            <option value="">Pilih kategori</option>
                            @foreach ($categories ?? [] as $cat)
                                <option value="{{ $cat->id }}" {{ old('kategori') == $cat->id ? 'selected' : '' }}>{{ $cat->nama_kategori ?? $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="prioritas" class="block text-sm font-medium text-sihati-charcoal">
                            Prioritas <span class="text-sihati-error">*</span>
                        </label>
                        <select id="prioritas" name="prioritas"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('prioritas') border-sihati-error @enderror">
                            <option value="">Pilih prioritas</option>
                            @foreach ($priorities ?? [] as $pr)
                                <option value="{{ $pr->id }}" {{ old('prioritas') == $pr->id ? 'selected' : '' }}>{{ $pr->nama_prioritas ?? $pr->name }}</option>
                            @endforeach
                        </select>
                        @error('prioritas')
                            <p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Two Columns: Lokasi & Kontak --}}
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="lokasi" class="block text-sm font-medium text-sihati-charcoal">Lokasi / Ruangan</label>
                        <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}"
                            placeholder="Contoh: Ruang Bidang Anggaran Lt. 2"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                    </div>
                    <div>
                        <label for="no_kontak" class="block text-sm font-medium text-sihati-charcoal">Nomor Kontak</label>
                        <input type="text" id="no_kontak" name="no_kontak" value="{{ old('no_kontak') }}"
                            placeholder="Contoh: 08123456789"
                            class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-sihati-charcoal">
                        Deskripsi Masalah <span class="text-sihati-error">*</span>
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="5"
                        placeholder="Jelaskan kendala yang dialami secara lengkap. Semakin detail, semakin mudah petugas menanganinya."
                        class="mt-1.5 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-3 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('deskripsi') border-sihati-error @enderror">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Upload Lampiran --}}
                <div>
                    <label class="block text-sm font-medium text-sihati-charcoal">Lampiran (opsional)</label>
                    <label for="lampiran"
                        class="mt-1.5 flex cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-sihati-hairline-strong bg-sihati-surface-soft p-6 transition hover:border-sihati-primary hover:bg-sihati-lavender/20">
                        <svg class="mb-2 h-8 w-8 text-sihati-stone" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                        </svg>
                        <p class="text-sm font-medium text-sihati-charcoal">Upload lampiran</p>
                        <p class="mt-1 text-xs text-sihati-steel">Format JPG, PNG, atau PDF. Maksimal 5 MB.</p>
                        <input type="file" id="lampiran" name="lampiran" data-file-upload="lampiranPreview" class="hidden" accept=".jpg,.jpeg,.png,.pdf" multiple>
                    </label>
                    <div id="lampiranPreview" class="mt-3 flex flex-wrap gap-2"></div>
                    @error('lampiran')
                        <p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex flex-col-reverse gap-3 border-t border-sihati-hairline-soft pt-6 sm:flex-row sm:justify-end">
                    <a href="{{ url()->previous() }}"
                        class="inline-flex h-11 items-center justify-center rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-5 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex h-11 items-center justify-center gap-2 rounded-md bg-sihati-primary px-6 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Kirim Aduan
                    </button>
                </div>
            </form>
        </div>
    </main>

    @stack('scripts')
</body>
</html>
