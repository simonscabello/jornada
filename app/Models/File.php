<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    protected $fillable = [
        'disk',
        'path',
        'filename',
        'extension',
        'mime',
        'size',
        'fileable_type',
        'fileable_id',
    ];

    public function fileable()
    {
        return $this->morphTo();
    }

    public function getUrlAttribute()
    {
        return Storage::disk($this->disk)->url($this->path);
    }
}
