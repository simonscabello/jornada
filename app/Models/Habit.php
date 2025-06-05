<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Habit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(HabitLog::class);
    }

    public function getWeeklyFrequencyAttribute()
    {
        return $this->logs()
            ->where('completed_at', '>=', now()->subDays(7))
            ->count();
    }

    public function getCurrentStreakAttribute()
    {
        $streak = 0;
        $currentDate = now()->startOfDay();

        while ($this->logs()->whereDate('completed_at', $currentDate)->exists()) {
            $streak++;
            $currentDate->subDay();
        }

        return $streak;
    }

    public function getMonthlyProgressAttribute()
    {
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        $totalDays = $startOfMonth->diffInDays($endOfMonth) + 1;
        $completedDays = $this->logs()
            ->whereBetween('completed_at', [$startOfMonth, $endOfMonth])
            ->count();

        return [
            'total_days' => $totalDays,
            'completed_days' => $completedDays,
            'percentage' => ($completedDays / $totalDays) * 100
        ];
    }
}
