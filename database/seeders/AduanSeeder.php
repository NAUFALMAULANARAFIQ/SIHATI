<?php

namespace Database\Seeders;

use App\Models\Aduan;
use App\Models\AduanAttachment;
use App\Models\AduanComment;
use App\Models\AduanNote;
use App\Models\AduanStatusHistory;
use Illuminate\Database\Seeder;

class AduanSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // Aduan 1 — Diterima
        $aduan1 = Aduan::create([
            'nomor_tiket' => 'SIHATI-2026-0001',
            'pelapor_id' => 1,
            'petugas_id' => null,
            'bidang_id' => 1,
            'category_id' => 2,
            'priority_id' => 2,
            'status_id' => 1,
            'judul' => 'Printer tidak bisa mencetak',
            'deskripsi' => 'Printer menyala tetapi dokumen tidak keluar. Kabel sudah diperiksa dan terhubung dengan baik. Driver printer sudah diinstall ulang tetapi tetap tidak berfungsi.',
            'lokasi' => 'Ruang Bidang Anggaran Lt. 2',
            'no_kontak' => '08123456789',
            'tanggal_aduan' => '2026-07-03 08:10:00',
            'tanggal_diterima' => '2026-07-03 08:10:00',
            'tanggal_diproses' => null,
            'tanggal_selesai' => null,
            'created_at' => '2026-07-03 08:10:00',
            'updated_at' => '2026-07-03 08:10:00',
        ]);

        AduanAttachment::create([
            'aduan_id' => $aduan1->id,
            'uploaded_by' => 1,
            'file_name' => 'foto_printer.jpg',
            'file_path' => 'aduan/foto_printer.jpg',
            'file_type' => 'image/jpeg',
            'file_size' => 204800,
            'created_at' => '2026-07-03 08:10:00',
        ]);

        AduanStatusHistory::create([
            'aduan_id' => $aduan1->id,
            'status_sebelumnya_id' => null,
            'status_baru_id' => 1,
            'changed_by' => 1,
            'keterangan' => 'Aduan berhasil dibuat',
            'created_at' => '2026-07-03 08:10:00',
        ]);

        AduanComment::create([
            'aduan_id' => $aduan1->id,
            'user_id' => 1,
            'komentar' => 'Mohon segera ditangani karena printer ini digunakan untuk cetak laporan keuangan.',
            'created_at' => '2026-07-03 08:15:00',
        ]);

        // Aduan 2 — Diproses
        $aduan2 = Aduan::create([
            'nomor_tiket' => 'SIHATI-2026-0002',
            'pelapor_id' => 2,
            'petugas_id' => 4,
            'bidang_id' => 2,
            'category_id' => 1,
            'priority_id' => 3,
            'status_id' => 2,
            'judul' => 'Laptop lambat dan sering hang',
            'deskripsi' => 'Laptop sering hang saat membuka aplikasi Microsoft Office. Sudah terjadi sejak 3 hari yang lalu. Kapasitas RAM 8GB dan penyimpanan masih tersisa 50GB.',
            'lokasi' => 'Ruang Bidang Perbendaharaan',
            'no_kontak' => '08123456789',
            'tanggal_aduan' => '2026-07-04 09:30:00',
            'tanggal_diterima' => '2026-07-04 09:30:00',
            'tanggal_diproses' => '2026-07-04 10:00:00',
            'tanggal_selesai' => null,
            'created_at' => '2026-07-04 09:30:00',
            'updated_at' => '2026-07-04 10:00:00',
        ]);

        AduanStatusHistory::create([
            'aduan_id' => $aduan2->id,
            'status_sebelumnya_id' => null,
            'status_baru_id' => 1,
            'changed_by' => 2,
            'keterangan' => 'Aduan berhasil dibuat',
            'created_at' => '2026-07-04 09:30:00',
        ]);

        AduanStatusHistory::create([
            'aduan_id' => $aduan2->id,
            'status_sebelumnya_id' => 1,
            'status_baru_id' => 2,
            'changed_by' => 4,
            'keterangan' => 'Aduan mulai ditangani',
            'created_at' => '2026-07-04 10:00:00',
        ]);

        AduanNote::create([
            'aduan_id' => $aduan2->id,
            'petugas_id' => 4,
            'catatan' => 'Pemeriksaan awal: laptop terindikasi overheating. Akan dibersihkan dan dilakukan pengecekan thermal paste.',
            'created_at' => '2026-07-04 10:30:00',
        ]);

        AduanComment::create([
            'aduan_id' => $aduan2->id,
            'user_id' => 2,
            'komentar' => 'Mohon segera ditangani karena printer ini digunakan untuk cetak laporan keuangan.',
            'created_at' => '2026-07-04 09:35:00',
        ]);

        AduanComment::create([
            'aduan_id' => $aduan2->id,
            'user_id' => 4,
            'komentar' => 'Baik, akan kami periksa. Mohon tunggu konfirmasi selanjutnya.',
            'created_at' => '2026-07-04 10:05:00',
        ]);

        // Aduan 3 — Selesai
        $aduan3 = Aduan::create([
            'nomor_tiket' => 'SIHATI-2026-0003',
            'pelapor_id' => 3,
            'petugas_id' => 4,
            'bidang_id' => 3,
            'category_id' => 3,
            'priority_id' => 4,
            'status_id' => 3,
            'judul' => 'Aplikasi SIPKD tidak bisa diakses',
            'deskripsi' => 'Tidak bisa login ke aplikasi SIPKD sejak pagi hari. Muncul pesan error "Connection failed". Sudah menghubungi bagian IT tetapi belum ada respon.',
            'lokasi' => 'Ruang Sekretariat',
            'no_kontak' => '08123456789',
            'tanggal_aduan' => '2026-07-04 11:00:00',
            'tanggal_diterima' => '2026-07-04 11:00:00',
            'tanggal_diproses' => '2026-07-04 13:00:00',
            'tanggal_selesai' => '2026-07-04 15:30:00',
            'created_at' => '2026-07-04 11:00:00',
            'updated_at' => '2026-07-04 15:30:00',
        ]);

        AduanStatusHistory::create([
            'aduan_id' => $aduan3->id,
            'status_sebelumnya_id' => null,
            'status_baru_id' => 1,
            'changed_by' => 3,
            'keterangan' => 'Aduan berhasil dibuat',
            'created_at' => '2026-07-04 11:00:00',
        ]);

        AduanStatusHistory::create([
            'aduan_id' => $aduan3->id,
            'status_sebelumnya_id' => 1,
            'status_baru_id' => 2,
            'changed_by' => 4,
            'keterangan' => 'Aduan mulai ditangani',
            'created_at' => '2026-07-04 13:00:00',
        ]);

        AduanStatusHistory::create([
            'aduan_id' => $aduan3->id,
            'status_sebelumnya_id' => 2,
            'status_baru_id' => 3,
            'changed_by' => 4,
            'keterangan' => 'Aduan telah selesai ditangani',
            'created_at' => '2026-07-04 15:30:00',
        ]);

        AduanNote::create([
            'aduan_id' => $aduan3->id,
            'petugas_id' => 4,
            'catatan' => 'Aplikasi SIPKD berhasil diakses kembali setelah dilakukan restart server database.',
            'created_at' => '2026-07-04 14:00:00',
        ]);

        AduanComment::create([
            'aduan_id' => $aduan3->id,
            'user_id' => 3,
            'komentar' => 'Mohon segera ditangani karena printer ini digunakan untuk cetak laporan keuangan.',
            'created_at' => '2026-07-04 11:05:00',
        ]);

        AduanComment::create([
            'aduan_id' => $aduan3->id,
            'user_id' => 4,
            'komentar' => 'Baik, akan kami periksa. Mohon tunggu konfirmasi selanjutnya.',
            'created_at' => '2026-07-04 13:05:00',
        ]);
    }
}
