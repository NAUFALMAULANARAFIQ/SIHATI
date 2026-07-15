<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use App\Models\Bidang;
use App\Models\Category;
use App\Models\Priority;
use App\Models\Status;
use App\Services\AduanService;
use App\Http\Requests\Aduan\StoreAduanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AduanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Aduan::where('bidang_id', $user->bidang_id)
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

        // ── Date range filter ──
        $startDate = null;
        $endDate   = null;

        if ($request->filled('range')) {
            match ($request->range) {
                'week'  => $startDate = now()->subDays(6)->startOfDay(),
                'month' => $startDate = now()->subMonth()->startOfDay(),
                default => null,
            };
            $endDate = now()->endOfDay();
        } elseif ($request->filled('start_date') || $request->filled('end_date')) {
            $startDate = $request->filled('start_date')
                ? \Carbon\Carbon::parse($request->start_date)->startOfDay()
                : null;
            $endDate = $request->filled('end_date')
                ? \Carbon\Carbon::parse($request->end_date)->endOfDay()
                : now()->endOfDay();
        }

        if ($startDate && $endDate && $startDate->lte($endDate)) {
            $query->whereBetween('tanggal_aduan', [$startDate, $endDate]);
        }

        $aduans = $query->latest('tanggal_aduan')->paginate(10)->withQueryString();

        $categories = Category::where('is_active', true)->get();
        $priorities = Priority::all();
        $bidangs = Bidang::all();
        $statuses = Status::all();

        return view('pegawai.aduan.index', compact('aduans', 'categories', 'priorities', 'bidangs', 'statuses'));
    }

    public function create()
    {
        return view('pegawai.aduan.create');
    }

    public function store(StoreAduanRequest $request)
    {
        $user = Auth::user();

        if (!$user->bidang_id) {
            return redirect()->back()->with('error', 'Akun Anda belum memiliki bidang. Silakan hubungi admin.');
        }

        $data = $request->validated();
        $data['bidang_id'] = $user->bidang_id;
        unset($data['priority_id']);

        $attachments = $request->hasFile('attachments') ? $request->file('attachments') : null;

        $aduan = AduanService::create($data, $user->id, $attachments);

        return redirect()
            ->route('pegawai.aduan.index')
            ->with('success', "Aduan berhasil dibuat dengan nomor tiket {$aduan->nomor_tiket}.");
    }

    public function show(Aduan $aduan)
    {
        $user = Auth::user();

        if ($aduan->bidang_id !== $user->bidang_id) {
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
    public function status(Aduan $aduan)
    {
        $user = Auth::user();

        if ($aduan->pelapor_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke aduan ini.');
        }

        $aduan->load([
            'status',
            'priority',
            'histories' => fn($q) => $q->with(['statusSebelumnya', 'statusBaru', 'changedBy'])->latest(),
        ]);

        return response()->json([
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
        ]);
    }
}
