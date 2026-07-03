<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            ['nama_kategori' => 'Komputer/Laptop', 'deskripsi' => 'Masalah perangkat komputer dan laptop'],
            ['nama_kategori' => 'Printer/Scanner', 'deskripsi' => 'Masalah printer, scanner, dan perangkat cetak'],
            ['nama_kategori' => 'Jaringan Internet', 'deskripsi' => 'Masalah koneksi jaringan dan internet'],
        ]);
    }
}
