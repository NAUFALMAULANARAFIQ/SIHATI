<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_tiket',
        'pelapor_id',
        'petugas_id',
        'bidang_id',
        'category_id',
        'priority_id',
        'status_id',
        'judul',
        'deskripsi',
        'lokasi',
        'no_kontak',
        'tanggal_aduan',
        'tanggal_diterima',
        'tanggal_diproses',
        'tanggal_selesai',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_aduan' => 'datetime',
            'tanggal_diterima' => 'datetime',
            'tanggal_diproses' => 'datetime',
            'tanggal_selesai' => 'datetime',
        ];
    }

    public function pelapor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pelapor_id');
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function bidang(): BelongsTo
    {
        return $this->belongsTo(Bidang::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function priority(): BelongsTo
    {
        return $this->belongsTo(Priority::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(AduanAttachment::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(AduanNote::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(AduanComment::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(AduanStatusHistory::class);
    }
}
