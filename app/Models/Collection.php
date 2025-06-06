<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'type',
        'icon',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CollectionItem::class)->orderBy('position');
    }

    public function getCompletedItemsCountAttribute()
    {
        return $this->items()->where('done', true)->count();
    }

    public function getTotalItemsCountAttribute()
    {
        return $this->items()->count();
    }
}
