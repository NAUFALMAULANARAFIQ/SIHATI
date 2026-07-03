<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AduanNote extends Model
{
    protected $table = 'aduan_notes';

    protected $fillable = ['aduan_id', 'petugas_id', 'catatan'];

    public function aduan()
    {
        return $this->belongsTo(Aduan::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
