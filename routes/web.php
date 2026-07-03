<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BidangController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PriorityController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AduanController as AdminAduanController;
use App\Http\Controllers\Admin\AduanStatusController;
use App\Http\Controllers\Admin\AduanNoteController;
use App\Http\Controllers\Admin\AduanAttachmentController;
use App\Http\Controllers\Admin\AduanCommentController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Pegawai\DashboardController as PegawaiDashboardController;
use App\Http\Controllers\Pegawai\AduanController as PegawaiAduanController;
use App\Http\Controllers\Pegawai\CommentController as PegawaiCommentController;
use App\Http\Controllers\Pegawai\RatingController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'role:pegawai'])->prefix('pegawai')->name('pegawai.')->group(function () {
    Route::get('/dashboard', [PegawaiDashboardController::class, 'index'])->name('dashboard');
    Route::resource('aduan', PegawaiAduanController::class)->only(['index', 'create', 'store', 'show']);
    Route::post('/aduan/{aduan}/comments', [PegawaiCommentController::class, 'store'])->name('aduan.comments.store');
    Route::post('/aduan/{aduan}/ratings', [RatingController::class, 'store'])->name('aduan.ratings.store');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('aduan', AdminAduanController::class)->only(['index', 'show']);
    Route::patch('/aduan/{aduan}/status', [AduanStatusController::class, 'update'])->name('aduan.status.update');
    Route::post('/aduan/{aduan}/notes', [AduanNoteController::class, 'store'])->name('aduan.notes.store');
    Route::post('/aduan/{aduan}/comments', [AduanCommentController::class, 'store'])->name('aduan.comments.store');
    Route::post('/aduan/{aduan}/attachments', [AduanAttachmentController::class, 'store'])->name('aduan.attachments.store');
    Route::delete('/aduan/{aduan}/attachments/{attachment}', [AduanAttachmentController::class, 'destroy'])->name('aduan.attachments.destroy');
    
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/print', [LaporanController::class, 'print'])->name('laporan.print');
    Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('bidangs', BidangController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('priorities', PriorityController::class);
    Route::resource('statuses', StatusController::class);

    Route::get('activity-logs', [ActivityLogController::class, 'index'])
        ->name('activity-logs.index');
});

require __DIR__.'/auth.php';
