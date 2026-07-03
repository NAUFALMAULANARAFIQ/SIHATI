<?php

namespace App\Http\Requests\Aduan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status_kode' => ['required', 'string', 'in:diterima,diproses,selesai'],
            'keterangan' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'status_kode.required' => 'Status wajib dipilih.',
            'status_kode.in' => 'Status tidak valid. Harus: diterima, diproses, atau selesai.',
        ];
    }
}
