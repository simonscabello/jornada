<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CollectionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'collection_id',
        'content',
        'notes',
        'done',
        'position',
    ];

    protected $casts = [
        'done' => 'boolean',
    ];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
}
