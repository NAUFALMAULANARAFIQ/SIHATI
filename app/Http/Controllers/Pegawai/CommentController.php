<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use App\Services\AduanService;
use App\Http\Requests\Aduan\StoreCommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Aduan $aduan)
    {
        $user = Auth::user();

        if ($aduan->pelapor_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke aduan ini.');
        }

        AduanService::addComment($aduan, $request->komentar, $user->id);

        return redirect()
            ->route('pegawai.aduan.show', $aduan->id)
            ->with('success', 'Komentar berhasil ditambahkan.');
    }
}
