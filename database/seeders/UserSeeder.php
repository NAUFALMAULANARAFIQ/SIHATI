<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'bidang_id' => 1,
                'name' => 'Andi Saputra',
                'username' => 'andi',
                'email' => 'andi@bppkad.go.id',
                'no_hp' => '08123456789',
                'password' => Hash::make('password'),
                'role' => 'pegawai',
                'is_active' => true,
            ],
            [
                'bidang_id' => 2,
                'name' => 'Budi Santoso',
                'username' => 'budi',
                'email' => 'budi@bppkad.go.id',
                'no_hp' => '08123456780',
                'password' => Hash::make('password'),
                'role' => 'pegawai',
                'is_active' => true,
            ],
            [
                'bidang_id' => 3,
                'name' => 'Citra Dewi',
                'username' => 'citra',
                'email' => 'citra@bppkad.go.id',
                'no_hp' => '08123456781',
                'password' => Hash::make('password'),
                'role' => 'pegawai',
                'is_active' => true,
            ],
            [
                'bidang_id' => 3,
                'name' => 'Petugas IT',
                'username' => 'petugas',
                'email' => 'petugas@bppkad.go.id',
                'no_hp' => '08123456782',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
            ],
            [
                'bidang_id' => 3,
                'name' => 'Admin Sistem',
                'username' => 'admin',
                'email' => 'admin@bppkad.go.id',
                'no_hp' => '08123456783',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
            ],
        ]);
    }
}
