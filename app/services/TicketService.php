<?php

namespace App\Services;

use App\Models\Aduan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TicketService
{
    public static function generate(): string {
        return DB::transaction(function () {
            $tahun = Carbon::now()->format('Y');

            $lastTicket = Aduan::select('nomor_tiket')
                ->where('nomor_tiket', 'like', "SIHATI-{$tahun}-%")
                ->orderByDesc('nomor_tiket')
                ->lockForUpdate()
                ->first();
            
            if (! $lastTicket) {
                return "SIHATI-{$tahun}-0000";
            }

            $lastNumber = (int) substr($lastTicket->nomor_tiket, -4);
            $newNumber = $lastNumber + 1;

            return sprintf("SIHATI-%s-%04d", $tahun, $newNumber);
        });
    }
}
