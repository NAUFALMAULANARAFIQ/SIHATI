<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use App\Services\AduanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AduanController extends Controller
{
    public function index(Request $request)
    {
        $query = Aduan::with([
            'pelapor',
            'petugas',
            'bidang',
            'category',
            'priority',
            'status'
        ]);

        if ($request->filled('status')) {
            $query->whereHas('status', fn($q) => $q->where('kode_status', $request->status));
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('priority')) {
            $query->where('priority_id', $request->priority);
        }

        if ($request->filled('bidang')) {
            $query->where('bidang_id', $request->bidang);
        }

        if ($request->filled('petugas')) {
            $query->where('petugas_id', $request->petugas);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', "%{$request->search}%")
                  ->orWhere('nomor_tiket', 'like', "%{$request->search}%");
            });
        }

        $aduans = $query->latest('tanggal_aduan')->paginate(20)->withQueryString();

        return view('admin.aduan.index', compact('aduans'));
    }

    public function show(Aduan $aduan)
    {
        $aduan->load([
            'pelapor',
            'petugas',
            'bidang',
            'category',
            'priority',
            'status',
            'attachments.uploader',
            'notes.petugas',
            'comments.user',
            'histories' => fn($q) => $q->with(['statusSebelumnya', 'statusBaru', 'changedBy'])->latest(),
            'ratings.user',
        ]);

        return view('admin.aduan.show', compact('aduan'));
    }
}
