<?php

namespace Database\Seeders;

use App\Models\Bidang;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $sekretariat = Bidang::where('nama_bidang', 'Sekretariat')->first();

        User::firstOrCreate(
            ['email' => 'admin@sihati.local'],
            [
                'bidang_id' => $sekretariat?->id,
                'name' => 'Admin SIHATI',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'no_hp' => '081234567890',
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'petugas@sihati.local'],
            [
                'bidang_id' => $sekretariat?->id,
                'name' => 'Petugas IT',
                'username' => 'petugasit',
                'password' => Hash::make('password'),
                'no_hp' => '081234567891',
                'role' => 'pegawai',
                'is_active' => true,
            ]
        );
    }
}
