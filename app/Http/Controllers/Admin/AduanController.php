<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Aduan\StoreAduanRequest;
use App\Models\Aduan;
use App\Models\Bidang;
use App\Models\Category;
use App\Models\Priority;
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

        $aduans = $query->latest('tanggal_aduan')->paginate(15)->withQueryString();

        $categories = Category::where('is_active', true)->get();
        $priorities = Priority::all();
        $bidangs = Bidang::all();

        return view('admin.aduan.index', compact('aduans', 'categories', 'priorities', 'bidangs'));
    }

    public function create()
    {
        return redirect()->route('admin.aduan.index');
    }

    public function store(StoreAduanRequest $request)
    {
        $user = Auth::user();

        $data = $request->validated();

        $attachments = $request->hasFile('attachments') ? $request->file('attachments') : null;

        $aduan = AduanService::create($data, $user->id, $attachments);

        return redirect()
            ->route('admin.aduan.index')
            ->with('success', "Aduan berhasil dibuat dengan nomor tiket {$aduan->nomor_tiket}.");
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
    public function status(Aduan $aduan)
    {
        $aduan->load([
            'status',
            'priority',
            'histories' => fn($q) => $q->with(['statusSebelumnya', 'statusBaru', 'changedBy'])->latest(),
        ]);

        return response()->json($this->buildStatusPayload($aduan));
    }

    private function buildStatusPayload(Aduan $aduan): array
    {
        return [
            'status' => [
                'kode' => $aduan->status?->kode_status,
                'nama' => $aduan->status?->nama_status ?? 'Diterima',
            ],
            'priority' => [
                'nama' => $aduan->priority?->nama_prioritas ?? 'Rendah',
            ],
            'histories' => $aduan->histories->map(fn($h) => [
                'id'                     => $h->id,
                'status_baru_kode'       => $h->statusBaru?->kode_status,
                'status_baru_nama'       => $h->statusBaru?->nama_status,
                'status_sebelumnya_nama' => $h->statusSebelumnya?->nama_status,
                'changed_by_name'        => $h->changedBy?->name,
                'keterangan'             => $h->keterangan,
                'created_at'             => \Carbon\Carbon::parse($h->created_at)->isoFormat('DD-MM-YYYY HH:mm'),
            ])->values(),
        ];
    }
}
