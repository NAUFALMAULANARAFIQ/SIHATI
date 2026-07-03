<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use App\Services\AduanService;
use App\Services\ActivityLogService;
use App\Http\Requests\Aduan\StoreNoteRequest;
use App\Http\Requests\Aduan\StoreCommentRequest;
use App\Http\Requests\Aduan\StoreAttachmentRequest;
use App\Http\Requests\Aduan\UpdateStatusRequest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Aduan::with(['pelapor', 'petugas', 'bidang', 'category', 'priority', 'status']);

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

        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal_aduan', '>=', $request->tanggal_dari);
        }

        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal_aduan', '<=', $request->tanggal_sampai);
        }

        $aduans = $query->get();

        $totalAduan = $aduans->count();
        $diterima = $aduans->where('status.kode_status', 'diterima')->count();
        $diproses = $aduans->where('status.kode_status', 'diproses')->count();
        $selesai = $aduans->where('status.kode_status', 'selesai')->count();

        $aduanSelesai = Aduan::whereHas('status', fn($q) => $q->where('kode_status', 'selesai'));
        $ratingAvg = $aduanSelesai->join('ratings', 'aduans.id', '=', 'ratings.aduan_id')->avg('ratings.rating');

        return view('admin.laporan.index', compact(
            'aduans',
            'totalAduan',
            'diterima',
            'diproses',
            'selesai',
            'ratingAvg',
            'request'
        ));
    }

    public function print(Request $request)
    {
        $query = Aduan::with(['pelapor', 'petugas', 'bidang', 'category', 'priority', 'status']);

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

        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal_aduan', '>=', $request->tanggal_dari);
        }

        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal_aduan', '<=', $request->tanggal_sampai);
        }

        $aduans = $query->get();

        $pdf = Pdf::loadView('admin.laporan.print', compact('aduans', 'request'));
        
        ActivityLogService::log(
            action: 'print_laporan',
            module: 'laporan',
            description: "Admin mencetak laporan aduan.",
            targetTable: 'aduans'
        );

        return $pdf->stream("laporan-aduan-" . date('Y-m-d') . ".pdf");
    }

    public function export(Request $request)
    {
        $query = Aduan::with(['pelapor', 'petugas', 'bidang', 'category', 'priority', 'status']);

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

        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal_aduan', '>=', $request->tanggal_dari);
        }

        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal_aduan', '<=', $request->tanggal_sampai);
        }

        $aduans = $query->get();

        $data = $aduans->map(function ($aduan) {
            return [
                'Nomor Tiket' => $aduan->nomor_tiket,
                'Tanggal Aduan' => $aduan->tanggal_aduan->format('d/m/Y H:i'),
                'Pelapor' => $aduan->pelapor->name,
                'Bidang' => $aduan->bidang->nama_bidang,
                'Kategori' => $aduan->category->nama_kategori,
                'Prioritas' => $aduan->priority?->nama_prioritas ?? '-',
                'Judul' => $aduan->judul,
                'Deskripsi' => $aduan->deskripsi,
                'Lokasi' => $aduan->lokasi ?? '-',
                'Status' => $aduan->status->nama_status,
                'Petugas' => $aduan->petugas?->name ?? '-',
            ];
        });

        ActivityLogService::log(
            action: 'export_laporan',
            module: 'laporan',
            description: "Admin mengekspor laporan aduan ke Excel.",
            targetTable: 'aduans'
        );

        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\AduanExport($data),
            "laporan-aduan-" . date('Y-m-d') . ".xlsx"
        );
    }
}
