<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use App\Services\AduanService;
use App\Http\Requests\Aduan\StoreAduanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AduanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Aduan::where('pelapor_id', $user->id)
            ->with(['category', 'priority', 'status', 'bidang']);

        if ($request->filled('status')) {
            $query->whereHas('status', fn($q) => $q->where('kode_status', $request->status));
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', "%{$request->search}%")
                  ->orWhere('nomor_tiket', 'like', "%{$request->search}%");
            });
        }

        $aduans = $query->latest('tanggal_aduan')->paginate(10);

        return view('pegawai.aduan.index', compact('aduans'));
    }

    public function create()
    {
        return view('pegawai.aduan.create');
    }

    public function store(StoreAduanRequest $request)
    {
        $user = Auth::user();

        $data = $request->validated();

        if (!isset($data['bidang_id'])) {
            $data['bidang_id'] = $user->bidang_id;
        }

        $attachments = $request->hasFile('attachments') ? $request->file('attachments') : null;

        $aduan = AduanService::create($data, $user->id, $attachments);

        return redirect()
            ->route('pegawai.aduan.show', $aduan->id)
            ->with('success', "Aduan berhasil dibuat dengan nomor tiket {$aduan->nomor_tiket}.");
    }

    public function show(Aduan $aduan)
    {
        $user = Auth::user();

        if ($aduan->pelapor_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke aduan ini.');
        }

        $aduan->load([
            'pelapor',
            'bidang',
            'category',
            'priority',
            'status',
            'attachments.uploader',
            'notes.petugas',
            'comments.user',
            'histories.statusSebelumnya',
            'histories.statusBaru',
            'histories.changedBy',
            'ratings.user',
        ]);

        return view('pegawai.aduan.show', compact('aduan'));
    }
}
