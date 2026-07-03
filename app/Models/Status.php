<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_status',
        'nama_status',
        'urutan',
        'is_final',
    ];

    protected function casts(): array
    {
        return [
            'is_final' => 'boolean',
        ];
    }

    public function aduans(): HasMany
    {
        return $this->hasMany(Aduan::class);
    }

    public function statusHistoriesAsPrevious(): HasMany
    {
        return $this->hasMany(AduanStatusHistory::class, 'status_sebelumnya_id');
    }

    public function statusHistoriesAsNew(): HasMany
    {
        return $this->hasMany(AduanStatusHistory::class, 'status_baru_id');
    }
}

