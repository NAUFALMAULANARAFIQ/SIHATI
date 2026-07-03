<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AduanComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'aduan_id',
        'user_id',
        'komentar',
    ];

    public function aduan(): BelongsTo
    {
        return $this->belongsTo(Aduan::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
