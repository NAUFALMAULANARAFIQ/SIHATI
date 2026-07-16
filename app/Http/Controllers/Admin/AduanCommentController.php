<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use App\Services\AduanService;
use App\Http\Requests\Aduan\StoreCommentRequest;
use Illuminate\Support\Facades\Auth;

class AduanCommentController extends Controller
{
    public function store(StoreCommentRequest $request, Aduan $aduan)
    {
        AduanService::addComment($aduan, $request->komentar, Auth::id());

        return redirect()
            ->route('admin.aduan.show', $aduan->id)
            ->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function index(Aduan $aduan)
    {
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
