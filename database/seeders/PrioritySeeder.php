<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    public function run(): void
    {
        $priorities = [
            ['nama_prioritas' => 'Rendah', 'keterangan' => 'Masalah tidak terlalu mengganggu pekerjaan utama', 'level' => 1],
            ['nama_prioritas' => 'Sedang', 'keterangan' => 'Masalah menghambat sebagian pekerjaan', 'level' => 2],
            ['nama_prioritas' => 'Tinggi', 'keterangan' => 'Masalah menghambat pekerjaan penting', 'level' => 3],
            ['nama_prioritas' => 'Mendesak', 'keterangan' => 'Masalah berdampak besar dan harus segera ditangani', 'level' => 4],
        ];

        foreach ($priorities as $priority) {
            Priority::firstOrCreate(
                ['nama_prioritas' => $priority['nama_prioritas']],
                $priority
            );
        }
    }
}
