<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AduanAttachment extends Model
{
    protected $table = 'aduan_attachments';

    protected $fillable = ['aduan_id', 'uploaded_by', 'file_name', 'file_path', 'file_type', 'file_size'];

    public function aduan()
    {
        return $this->belongsTo(Aduan::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
