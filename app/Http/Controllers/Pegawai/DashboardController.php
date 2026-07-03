<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalAduan = Aduan::where('pelapor_id', $user->id)->count();

        $aduanDiterima = Aduan::where('pelapor_id', $user->id)
            ->whereHas('status', fn($q) => $q->where('kode_status', 'diterima'))
            ->count();

        $aduanDiproses = Aduan::where('pelapor_id', $user->id)
            ->whereHas('status', fn($q) => $q->where('kode_status', 'diproses'))
            ->count();

        $aduanSelesai = Aduan::where('pelapor_id', $user->id)
            ->whereHas('status', fn($q) => $q->where('kode_status', 'selesai'))
            ->count();

        $aduanTerbaru = Aduan::where('pelapor_id', $user->id)
            ->with(['category', 'priority', 'status'])
            ->latest('tanggal_aduan')
            ->take(5)
            ->get();

        return view('pegawai.dashboard', compact(
            'totalAduan',
            'aduanDiterima',
            'aduanDiproses',
            'aduanSelesai',
            'aduanTerbaru'
        ));
    }
}
