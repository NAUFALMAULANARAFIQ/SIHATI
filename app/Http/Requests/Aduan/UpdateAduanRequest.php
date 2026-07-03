<?php

namespace App\Http\Requests\Aduan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAduanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['nullable', 'exists:categories,id'],
            'priority_id' => ['nullable', 'exists:priorities,id'],
            'judul' => ['nullable', 'string', 'max:150'],
            'deskripsi' => ['nullable', 'string'],
            'lokasi' => ['nullable', 'string', 'max:150'],
            'no_kontak' => ['nullable', 'string', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.exists' => 'Kategori tidak valid.',
            'priority_id.exists' => 'Prioritas tidak valid.',
            'judul.max' => 'Judul maksimal 150 karakter.',
            'lokasi.max' => 'Lokasi maksimal 150 karakter.',
            'no_kontak.max' => 'Nomor kontak maksimal 20 karakter.',
        ];
    }
}
