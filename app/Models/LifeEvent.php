<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class LifeEvent extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'event_date',
        'location',
        'type',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function getEventDateHumanAttribute()
    {
        return optional($this->event_date)
            ? $this->event_date->locale('pt_BR')->diffForHumans()
            : null;
    }
}
