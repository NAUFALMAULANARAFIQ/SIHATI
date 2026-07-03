<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['kode_status', 'nama_status', 'urutan', 'is_final'];

    protected function casts(): array
    {
        return [
            'is_final' => 'boolean',
        ];
    }

    public function aduans()
    {
        return $this->hasMany(Aduan::class);
    }

    public function statusHistoriesSebelumnya()
    {
        return $this->hasMany(AduanStatusHistory::class, 'status_sebelumnya_id');
    }

    public function statusHistoriesBaru()
    {
        return $this->hasMany(AduanStatusHistory::class, 'status_baru_id');
    }
}
