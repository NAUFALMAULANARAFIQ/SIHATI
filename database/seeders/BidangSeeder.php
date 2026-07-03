<?php

namespace Database\Seeders;

use App\Models\Bidang;
use Illuminate\Database\Seeder;

class BidangSeeder extends Seeder
{
    public function run(): void
    {
        Bidang::insert([
            ['nama_bidang' => 'Bidang Anggaran',        'keterangan' => 'Mengelola anggaran daerah'],
            ['nama_bidang' => 'Bidang Perbendaharaan',  'keterangan' => 'Mengelola perbendaharaan daerah'],
            ['nama_bidang' => 'Sekretariat',            'keterangan' => 'Bagian tata usaha dan umum'],
        ]);
    }
}
