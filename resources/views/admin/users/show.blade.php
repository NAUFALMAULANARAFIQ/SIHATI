<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Pengguna
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-4">

                    <div>
                        <p class="text-sm text-gray-500">Nama</p>
                        <p class="font-semibold">{{ $user->name }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Username</p>
                        <p class="font-semibold">{{ $user->username }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-semibold">{{ $user->email }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Nomor HP</p>
                        <p class="font-semibold">{{ $user->no_hp ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Bidang</p>
                        <p class="font-semibold">{{ $user->bidang->nama_bidang ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Role</p>
                        <p class="font-semibold">{{ ucfirst($user->role) }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        <p class="font-semibold">
                            {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Dibuat Pada</p>
                        <p class="font-semibold">
                            {{ $user->created_at?->format('d-m-Y H:i') }}
                        </p>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.users.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded-md">
                            Kembali
                        </a>

                        <a href="{{ route('admin.users.edit', $user) }}"
                           class="px-4 py-2 bg-yellow-500 text-white rounded-md">
                            Edit
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
