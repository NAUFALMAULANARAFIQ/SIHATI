<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use \Illuminate\Database\Console\Seeds\WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            StatusSeeder::class,
            CategorySeeder::class,
            PrioritySeeder::class,
            BidangSeeder::class,
            UserSeeder::class,
            AduanSeeder::class,
            ActivityLogSeeder::class,
        ]);
    }
}
