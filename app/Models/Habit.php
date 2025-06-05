<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

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

    public function getWeeklyFrequencyAttribute(): int
    {
        return $this->logs()
            ->where('completed_at', '>=', now()->subDays(7)->startOfDay())
            ->count();
    }

    public function getCurrentStreakAttribute(): int
    {
        $streak = 0;
        $date = now()->startOfDay();

        while ($this->wasCompletedOn($date)) {
            $streak++;
            $date->subDay();
        }

        return $streak;
    }

    public function getMonthlyProgressAttribute(): array
    {
        $date = now();
        $start = $date->copy()->startOfMonth()->startOfDay();
        $end = $date->copy()->endOfMonth()->startOfDay();

        $completedDays = $this->logs()
            ->whereBetween('completed_at', [$start, $end])
            ->count();

        $totalDays = $start->diffInDays($end) + 1;

        return [
            'total_days' => $totalDays,
            'completed_days' => $completedDays,
            'percentage' => round(($completedDays / $totalDays) * 100, 2),
        ];
    }

    public function getMonthlyCalendarAttribute(): Collection
    {
        $date = now();
        $start = $date->copy()->startOfMonth();
        $end = $date->copy()->endOfMonth();

        $loggedDates = $this->logs()
            ->whereBetween('completed_at', [$start, $end])
            ->pluck('completed_at')
            ->map(fn ($d) => $d->toDateString())
            ->flip();

        return collect(range(0, $start->diffInDays($end)))
            ->map(fn ($i) => $start->copy()->addDays($i))
            ->map(fn ($day) => [
                'date' => $day->toDateString(),
                'day' => $day->day,
                'is_completed' => $loggedDates->has($day->toDateString()),
                'is_today' => $day->isToday(),
            ]);
    }

    public function wasCompletedOn(Carbon $date): bool
    {
        return $this->logs()
            ->whereDate('completed_at', $date->toDateString())
            ->exists();
    }
}
