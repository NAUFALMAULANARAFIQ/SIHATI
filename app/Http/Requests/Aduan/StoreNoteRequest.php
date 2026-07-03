<?php

namespace App\Http\Requests\Aduan;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'catatan' => ['required', 'string', 'min:10'],
        ];
    }

    public function messages(): array
    {
        return [
            'catatan.required' => 'Catatan penanganan wajib diisi.',
            'catatan.min' => 'Catatan minimal 10 karakter.',
        ];
    }
}
