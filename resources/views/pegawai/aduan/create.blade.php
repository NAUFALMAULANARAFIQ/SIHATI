@php
    if (!isset($categories)) $categories = \App\Models\Category::all();
    if (!isset($priorities)) $priorities = \App\Models\Priority::all();
@endphp

<x-app-layout title="Buat Aduan - SIHATI BPPKAD">
<div class="mx-auto max-w-4xl">
    <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-6 shadow-subtle md:p-8">
        <div class="mb-8">
            <h1 class="text-xl font-semibold tracking-[-0.02em] text-sihati-ink md:text-2xl">Buat Aduan Baru</h1>
            <p class="mt-1.5 text-sm leading-6 text-sihati-slate">Laporkan kendala teknologi informasi yang Anda alami. Isi data dengan lengkap agar penanganan lebih cepat.</p>
        </div>

        <form method="POST" action="{{ route('pegawai.aduan.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label for="judul" class="block text-sm font-medium text-sihati-charcoal">Judul Aduan <span class="text-sihati-error">*</span></label>
                <input type="text" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Printer tidak bisa mencetak"
                    class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('judul') border-sihati-error @enderror">
                @error('judul')<p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="category_id" class="block text-sm font-medium text-sihati-charcoal">Kategori <span class="text-sihati-error">*</span></label>
                    <select id="category_id" name="category_id" class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('category_id') border-sihati-error @enderror">
                        <option value="">Pilih kategori</option>
                        @foreach ($categories as $cat)<option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nama_kategori }}</option>@endforeach
                    </select>
                    @error('category_id')<p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="priority_id" class="block text-sm font-medium text-sihati-charcoal">Prioritas <span class="text-sihati-error">*</span></label>
                    <select id="priority_id" name="priority_id" class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('priority_id') border-sihati-error @enderror">
                        <option value="">Pilih prioritas</option>
                        @foreach ($priorities as $pr)<option value="{{ $pr->id }}" {{ old('priority_id') == $pr->id ? 'selected' : '' }}>{{ $pr->nama_prioritas }}</option>@endforeach
                    </select>
                    @error('priority_id')<p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-sihati-charcoal">Lokasi / Ruangan</label>
                    <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Ruang Bidang Anggaran Lt. 2"
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                </div>
                <div>
                    <label for="no_kontak" class="block text-sm font-medium text-sihati-charcoal">Nomor Kontak</label>
                    <input type="text" id="no_kontak" name="no_kontak" value="{{ old('no_kontak') }}" placeholder="Contoh: 08123456789"
                        class="mt-1.5 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
                </div>
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-sihati-charcoal">Deskripsi Masalah <span class="text-sihati-error">*</span></label>
                <textarea id="deskripsi" name="deskripsi" rows="5" placeholder="Jelaskan kendala yang dialami secara lengkap. Semakin detail, semakin mudah petugas menanganinya."
                    class="mt-1.5 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-3 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20 @error('deskripsi') border-sihati-error @enderror">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')<p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-sihati-charcoal">Lampiran (opsional)</label>
                <label for="attachments" class="mt-1.5 flex cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-sihati-hairline-strong bg-sihati-surface-soft p-6 transition hover:border-sihati-primary hover:bg-sihati-lavender/20">
                    <svg class="mb-2 h-8 w-8 text-sihati-stone" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                    <p class="text-sm font-medium text-sihati-charcoal">Upload lampiran</p>
                    <p class="mt-1 text-xs text-sihati-steel">Format JPG, PNG, atau PDF. Maksimal 5 MB.</p>
                    <input type="file" id="attachments" name="attachments[]" class="hidden" accept=".jpg,.jpeg,.png,.pdf" multiple>
                </label>
                @error('attachments')<p class="mt-1 text-xs text-sihati-error">{{ $message }}</p>@enderror
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-sihati-hairline-soft pt-6 sm:flex-row sm:justify-end">
                <a href="{{ route('pegawai.aduan.index') }}" class="inline-flex h-11 items-center justify-center rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-5 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">Batal</a>
                <button type="submit" class="inline-flex h-11 items-center justify-center gap-2 rounded-md bg-sihati-primary px-6 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    Kirim Aduan
                </button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
