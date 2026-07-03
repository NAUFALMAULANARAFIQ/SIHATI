<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    public function run(): void
    {
        Priority::insert([
            ['nama_prioritas' => 'Rendah',   'keterangan' => 'Tidak mengganggu pekerjaan utama',      'level' => 1],
            ['nama_prioritas' => 'Sedang',   'keterangan' => 'Mengganggu tapi masih bisa ditoleransi', 'level' => 2],
            ['nama_prioritas' => 'Tinggi',   'keterangan' => 'Mengganggu pekerjaan utama',             'level' => 3],
            ['nama_prioritas' => 'Mendesak', 'keterangan' => 'Menghentikan seluruh pekerjaan',         'level' => 4],
        ]);
    }
}
