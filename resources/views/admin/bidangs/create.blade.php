<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Bidang
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

                    <form action="{{ route('admin.bidangs.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label for="nama_bidang" class="block font-medium text-sm text-gray-700">Nama Bidang</label>
                            <input type="text"
                                   name="nama_bidang"
                                   id="nama_bidang"
                                   value="{{ old('nama_bidang') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300"
                                   required>
                        </div>

                        <div>
                            <label for="keterangan" class="block font-medium text-sm text-gray-700">Keterangan</label>
                            <textarea name="keterangan"
                                      id="keterangan"
                                      rows="4"
                                      class="mt-1 block w-full rounded-md border-gray-300">{{ old('keterangan') }}</textarea>
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox"
                                   name="is_active"
                                   id="is_active"
                                   value="1"
                                   class="rounded"
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label for="is_active" class="text-sm text-gray-700">Bidang aktif</label>
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.bidangs.index') }}"
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
