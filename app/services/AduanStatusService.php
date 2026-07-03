<?php

namespace App\Services;

use App\Models\Aduan;
use App\Models\AduanStatusHistory;
use App\Models\Status;

class AduanStatusService
{
    private const TRANSITIONS = [
        'diterima' => ['diproses'],
        'diproses' => ['selesai'],
        'selesai' => [],
    ];

    public static function createInitialStatus(Aduan $aduan, int $changeBy): void
    {
        $statusDiterima = Status::where('kode_status', 'diterima')->firstOrFail();

        $aduan->update([
            'status_id' => $statusDiterima->id,
            'tanggal_diterima' => now(),
        ]);

        AduanStatusHistory::create([
            'aduan_id' => $aduan->id,
            'status_sebelumnya_id' => null,
            'status_baru_id' => $statusDiterima->id,
            'changed_by' => $changeBy,
            'keterangan' => 'Aduan dibuat dengan status diterima',
        ]);

        ActivityLogService::log(
            action: 'create_aduan',
            module: 'aduan',
            description: "Pegawai membuat aduan {$aduan->nomor_tiket} dengan status diterima.",
            targetTable: 'aduans',
            targetId: $aduan->id,
            newValues: ['nomor_tiket' => $aduan->nomor_tiket, 'status' => 'diterima']
        );
    }

    public static function updateStatus(Aduan $aduan, string $newStatusKode, int $changeBy, ?string $keterangan = null): void {
        $statusSekarang = $aduan->status;
        $statusBaru = Status::where('kode_status', $newStatusKode)->firstOrFail();

        if (! in_array($newStatusKode,self::TRANSITIONS[$statusSekarang->kode_status] ?? [])) {
            throw new \InvalidArgumentException("Status tidak valid: tidak bisa mengubah dari {$statusSekarang->nama_status} ke {$statusBaru->nama_status}.");
        }

        $oldValues = [
            'status_id' => $statusSekarang->id,
            'status' => $statusSekarang->kode_status,
        ];

        $newValues = [
            'status_id' => $statusBaru->id,
            'status' => $statusBaru->kode_status,
        ];

        $timestampField = match ($newStatusKode) {
            'diproses' => 'tanggal_diproses',
            'selesai' => 'tanggal_selesai',
            default => null,
        };

        $updateData = ['status_id' => $statusBaru->id];
        if ($timestampField) {
            $updateData[$timestampField] = now();
        }

        $aduan->update($updateData);

        AduanStatusHistory::create([
            'aduan_id' => $aduan->id,
            'status_sebelumnya_id' => $statusSekarang->id,
            'status_baru_id' => $statusBaru->id,
            'changed_by' => $changeBy,
            'keterangan' => $keterangan,
        ]);

        ActivityLogService::log(
            action: 'update_status',
            module: 'aduan',
            description: "Admin mengubah status aduan {$aduan->nomor_tiket} dari {$statusSekarang->nama_status} menjadi {$statusBaru->nama_status}.",
            targetTable: 'aduans',
            targetId: $aduan->id,
            oldValues: $oldValues,
            newValues: $newValues
        );
    }
}
