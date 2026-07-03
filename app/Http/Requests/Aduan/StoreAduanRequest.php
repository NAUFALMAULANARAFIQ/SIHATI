<?php

namespace App\Http\Requests\Aduan;

use Illuminate\Foundation\Http\FormRequest;

class StoreAduanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bidang_id' => ['required', 'exists:bidangs,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'priority_id' => ['nullable', 'exists:priorities,id'],
            'judul' => ['required', 'string', 'max:150'],
            'deskripsi' => ['required', 'string'],
            'lokasi' => ['nullable', 'string', 'max:150'],
            'no_kontak' => ['nullable', 'string', 'max:20'],
            'attachments' => ['nullable', 'array', 'max:5'],
            'attachments.*' => ['file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'bidang_id.required' => 'Bidang wajib dipilih.',
            'bidang_id.exists' => 'Bidang tidak valid.',
            'category_id.required' => 'Kategori aduan wajib dipilih.',
            'category_id.exists' => 'Kategori tidak valid.',
            'priority_id.exists' => 'Prioritas tidak valid.',
            'judul.required' => 'Judul aduan wajib diisi.',
            'judul.max' => 'Judul maksimal 150 karakter.',
            'deskripsi.required' => 'Deskripsi aduan wajib diisi.',
            'lokasi.max' => 'Lokasi maksimal 150 karakter.',
            'no_kontak.max' => 'Nomor kontak maksimal 20 karakter.',
            'attachments.max' => 'Maksimal 5 file lampiran.',
            'attachments.*.file' => 'Lampiran harus berupa file.',
            'attachments.*.mimes' => 'Lampiran harus berformat: jpg, jpeg, png, atau pdf.',
            'attachments.*.max' => 'Ukuran file maksimal 5MB.',
        ];
    }
}
