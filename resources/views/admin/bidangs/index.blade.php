<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Kelola Bidang
            </h2>

            <a href="{{ route('admin.bidangs.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Tambah Bidang
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
                                <th class="border px-3 py-2">Nama Bidang</th>
                                <th class="border px-3 py-2">Keterangan</th>
                                <th class="border px-3 py-2">Status</th>
                                <th class="border px-3 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bidangs as $bidang)
                                <tr>
                                    <td class="border px-3 py-2">
                                        {{ $bidangs->firstItem() + $loop->index }}
                                    </td>
                                    <td class="border px-3 py-2">
                                        {{ $bidang->nama_bidang }}
                                    </td>
                                    <td class="border px-3 py-2">
                                        {{ $bidang->keterangan ?? '-' }}
                                    </td>
                                    <td class="border px-3 py-2">
                                        @if ($bidang->is_active)
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
                                            <a href="{{ route('admin.bidangs.show', $bidang) }}"
                                               class="px-3 py-1 bg-gray-600 text-white rounded text-sm">
                                                Detail
                                            </a>

                                            <a href="{{ route('admin.bidangs.edit', $bidang) }}"
                                               class="px-3 py-1 bg-yellow-500 text-white rounded text-sm">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.bidangs.destroy', $bidang) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus/nonaktifkan bidang ini?')">
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
                                    <td colspan="5" class="border px-3 py-4 text-center text-gray-500">
                                        Belum ada data bidang.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $bidangs->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
