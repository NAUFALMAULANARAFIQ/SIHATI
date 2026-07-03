<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalAduan = Aduan::count();

        $aduanDiterima = Aduan::whereHas('status', fn($q) => $q->where('kode_status', 'diterima'))->count();
        $aduanDiproses = Aduan::whereHas('status', fn($q) => $q->where('kode_status', 'diproses'))->count();
        $aduanSelesai = Aduan::whereHas('status', fn($q) => $q->where('kode_status', 'selesai'))->count();

        $aduanTerbaru = Aduan::with(['pelapor', 'category', 'status'])->latest('tanggal_aduan')->take(10)->get();

        return view('admin.dashboard', compact(
            'totalAduan',
            'aduanDiterima',
            'aduanDiproses',
            'aduanSelesai',
            'aduanTerbaru'
        ));
    }
}
