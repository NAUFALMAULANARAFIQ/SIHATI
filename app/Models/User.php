<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'bidang_id', 'name', 'username', 'email', 'no_hp',
        'password', 'role', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function aduansSebagaiPelapor()
    {
        return $this->hasMany(Aduan::class, 'pelapor_id');
    }

    public function aduansSebagaiPetugas()
    {
        return $this->hasMany(Aduan::class, 'petugas_id');
    }

    public function attachments()
    {
        return $this->hasMany(AduanAttachment::class, 'uploaded_by');
    }

    public function notes()
    {
        return $this->hasMany(AduanNote::class, 'petugas_id');
    }

    public function comments()
    {
        return $this->hasMany(AduanComment::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }
}
