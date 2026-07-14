<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use App\Services\AduanService;
use App\Http\Requests\Aduan\UpdateStatusRequest;
use Illuminate\Support\Facades\Auth;

class AduanStatusController extends Controller
{
    public function update(UpdateStatusRequest $request, Aduan $aduan)
    {
        try {
            if ($request->filled('priority_id')) {
                $aduan->update(['priority_id' => $request->priority_id]);
            } elseif ($request->has('priority_id')) {
                $aduan->update(['priority_id' => null]);
            }

            $aduan = AduanService::changeStatus(
                $aduan,
                $request->status_kode,
                Auth::id(),
                $request->keterangan
            );

            return redirect()
                ->route('admin.aduan.show', $aduan->id)
                ->with('success', "Status aduan berhasil diubah menjadi {$aduan->status->nama_status}.");
        } catch (\InvalidArgumentException $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }
}
