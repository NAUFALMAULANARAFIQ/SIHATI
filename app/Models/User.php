<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'bidang_id',
    'name',
    'username',
    'email',
    'password',
    'no_hp',
    'role',
    'is_active',
])]
#[Hidden([
    'password',
    'remember_token',
])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function bidang(): BelongsTo
    {
        return $this->belongsTo(Bidang::class);
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function aduansAsPelapor(): HasMany
    {
        return $this->hasMany(Aduan::class, 'pelapor_id');
    }

    public function aduansAsPetugas(): HasMany
    {
        return $this->hasMany(Aduan::class, 'petugas_id');
    }

    public function aduanComments(): HasMany
    {
        return $this->hasMany(AduanComment::class);
    }

    public function aduanNotes(): HasMany
    {
        return $this->hasMany(AduanNote::class, 'petugas_id');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }
}
