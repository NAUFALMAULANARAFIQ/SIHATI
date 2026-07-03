<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AduanStatusHistory extends Model
{
    protected $table = 'aduan_status_histories';

    protected $fillable = ['aduan_id', 'status_sebelumnya_id', 'status_baru_id', 'changed_by', 'keterangan'];

    public function aduan()
    {
        return $this->belongsTo(Aduan::class);
    }

    public function statusSebelumnya()
    {
        return $this->belongsTo(Status::class, 'status_sebelumnya_id');
    }

    public function statusBaru()
    {
        return $this->belongsTo(Status::class, 'status_baru_id');
    }

    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
