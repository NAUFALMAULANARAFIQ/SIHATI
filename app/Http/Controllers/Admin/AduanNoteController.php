<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use App\Services\AduanService;
use App\Http\Requests\Aduan\StoreNoteRequest;
use Illuminate\Support\Facades\Auth;

class AduanNoteController extends Controller
{
    public function store(StoreNoteRequest $request, Aduan $aduan)
    {
        AduanService::addNote($aduan, $request->catatan, Auth::id());

        return redirect()
            ->route('admin.aduan.show', $aduan->id)
            ->with('success', 'Catatan penanganan berhasil ditambahkan.');
    }
}
