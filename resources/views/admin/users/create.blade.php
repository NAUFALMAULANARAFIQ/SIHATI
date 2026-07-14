<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Pengguna
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4" novalidate>
                        @csrf

                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700">Nama</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 @error('name') border-red-500 @enderror"
                                   required>
                            @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="username" class="block font-medium text-sm text-gray-700">Username</label>
                            <input type="text"
                                   id="username"
                                   name="username"
                                   value="{{ old('username') }}"
                                   pattern="[a-zA-Z0-9_-]+"
                                   title="Hanya boleh huruf, angka, tanda hubung, dan underscore"
                                   class="mt-1 block w-full rounded-md border-gray-300 @error('username') border-red-500 @enderror"
                                   required>
                            @error('username')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 @error('email') border-red-500 @enderror"
                                   required>
                            @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="no_hp" class="block font-medium text-sm text-gray-700">Nomor HP</label>
                            <input type="text"
                                   id="no_hp"
                                   name="no_hp"
                                   value="{{ old('no_hp') }}"
                                   pattern="[0-9+\-\s]+"
                                   title="Hanya boleh angka, +, -, dan spasi"
                                   class="mt-1 block w-full rounded-md border-gray-300 @error('no_hp') border-red-500 @enderror">
                            @error('no_hp')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="bidang_id" class="block font-medium text-sm text-gray-700">Bidang</label>
                            <select id="bidang_id" name="bidang_id" class="mt-1 block w-full rounded-md border-gray-300 @error('bidang_id') border-red-500 @enderror">
                                <option value="">-- Pilih Bidang --</option>
                                @foreach ($bidangs as $bidang)
                                    <option value="{{ $bidang->id }}" @selected(old('bidang_id') == $bidang->id)>
                                        {{ $bidang->nama_bidang }}
                                    </option>
                                @endforeach
                            </select>
                            @error('bidang_id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="role" class="block font-medium text-sm text-gray-700">Role</label>
                            <select id="role" name="role" class="mt-1 block w-full rounded-md border-gray-300 @error('role') border-red-500 @enderror" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="pegawai" @selected(old('role') === 'pegawai')>Pegawai</option>
                                <option value="admin" @selected(old('role') === 'admin')>Admin</option>
                            </select>
                            @error('role')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
                            <div class="relative">
                                <input type="password"
                                       id="password"
                                       name="password"
                                       minlength="8"
                                       class="mt-1 block w-full rounded-md border-gray-300 pr-10 @error('password') border-red-500 @enderror"
                                       oninput="validatePassword(this)"
                                       required>
                                <button type="button" onclick="togglePassword('password', this)" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-sihati-stone hover:text-sihati-slate">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                                    </svg>
                                </button>
                            </div>
                            <p id="passwordHelp" class="text-sm text-gray-500 mt-1">
                                Minimal 8 karakter, mengandung huruf besar/kecil dan angka.
                            </p>
                            @error('password')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Konfirmasi Password</label>
                            <div class="relative">
                                <input type="password"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       minlength="8"
                                       class="mt-1 block w-full rounded-md border-gray-300 pr-10 @error('password') border-red-500 @enderror"
                                       oninput="validatePasswordMatch(this)"
                                       required>
                                <button type="button" onclick="togglePassword('password_confirmation', this)" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-sihati-stone hover:text-sihati-slate">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                                    </svg>
                                </button>
                            </div>
                            @error('password')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox"
                                   id="is_active"
                                   name="is_active"
                                   value="1"
                                   class="rounded"
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label for="is_active" class="text-sm text-gray-700">Akun aktif</label>
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.users.index') }}"
                               class="px-4 py-2 bg-gray-500 text-white rounded-md">
                                Batal
                            </a>

                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md">
                                Simpan
                            </button>
                        </div>
                    </form>

                    <script>
                    function validatePassword(input) {
                        var help = document.getElementById('passwordHelp');
                        var val = input.value;
                        var errors = [];
                        if (val.length < 8) errors.push('minimal 8 karakter');
                        if (!/[A-Z]/.test(val)) errors.push('huruf besar');
                        if (!/[a-z]/.test(val)) errors.push('huruf kecil');
                        if (!/[0-9]/.test(val)) errors.push('angka');
                        if (errors.length > 0) {
                            input.setCustomValidity('Password harus mengandung ' + errors.join(', ') + '.');
                            help.className = 'text-sm text-red-500 mt-1';
                        } else {
                            input.setCustomValidity('');
                            help.className = 'text-sm text-green-600 mt-1';
                        }
                        if (document.getElementById('password_confirmation').value) {
                            validatePasswordMatch(document.getElementById('password_confirmation'));
                        }
                    }

                    function validatePasswordMatch(input) {
                        var pw = document.getElementById('password').value;
                        if (input.value !== pw) {
                            input.setCustomValidity('Konfirmasi password tidak cocok.');
                        } else {
                            input.setCustomValidity('');
                        }
                    }

                    document.querySelector('form').addEventListener('submit', function(e) {
                        if (!this.checkValidity()) {
                            e.preventDefault();
                            this.reportValidity();
                        }
                    });

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

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
