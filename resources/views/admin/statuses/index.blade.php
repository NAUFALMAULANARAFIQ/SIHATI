<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Kelola Status Aduan
            </h2>

            <a href="{{ route('admin.statuses.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Tambah Status
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

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="border px-3 py-2">No</th>
                                <th class="border px-3 py-2">Kode Status</th>
                                <th class="border px-3 py-2">Nama Status</th>
                                <th class="border px-3 py-2">Urutan</th>
                                <th class="border px-3 py-2">Final</th>
                                <th class="border px-3 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($statuses as $status)
                                <tr>
                                    <td class="border px-3 py-2">
                                        {{ $statuses->firstItem() + $loop->index }}
                                    </td>
                                    <td class="border px-3 py-2">
                                        {{ $status->kode_status }}
                                    </td>
                                    <td class="border px-3 py-2">
                                        {{ $status->nama_status }}
                                    </td>
                                    <td class="border px-3 py-2">
                                        {{ $status->urutan }}
                                    </td>
                                    <td class="border px-3 py-2">
                                        @if ($status->is_final)
                                            <span class="px-2 py-1 text-sm bg-green-100 text-green-700 rounded">
                                                Ya
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-sm bg-gray-100 text-gray-700 rounded">
                                                Tidak
                                            </span>
                                        @endif
                                    </td>
                                    <td class="border px-3 py-2">
                                        <div class="flex gap-2">
                                            <a href="{{ route('admin.statuses.show', $status) }}"
                                               class="px-3 py-1 bg-gray-600 text-white rounded text-sm">
                                                Detail
                                            </a>

                                            <a href="{{ route('admin.statuses.edit', $status) }}"
                                               class="px-3 py-1 bg-yellow-500 text-white rounded text-sm">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.statuses.destroy', $status) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Anda yakin ingin menghapus status ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="px-3 py-1 bg-red-600 text-white rounded text-sm">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="border px-3 py-4 text-center text-gray-500">
                                        Belum ada data status.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $statuses->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
