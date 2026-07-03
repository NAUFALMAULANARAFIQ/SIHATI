<?php

namespace Database\Seeders;

use App\Models\Bidang;
use Illuminate\Database\Seeder;

class BidangSeeder extends Seeder
{
    public function run(): void
    {
        $bidangs = [
            'Sekretariat',
            'Bidang Anggaran',
            'Bidang Perbendaharaan',
            'Bidang Akuntansi',
            'Bidang Aset',
            'Bidang Pajak/Retribusi',
        ];

        foreach ($bidangs as $nama) {
            Bidang::firstOrCreate([
                'nama_bidang' => $nama,
            ]);
        }
    }
}
