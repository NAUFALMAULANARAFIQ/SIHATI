<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use App\Services\AduanService;
use App\Http\Requests\Aduan\StoreAttachmentRequest;
use Illuminate\Support\Facades\Auth;

class AduanAttachmentController extends Controller
{
    public function store(StoreAttachmentRequest $request, Aduan $aduan)
    {
        $file = $request->file('file');
        
        AduanService::attachFile($aduan, $file, Auth::id());

        return redirect()
            ->route('admin.aduan.show', $aduan->id)
            ->with('success', 'Lampiran berhasil diunggah.');
    }

    public function destroy(Aduan $aduan, $attachmentId)
    {
        $attachment = $aduan->attachments()->find($attachmentId);

        if (!$attachment) {
            abort(404, 'Lampiran tidak ditemukan.');
        }

        AduanService::deleteAttachment($attachment);

        return redirect()
            ->back()
            ->with('success', 'Lampiran berhasil dihapus.');
    }
}
