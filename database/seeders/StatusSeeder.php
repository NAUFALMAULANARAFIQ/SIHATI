<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['kode_status' => 'diterima', 'nama_status' => 'Diterima', 'urutan' => 1, 'is_final' => false],
            ['kode_status' => 'diproses', 'nama_status' => 'Diproses', 'urutan' => 2, 'is_final' => false],
            ['kode_status' => 'selesai', 'nama_status' => 'Selesai', 'urutan' => 3, 'is_final' => true],
        ];

        foreach ($statuses as $status) {
            Status::firstOrCreate(
                ['kode_status' => $status['kode_status']],
                $status
            );
        }
    }
}
