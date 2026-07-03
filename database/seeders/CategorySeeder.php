<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nama_kategori' => 'Komputer/Laptop', 'deskripsi' => 'Masalah komputer, laptop, lambat, error, atau tidak menyala'],
            ['nama_kategori' => 'Printer/Scanner', 'deskripsi' => 'Masalah printer, scanner, tinta, kertas macet, atau gagal cetak'],
            ['nama_kategori' => 'Jaringan Internet', 'deskripsi' => 'Masalah WiFi, LAN, koneksi internet lambat atau terputus'],
            ['nama_kategori' => 'Aplikasi/Sistem', 'deskripsi' => 'Masalah aplikasi internal atau sistem kerja'],
            ['nama_kategori' => 'Akun/Login', 'deskripsi' => 'Masalah lupa password, akun terkunci, atau gagal login'],
            ['nama_kategori' => 'Email', 'deskripsi' => 'Masalah email masuk, email keluar, atau konfigurasi email'],
            ['nama_kategori' => 'Perangkat Pendukung', 'deskripsi' => 'Masalah monitor, proyektor, kabel, UPS, dan perangkat lain'],
            ['nama_kategori' => 'Lainnya', 'deskripsi' => 'Masalah lain yang belum masuk kategori utama'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['nama_kategori' => $category['nama_kategori']],
                $category
            );
        }
    }
}
