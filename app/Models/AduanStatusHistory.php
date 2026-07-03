<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AduanStatusHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'aduan_id',
        'status_sebelumnya_id',
        'status_baru_id',
        'changed_by',
        'keterangan',
    ];

    public function aduan(): BelongsTo
    {
        return $this->belongsTo(Aduan::class);
    }

    public function statusSebelumnya(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_sebelumnya_id');
    }

    public function statusBaru(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_baru_id');
    }

    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
