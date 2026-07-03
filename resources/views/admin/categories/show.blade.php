<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Kategori Aduan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-4">

                    <div>
                        <p class="text-sm text-gray-500">Nama Kategori</p>
                        <p class="font-semibold">{{ $category->nama_kategori }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Deskripsi</p>
                        <p class="font-semibold">{{ $category->deskripsi ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        <p class="font-semibold">{{ $category->is_active ? 'Aktif' : 'Nonaktif' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Dibuat Pada</p>
                        <p class="font-semibold">{{ $category->created_at?->format('d-m-Y H:i') }}</p>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.categories.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded-md">
                            Kembali
                        </a>

                        <a href="{{ route('admin.categories.edit', $category) }}"
                           class="px-4 py-2 bg-yellow-500 text-white rounded-md">
                            Edit
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
