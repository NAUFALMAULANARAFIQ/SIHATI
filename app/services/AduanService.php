<?php

namespace App\Services;

use App\Models\Aduan;
use App\Models\AduanAttachment;
use App\Models\AduanComment;
use App\Models\AduanNote;
use App\Models\Rating;
use App\Models\Status;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class AduanService
{
    public static function create(array $data, int $pelaporId, ?array $attachments = null): Aduan
    {
        return DB::transaction(function () use ($data, $pelaporId, $attachments) {
            $nomorTiket = TicketService::generate();
            $statusDiterima = Status::where('kode_status', 'diterima')->firstOrFail();

            $aduan = Aduan::create([
                'nomor_tiket' => $nomorTiket,
                'pelapor_id' => $pelaporId,
                'bidang_id' => $data['bidang_id'],
                'category_id' => $data['category_id'],
                'priority_id' => $data['priority_id'] ?? null,
                'status_id' => $statusDiterima->id,
                'judul' => $data['judul'],
                'deskripsi' => $data['deskripsi'],
                'lokasi' => $data['lokasi'] ?? null,
                'no_kontak' => $data['no_kontak'] ?? null,
                'tanggal_aduan' => now(),
            ]);

            AduanStatusService::createInitialStatus($aduan, $pelaporId);

            $creator = User::find($pelaporId);
            if ($creator && $creator->role === 'admin' && $data['bidang_id']) {
                $targetUser = User::where('bidang_id', $data['bidang_id'])
                    ->where('role', 'pegawai')
                    ->first();
                if ($targetUser) {
                    $aduan->load('bidang');
                    NotificationService::create(
                        $targetUser->id,
                        'new',
                        "Aduan Baru: {$aduan->nomor_tiket}",
                        "Admin membuat aduan untuk {$aduan->bidang?->nama_bidang}.",
                        route('pegawai.aduan.show', $aduan)
                    );
                }
            }

            if ($attachments && count($attachments) > 0) {
                foreach ($attachments as $file) {
                    self::attachFile($aduan, $file, $pelaporId);
                }
            }

            return $aduan->fresh(['pelapor', 'bidang', 'category', 'priority', 'status']);
        });
    }

    public static function update(Aduan $aduan, array $data): Aduan
    {
        $oldValues = $aduan->only(['judul', 'deskripsi', 'lokasi', 'no_kontak', 'category_id', 'priority_id']);

        $aduan->update([
            'judul' => $data['judul'] ?? $aduan->judul,
            'deskripsi' => $data['deskripsi'] ?? $aduan->deskripsi,
            'lokasi' => $data['lokasi'] ?? $aduan->lokasi,
            'no_kontak' => $data['no_kontak'] ?? $aduan->no_kontak,
            'category_id' => $data['category_id'] ?? $aduan->category_id,
            'priority_id' => $data['priority_id'] ?? $aduan->priority_id,
        ]);

        $newValues = $aduan->only(['judul', 'deskripsi', 'lokasi', 'no_kontak', 'category_id', 'priority_id']);

        ActivityLogService::log(
            action: 'update_aduan',
            module: 'aduan',
            description: "Pegawai mengupdate aduan {$aduan->nomor_tiket}.",
            targetTable: 'aduans',
            targetId: $aduan->id,
            oldValues: $oldValues,
            newValues: $newValues
        );

        return $aduan->fresh();
    }

    public static function changeStatus(Aduan $aduan, string $newStatusKode, int $changedBy, ?string $keterangan = null): Aduan
    {
        AduanStatusService::updateStatus($aduan, $newStatusKode, $changedBy, $keterangan);

        return $aduan->fresh(['status']);
    }

    public static function attachFile(Aduan $aduan, UploadedFile $file, int $uploadedBy): AduanAttachment
    {
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . '_' . uniqid() . '.' . $extension;
        $filePath = $file->storeAs('aduan', $fileName, 'public');

        $attachment = AduanAttachment::create([
            'aduan_id' => $aduan->id,
            'uploaded_by' => $uploadedBy,
            'file_name' => $originalName,
            'file_path' => $filePath,
            'file_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
        ]);

        ActivityLogService::log(
            action: 'upload_attachment',
            module: 'aduan',
            description: "User mengupload lampiran {$originalName} pada aduan {$aduan->nomor_tiket}.",
            targetTable: 'aduan_attachments',
            targetId: $attachment->id,
            newValues: ['file_name' => $originalName, 'aduan_id' => $aduan->id]
        );

        return $attachment;
    }

    public static function deleteAttachment(AduanAttachment $attachment): bool
    {
        $fileName = $attachment->file_name;
        $aduanNomorTiket = $attachment->aduan->nomor_tiket;

        if (Storage::disk('public')->exists($attachment->file_path)) {
            Storage::disk('public')->delete($attachment->file_path);
        }

        $deleted = $attachment->delete();

        if ($deleted) {
            ActivityLogService::log(
                action: 'delete_attachment',
                module: 'aduan',
                description: "User menghapus lampiran {$fileName} dari aduan {$aduanNomorTiket}.",
                targetTable: 'aduan_attachments',
                targetId: $attachment->id,
                oldValues: ['file_name' => $fileName, 'aduan_id' => $attachment->aduan_id]
            );
        }

        return $deleted;
    }

    public static function addComment(Aduan $aduan, string $komentar, int $userId): AduanComment
    {
        $comment = AduanComment::create([
            'aduan_id' => $aduan->id,
            'user_id' => $userId,
            'komentar' => $komentar,
        ]);

        self::notifyNewComment($aduan, $userId);

        ActivityLogService::log(
            action: 'add_comment',
            module: 'aduan',
            description: "User menambahkan komentar pada aduan {$aduan->nomor_tiket}.",
            targetTable: 'aduan_comments',
            targetId: $comment->id,
            newValues: ['komentar' => substr($komentar, 0, 100), 'aduan_id' => $aduan->id]
        );

        return $comment->fresh(['user']);
    }
    public static function addNote(Aduan $aduan, string $catatan, int $petugasId): AduanNote
    {
        $note = AduanNote::create([
            'aduan_id' => $aduan->id,
            'petugas_id' => $petugasId,
            'catatan' => $catatan,
        ]);

        ActivityLogService::log(
            action: 'add_note',
            module: 'aduan',
            description: "Admin menambahkan catatan penanganan pada aduan {$aduan->nomor_tiket}.",
            targetTable: 'aduan_notes',
            targetId: $note->id,
            newValues: ['catatan' => substr($catatan, 0, 100), 'aduan_id' => $aduan->id]
        );

        return $note->fresh(['petugas']);
    }

    public static function addRating(Aduan $aduan, int $rating, ?string $komentar, int $userId): Rating
    {
        if ($aduan->status->kode_status !== 'selesai') {
            throw new \InvalidArgumentException('Rating hanya bisa diberikan pada aduan dengan status selesai.');
        }

        $existingRating = Rating::where('aduan_id', $aduan->id)
            ->where('user_id', $userId)
            ->first();

        if ($existingRating) {
            throw new \InvalidArgumentException('Anda sudah memberikan rating pada aduan ini.');
        }

        $ratingRecord = Rating::create([
            'aduan_id' => $aduan->id,
            'user_id' => $userId,
            'rating' => $rating,
            'komentar' => $komentar,
        ]);

        ActivityLogService::log(
            action: 'add_rating',
            module: 'aduan',
            description: "Pegawai memberikan rating {$rating}/5 pada aduan {$aduan->nomor_tiket}.",
            targetTable: 'ratings',
            targetId: $ratingRecord->id,
            newValues: ['rating' => $rating, 'aduan_id' => $aduan->id]
        );

        return $ratingRecord->fresh(['user']);
    }

    private static function notifyNewComment(Aduan $aduan, int $commenterId): void
    {
        if ($commenterId === $aduan->pelapor_id) {
            $admins = $aduan->petugas_id
                ? User::where('id', $aduan->petugas_id)->get()
                : User::where('role', 'admin')->get();

            foreach ($admins as $admin) {
                NotificationService::create(
                    userId: $admin->id,
                    type: 'comment',
                    title: 'Komentar Baru pada Aduan',
                    description: "Ada komentar baru pada aduan {$aduan->nomor_tiket}.",
                    url: route('admin.aduan.show', $aduan)
                );
            }
        } else {
            NotificationService::create(
                userId: $aduan->pelapor_id,
                type: 'comment',
                title: 'Komentar Baru pada Aduan',
                description: "Ada komentar baru pada aduan {$aduan->nomor_tiket} Anda.",
                url: route('pegawai.aduan.show', $aduan)
            );
        }
    }
}
