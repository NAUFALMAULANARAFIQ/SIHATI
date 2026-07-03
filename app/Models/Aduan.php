<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aduan extends Model
{
    protected $table = 'aduans';

    protected $fillable = [
        'nomor_tiket', 'pelapor_id', 'petugas_id', 'bidang_id',
        'category_id', 'priority_id', 'status_id',
        'judul', 'deskripsi', 'lokasi', 'no_kontak',
        'tanggal_aduan', 'tanggal_diterima', 'tanggal_diproses', 'tanggal_selesai',
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

    public function pelapor()
    {
        return $this->belongsTo(User::class, 'pelapor_id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function attachments()
    {
        return $this->hasMany(AduanAttachment::class);
    }

    public function notes()
    {
        return $this->hasMany(AduanNote::class);
    }

    public function comments()
    {
        return $this->hasMany(AduanComment::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function statusHistories()
    {
        return $this->hasMany(AduanStatusHistory::class);
    }
}
