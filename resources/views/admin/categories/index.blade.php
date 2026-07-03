<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Kelola Kategori Aduan
            </h2>

            <a href="{{ route('admin.categories.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Tambah Kategori
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
                                <th class="border px-3 py-2">Nama Kategori</th>
                                <th class="border px-3 py-2">Deskripsi</th>
                                <th class="border px-3 py-2">Status</th>
                                <th class="border px-3 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td class="border px-3 py-2">
                                        {{ $categories->firstItem() + $loop->index }}
                                    </td>
                                    <td class="border px-3 py-2">
                                        {{ $category->nama_kategori }}
                                    </td>
                                    <td class="border px-3 py-2">
                                        {{ $category->deskripsi ?? '-' }}
                                    </td>
                                    <td class="border px-3 py-2">
                                        @if ($category->is_active)
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
                                            <a href="{{ route('admin.categories.show', $category) }}"
                                               class="px-3 py-1 bg-gray-600 text-white rounded text-sm">
                                                Detail
                                            </a>

                                            <a href="{{ route('admin.categories.edit', $category) }}"
                                               class="px-3 py-1 bg-yellow-500 text-white rounded text-sm">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.categories.destroy', $category) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus/nonaktifkan kategori ini?')">
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
                                        Belum ada data kategori.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
