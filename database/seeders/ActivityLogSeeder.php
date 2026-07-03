<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use Illuminate\Database\Seeder;

class ActivityLogSeeder extends Seeder
{
    public function run(): void
    {
        ActivityLog::insert([
            [
                'user_id' => 1,
                'action' => 'create',
                'module' => 'aduan',
                'description' => 'Pegawai membuat aduan SIHATI-2026-0001',
                'target_table' => 'aduans',
                'target_id' => 1,
                'old_values' => null,
                'new_values' => null,
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0',
                'created_at' => '2026-07-03 08:10:00',
                'updated_at' => '2026-07-03 08:10:00',
            ],
            [
                'user_id' => 2,
                'action' => 'create',
                'module' => 'aduan',
                'description' => 'Pegawai membuat aduan SIHATI-2026-0002',
                'target_table' => 'aduans',
                'target_id' => 2,
                'old_values' => null,
                'new_values' => null,
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0',
                'created_at' => '2026-07-04 09:30:00',
                'updated_at' => '2026-07-04 09:30:00',
            ],
            [
                'user_id' => 3,
                'action' => 'create',
                'module' => 'aduan',
                'description' => 'Pegawai membuat aduan SIHATI-2026-0003',
                'target_table' => 'aduans',
                'target_id' => 3,
                'old_values' => null,
                'new_values' => null,
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0',
                'created_at' => '2026-07-04 11:00:00',
                'updated_at' => '2026-07-04 11:00:00',
            ],
            [
                'user_id' => 4,
                'action' => 'update_status',
                'module' => 'aduan',
                'description' => 'Admin mengubah status aduan SIHATI-2026-0002 dari diterima menjadi diproses.',
                'target_table' => 'aduans',
                'target_id' => 2,
                'old_values' => json_encode(['status_id' => 1, 'status' => 'diterima']),
                'new_values' => json_encode(['status_id' => 2, 'status' => 'diproses']),
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0',
                'created_at' => '2026-07-04 10:00:00',
                'updated_at' => '2026-07-04 10:00:00',
            ],
            [
                'user_id' => 4,
                'action' => 'update_status',
                'module' => 'aduan',
                'description' => 'Admin mengubah status aduan SIHATI-2026-0003 dari diterima menjadi diproses.',
                'target_table' => 'aduans',
                'target_id' => 3,
                'old_values' => json_encode(['status_id' => 1, 'status' => 'diterima']),
                'new_values' => json_encode(['status_id' => 2, 'status' => 'diproses']),
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0',
                'created_at' => '2026-07-04 13:00:00',
                'updated_at' => '2026-07-04 13:00:00',
            ],
            [
                'user_id' => 4,
                'action' => 'update_status',
                'module' => 'aduan',
                'description' => 'Admin mengubah status aduan SIHATI-2026-0003 dari diproses menjadi selesai.',
                'target_table' => 'aduans',
                'target_id' => 3,
                'old_values' => json_encode(['status_id' => 2, 'status' => 'diproses']),
                'new_values' => json_encode(['status_id' => 3, 'status' => 'selesai']),
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0',
                'created_at' => '2026-07-04 15:30:00',
                'updated_at' => '2026-07-04 15:30:00',
            ],
        ]);
    }
}
