<?php

namespace App\Http\Requests\Aduan;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttachmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'File wajib dipilih.',
            'file.file' => 'File tidak valid.',
            'file.mimes' => 'File harus berformat: jpg, jpeg, png, atau pdf.',
            'file.max' => 'Ukuran file maksimal 5MB.',
        ];
    }
}
