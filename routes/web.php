<?php

use App\Models\Aduan;
use App\Models\ActivityLog;
use App\Models\Bidang;
use App\Models\Category;
use App\Models\Priority;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| TEMPORARY ROUTES — hapus setelah layout & auth dari FD1 & BD1 selesai
|--------------------------------------------------------------------------
*/

// Daftar Aduan
Route::get('/', function () {
    $aduans = Aduan::with(['pelapor', 'bidang', 'category', 'priority', 'status'])->get();
    $categories = Category::all();
    $statuses = Status::all();
    $priorities = Priority::all();
    $bidangs = Bidang::all();

    return view('aduan.index', compact('aduans', 'categories', 'statuses', 'priorities', 'bidangs'));
})->name('pegawai.aduan.index');

// Buat Aduan
Route::get('/aduan/buat', function () {
    $categories = Category::all();
    $priorities = Priority::all();
    return view('aduan.create', compact('categories', 'priorities'));
})->name('pegawai.aduan.create');

// Detail Aduan
Route::get('/aduan/{id}', function ($id) {
    $aduan = Aduan::with([
        'pelapor', 'petugas', 'bidang', 'category', 'priority', 'status',
        'attachments', 'notes.petugas', 'comments.user',
        'statusHistories.statusSebelumnya', 'statusHistories.statusBaru', 'statusHistories.changedBy',
    ])->findOrFail($id);

    $availableStatuses = Status::all();
    $categories = Category::all();
    $statuses = Status::all();
    $priorities = Priority::all();

    return view('aduan.show', compact('aduan', 'availableStatuses', 'categories', 'statuses', 'priorities'));
})->name('pegawai.aduan.show');

/*
|--------------------------------------------------------------------------
| ALIAS ROUTE — untuk testing view, hapus setelah backend jadi
|--------------------------------------------------------------------------
*/
Route::name('admin.')->prefix('admin')->group(function () {
    Route::get('/aduan', fn() => redirect()->route('pegawai.aduan.index'))->name('aduan.index');
    Route::get('/aduan/{id}', fn($id) => redirect()->route('pegawai.aduan.show', $id))->name('aduan.show');
    Route::match(['get', 'post'], '/aduan/{id}/status', fn() => back())->name('aduan.status.update');
    Route::match(['get', 'post'], '/aduan/{id}/notes', fn() => back())->name('aduan.notes.store');
    Route::match(['get', 'post'], '/aduan/{id}/comments', fn() => back())->name('aduan.comments.store');
    Route::match(['get', 'post'], '/aduan/{id}/attachments', fn() => back())->name('aduan.attachments.store');
});
Route::name('pegawai.')->prefix('pegawai')->group(function () {
    Route::match(['get', 'post'], '/aduan/{id}/ratings', fn() => back())->name('aduan.ratings.store');
    Route::match(['get', 'post'], '/aduan/{id}/comments', fn() => back())->name('aduan.comments.store');
});

/*
|--------------------------------------------------------------------------
| TEMPORARY ROUTES — Laporan, Log Aktivitas, Master Data, Profile
|--------------------------------------------------------------------------
*/

// Laporan
Route::get('/laporan', function () {
    $categories = Category::all();
    $statuses = Status::all();
    $bidangs = Bidang::all();
    $petugasList = User::where('role', 'admin')->get(['id', 'name']);
    $aduans = Aduan::with(['pelapor', 'bidang', 'category', 'priority', 'status', 'petugas'])->get();
    $totalAduan = $aduans->count();
    $aduanSelesai = $aduans->where('status.kode_status', 'selesai')->count();
    $aduanDiproses = $aduans->where('status.kode_status', 'diproses')->count();
    $aduanDiterima = $aduans->where('status.kode_status', 'diterima')->count();

    return view('laporan.index', compact('categories', 'statuses', 'bidangs', 'petugasList', 'aduans', 'totalAduan', 'aduanSelesai', 'aduanDiproses', 'aduanDiterima'));
})->name('admin.laporan.index');

Route::get('/laporan/print', function () {
    $aduans = Aduan::with(['pelapor', 'bidang', 'category', 'priority', 'status', 'petugas'])->get();
    $totalAduan = $aduans->count();
    $aduanSelesai = $aduans->where('status.kode_status', 'selesai')->count();
    $aduanDiproses = $aduans->where('status.kode_status', 'diproses')->count();
    $aduanDiterima = $aduans->where('status.kode_status', 'diterima')->count();
    $tglAwal = request('tgl_awal', '-');
    $tglAkhir = request('tgl_akhir', '-');

    return view('laporan.print', compact('aduans', 'totalAduan', 'aduanSelesai', 'aduanDiproses', 'aduanDiterima', 'tglAwal', 'tglAkhir'));
})->name('admin.laporan.print');

// Activity Logs
Route::get('/log-aktivitas', function () {
    $logs = ActivityLog::with('user')->latest()->get();
    return view('activity-logs.index', compact('logs'));
})->name('admin.activity-logs.index');

Route::get('/log-aktivitas/{id}', function ($id) {
    $log = ActivityLog::with('user')->findOrFail($id);
    return view('activity-logs.show', compact('log'));
})->name('admin.activity-logs.show');

// Data Master — Pengguna
Route::get('/master/pengguna', function () {
    $bidangs = Bidang::all();
    $users = User::with('bidang')->get();
    return view('master.pengguna.index', compact('users', 'bidangs'));
})->name('admin.master.pengguna.index');

// Data Master — Bidang
Route::get('/master/bidang', function () {
    $bidangs = Bidang::withCount('users')->get();
    return view('master.bidang.index', compact('bidangs'));
})->name('admin.master.bidang.index');

// Data Master — Kategori
Route::get('/master/kategori', function () {
    $categories = Category::withCount('aduans')->get();
    return view('master.kategori.index', compact('categories'));
})->name('admin.master.kategori.index');

// Profile
Route::get('/profile', function () {
    return view('profile.index');
})->name('profile.index');
