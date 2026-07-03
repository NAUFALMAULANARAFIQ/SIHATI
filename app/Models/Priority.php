<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $fillable = ['nama_prioritas', 'keterangan', 'level'];

    public function aduans()
    {
        return $this->hasMany(Aduan::class);
    }
}
