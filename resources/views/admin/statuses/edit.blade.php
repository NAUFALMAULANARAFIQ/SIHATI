<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Status Aduan
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

                    <form action="{{ route('admin.statuses.update', $status) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="kode_status" class="block font-medium text-sm text-gray-700">Kode Status</label>
                            <input type="text"
                                   name="kode_status"
                                   id="kode_status"
                                   value="{{ old('kode_status', $status->kode_status) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300"
                                   required>
                        </div>

                        <div>
                            <label for="nama_status" class="block font-medium text-sm text-gray-700">Nama Status</label>
                            <input type="text"
                                   name="nama_status"
                                   id="nama_status"
                                   value="{{ old('nama_status', $status->nama_status) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300"
                                   required>
                        </div>

                        <div>
                            <label for="urutan" class="block font-medium text-sm text-gray-700">Urutan</label>
                            <input type="number"
                                   name="urutan"
                                   id="urutan"
                                   value="{{ old('urutan', $status->urutan) }}"
                                   min="1"
                                   class="mt-1 block w-full rounded-md border-gray-300"
                                   required>
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox"
                                   name="is_final"
                                   id="is_final"
                                   value="1"
                                   class="rounded"
                                   {{ old('is_final', $status->is_final) ? 'checked' : '' }}>
                            <label for="is_final" class="text-sm text-gray-700">Status final</label>
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.statuses.index') }}"
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
