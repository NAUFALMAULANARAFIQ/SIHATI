<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bidang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_bidang',
        'keterangan',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function aduans()
    {
        return $this->hasMany(Aduan::class);
    }
}
