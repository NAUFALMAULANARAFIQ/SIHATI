<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Status Aduan
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

                    <form action="{{ route('admin.statuses.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Kode Status</label>
                            <input type="text"
                                   name="kode_status"
                                   value="{{ old('kode_status') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300"
                                   placeholder="contoh: diproses"
                                   required>
                            <p class="text-sm text-gray-500 mt-1">
                                Gunakan huruf kecil dan underscore. Contoh: menunggu_konfirmasi.
                            </p>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Nama Status</label>
                            <input type="text"
                                   name="nama_status"
                                   value="{{ old('nama_status') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300"
                                   placeholder="contoh: Diproses"
                                   required>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Urutan</label>
                            <input type="number"
                                   name="urutan"
                                   value="{{ old('urutan', 1) }}"
                                   min="1"
                                   class="mt-1 block w-full rounded-md border-gray-300"
                                   required>
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox"
                                   name="is_final"
                                   value="1"
                                   class="rounded"
                                   {{ old('is_final') ? 'checked' : '' }}>
                            <label class="text-sm text-gray-700">Status final</label>
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.statuses.index') }}"
                               class="px-4 py-2 bg-gray-500 text-white rounded-md">
                                Batal
                            </a>

                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md">
                                Simpan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
