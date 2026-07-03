<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    protected $fillable = ['nama_bidang', 'keterangan'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function aduans()
    {
        return $this->hasMany(Aduan::class);
    }
}
