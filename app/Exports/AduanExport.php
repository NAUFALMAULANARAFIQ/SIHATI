<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AduanExport implements FromCollection, WithHeadings, WithMapping
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'Nomor Tiket',
            'Tanggal Aduan',
            'Pelapor',
            'Bidang',
            'Kategori',
            'Prioritas',
            'Judul',
            'Deskripsi',
            'Lokasi',
            'Status',
            'Petugas',
        ];
    }

    public function map($row): array
    {
        return [
            $row['Nomor Tiket'],
            $row['Tanggal Aduan'],
            $row['Pelapor'],
            $row['Bidang'],
            $row['Kategori'],
            $row['Prioritas'],
            $row['Judul'],
            $row['Deskripsi'],
            $row['Lokasi'],
            $row['Status'],
            $row['Petugas'],
        ];
    }
}
