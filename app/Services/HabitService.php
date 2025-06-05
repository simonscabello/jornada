<?php

namespace App\Services;

use App\Models\Habit;
use App\Models\HabitLog;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Auth;

class HabitService
{
    /**
     * Retorna todos os hábitos do usuário autenticado
     */
    public function getAllHabits(): Collection
    {
        return Habit::where('user_id', Auth::id())
            ->orderBy('name')
            ->get();
    }

    /**
     * Retorna um hábito específico
     */
    public function getHabit(int $habitId): ?Habit
    {
        return Habit::where('user_id', Auth::id())
            ->find($habitId);
    }

    /**
     * Cria um novo hábito
     */
    public function createHabit(array $data): Habit
    {
        return Habit::create([
            'user_id' => Auth::id(),
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
        ]);
    }

    /**
     * Atualiza um hábito existente
     */
    public function updateHabit(int $habitId, array $data): bool
    {
        $habit = $this->getHabit($habitId);

        if (!$habit) {
            return false;
        }

        return $habit->update([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
        ]);
    }

    /**
     * Exclui um hábito
     */
    public function deleteHabit(int $habitId): bool
    {
        $habit = $this->getHabit($habitId);

        if (!$habit) {
            return false;
        }

        return $habit->delete();
    }

    /**
     * Calcula a frequência semanal de um hábito
     */
    public function getWeeklyFrequency(int $habitId): int
    {
        return HabitLog::where('habit_id', $habitId)
            ->where('completed_at', '>=', now()->subDays(7)->startOfDay())
            ->count();
    }

    /**
     * Calcula a sequência atual de dias consecutivos
     */
    public function getCurrentStreak(int $habitId): int
    {
        $streak = 0;
        $date = now()->startOfDay();

        while ($this->wasCompletedOn($habitId, $date)) {
            $streak++;
            $date->subDay();
        }

        return $streak;
    }

    /**
     * Calcula o progresso mensal do hábito
     */
    public function getMonthlyProgress(int $habitId, ?Carbon $referenceDate = null): array
    {
        $date = $referenceDate ?? now();
        $start = $date->copy()->startOfMonth()->startOfDay();
        $end = $date->copy()->endOfMonth()->startOfDay();

        $completedDays = HabitLog::where('habit_id', $habitId)
            ->whereBetween('completed_at', [$start, $end])
            ->count();

        $totalDays = $start->diffInDays($end) + 1;

        return [
            'total_days' => $totalDays,
            'completed_days' => $completedDays,
            'percentage' => round(($completedDays / $totalDays) * 100, 2),
        ];
    }

    /**
     * Registra uma execução do hábito
     */
    public function logCompletion(int $habitId, ?Carbon $date = null): ?HabitLog
    {
        $habit = $this->getHabit($habitId);

        if (!$habit) {
            return null;
        }

        // Verifica se já existe um log para hoje
        if ($this->wasCompletedOn($habitId, $date ?? now())) {
            return null;
        }

        return HabitLog::create([
            'habit_id' => $habitId,
            'completed_at' => ($date ?? now())->startOfDay()
        ]);
    }

    /**
     * Retorna o calendário mensal do hábito
     */
    public function getMonthlyCalendar(int $habitId, ?Carbon $referenceDate = null): SupportCollection
    {
        $date = $referenceDate ?? now();
        $start = $date->copy()->startOfMonth();
        $end = $date->copy()->endOfMonth();

        $loggedDates = HabitLog::where('habit_id', $habitId)
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

    /**
     * Verifica se o hábito foi completado em uma data específica
     */
    public function wasCompletedOn(int $habitId, Carbon $date): bool
    {
        return HabitLog::where('habit_id', $habitId)
            ->whereDate('completed_at', $date->toDateString())
            ->exists();
    }
}

