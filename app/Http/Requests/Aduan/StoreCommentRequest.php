<?php

namespace App\Http\Requests\Aduan;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'komentar' => ['required', 'string', 'min:3'],
        ];
    }

    public function messages(): array
    {
        return [
            'komentar.required' => 'Komentar wajib diisi.',
            'komentar.min' => 'Komentar minimal 3 karakter.',
        ];
    }
}
