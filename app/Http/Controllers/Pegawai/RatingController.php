<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use App\Services\AduanService;
use App\Http\Requests\Aduan\StoreRatingRequest;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(StoreRatingRequest $request, Aduan $aduan)
    {
        $user = Auth::user();

        if ($aduan->pelapor_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke aduan ini.');
        }

        try {
            AduanService::addRating(
                $aduan,
                $request->rating,
                $request->komentar,
                $user->id
            );

            return redirect()
                ->route('pegawai.aduan.show', $aduan->id)
                ->with('success', 'Rating berhasil diberikan.');
        } catch (\InvalidArgumentException $e) {
            return redirect()
                ->route('pegawai.aduan.show', $aduan->id)
                ->with('error', $e->getMessage());
        }
    }
}
