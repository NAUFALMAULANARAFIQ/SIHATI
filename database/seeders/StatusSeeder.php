<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['kode_status' => 'baru', 'nama_status' => 'Baru', 'urutan' => 1, 'is_final' => false],
            ['kode_status' => 'diterima', 'nama_status' => 'Diterima', 'urutan' => 2, 'is_final' => false],
            ['kode_status' => 'diproses', 'nama_status' => 'Diproses', 'urutan' => 3, 'is_final' => false],
            ['kode_status' => 'menunggu_konfirmasi', 'nama_status' => 'Menunggu Konfirmasi', 'urutan' => 4, 'is_final' => false],
            ['kode_status' => 'selesai', 'nama_status' => 'Selesai', 'urutan' => 5, 'is_final' => true],
            ['kode_status' => 'ditolak', 'nama_status' => 'Ditolak', 'urutan' => 6, 'is_final' => true],
            ['kode_status' => 'dibatalkan', 'nama_status' => 'Dibatalkan', 'urutan' => 7, 'is_final' => true],
        ];

        foreach ($statuses as $status) {
            Status::firstOrCreate(
                ['kode_status' => $status['kode_status']],
                $status
            );
        }
    }
}
