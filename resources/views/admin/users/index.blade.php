<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Kelola Pengguna
            </h2>

            <a href="{{ route('admin.users.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Tambah Pengguna
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="border px-3 py-2">No</th>
                                <th class="border px-3 py-2">Nama</th>
                                <th class="border px-3 py-2">Username</th>
                                <th class="border px-3 py-2">Email</th>
                                <th class="border px-3 py-2">Role</th>
                                <th class="border px-3 py-2">Bidang</th>
                                <th class="border px-3 py-2">Status</th>
                                <th class="border px-3 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td class="border px-3 py-2">
                                        {{ $users->firstItem() + $loop->index }}
                                    </td>
                                    <td class="border px-3 py-2">
                                        {{ $user->name }}
                                    </td>
                                    <td class="border px-3 py-2">
                                        {{ $user->username }}
                                    </td>
                                    <td class="border px-3 py-2">
                                        {{ $user->email }}
                                    </td>
                                    <td class="border px-3 py-2">
                                        <span class="px-2 py-1 rounded text-sm bg-gray-200">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="border px-3 py-2">
                                        {{ $user->bidang->nama_bidang ?? '-' }}
                                    </td>
                                    <td class="border px-3 py-2">
                                        @if ($user->is_active)
                                            <span class="px-2 py-1 text-sm bg-green-100 text-green-700 rounded">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-sm bg-red-100 text-red-700 rounded">
                                                Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="border px-3 py-2">
                                        <div class="flex gap-2">
                                            <a href="{{ route('admin.users.show', $user) }}"
                                               class="px-3 py-1 bg-gray-600 text-white rounded text-sm">
                                                Detail
                                            </a>

                                            <a href="{{ route('admin.users.edit', $user) }}"
                                               class="px-3 py-1 bg-yellow-500 text-white rounded text-sm">
                                                Edit
                                            </a>

                                            @if (auth()->id() !== $user->id)
                                                <form action="{{ route('admin.users.destroy', $user) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Yakin ingin menonaktifkan pengguna ini?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="px-3 py-1 bg-red-600 text-white rounded text-sm">
                                                        Nonaktifkan
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="border px-3 py-4 text-center text-gray-500">
                                        Belum ada data pengguna.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
