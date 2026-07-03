<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Priority extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_prioritas',
        'keterangan',
        'level',
    ];

    public function aduans(): HasMany
    {
        return $this->hasMany(Aduan::class);
    }
}
