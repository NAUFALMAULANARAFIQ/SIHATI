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

    public function index(Aduan $aduan)
    {
        if ($aduan->pelapor_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke aduan ini.');
        }

        $comments = $aduan->comments()
            ->with('user')
            ->orderBy('created_at')
            ->get()
            ->map(fn ($comment) => [
                'id'          => $comment->id,
                'komentar'    => $comment->komentar,
                'created_at'  => \Carbon\Carbon::parse($comment->created_at)->isoFormat('DD-MM-YYYY HH:mm'),
                'user_name'   => $comment->user?->name ?? 'User',
                'is_petugas'  => in_array($comment->user?->role, ['admin', 'petugas']),
            ]);

        return response()->json($comments);
    }
}
