<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AduanComment extends Model
{
    protected $table = 'aduan_comments';

    protected $fillable = ['aduan_id', 'user_id', 'komentar'];

    public function aduan()
    {
        return $this->belongsTo(Aduan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
