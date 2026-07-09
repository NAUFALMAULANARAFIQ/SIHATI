<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Pengguna
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

                    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Nama</label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $user->name) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300"
                                   required>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Username</label>
                            <input type="text"
                                   name="username"
                                   value="{{ old('username', $user->username) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300"
                                   required>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Email</label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email', $user->email) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300"
                                   required>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Nomor HP</label>
                            <input type="text"
                                   name="no_hp"
                                   value="{{ old('no_hp', $user->no_hp) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300">
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Bidang</label>
                            <select name="bidang_id" class="mt-1 block w-full rounded-md border-gray-300">
                                <option value="">-- Pilih Bidang --</option>
                                @foreach ($bidangs as $bidang)
                                    <option value="{{ $bidang->id }}" @selected(old('bidang_id', $user->bidang_id) == $bidang->id)>
                                        {{ $bidang->nama_bidang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Role</label>
                            <select name="role" class="mt-1 block w-full rounded-md border-gray-300" required>
                                <option value="pegawai" @selected(old('role', $user->role) === 'pegawai')>
                                    Pegawai
                                </option>
                                <option value="admin" @selected(old('role', $user->role) === 'admin')>
                                    Admin
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Password Baru</label>
                            <input type="password"
                                   name="password"
                                   class="mt-1 block w-full rounded-md border-gray-300">
                            <p class="text-sm text-gray-500 mt-1">
                                Kosongkan jika tidak ingin mengubah password.
                            </p>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Konfirmasi Password Baru</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="mt-1 block w-full rounded-md border-gray-300">
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox"
                                   name="is_active"
                                   value="1"
                                   class="rounded"
                                   {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                            <label class="text-sm text-gray-700">Akun aktif</label>
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.users.index') }}"
                               class="px-4 py-2 bg-gray-500 text-white rounded-md">
                                Batal
                            </a>

                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md">
                                Perbarui
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
