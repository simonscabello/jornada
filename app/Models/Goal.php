<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'target_date',
        'is_completed',
        'completed_at',
    ];

    protected $casts = [
        'target_date' => 'date',
        'is_completed' => 'boolean',
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_completed', false)
                    ->where('target_date', '>=', now()->startOfDay());
    }

    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }

    public function scopeOverdue($query)
    {
        return $query->where('is_completed', false)
                    ->where('target_date', '<', now()->startOfDay());
    }
}
