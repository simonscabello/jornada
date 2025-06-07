<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\DailyLog;
use App\Models\Goal;
use App\Models\Collection;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(): View
    {
        $user = auth()->user();
        $today = Carbon::today();

        // Dados dos Hábitos
        $habits = [
            'total' => $user->habits()->count(),
            'completed_today' => $user->habits()
                ->whereHas('logs', function ($query) use ($today) {
                    $query->whereDate('completed_at', $today);
                })->count()
        ];

        // Dados do Daily Log
        $dailyLog = $user->dailyLogs()
            ->whereDate('created_at', $today)
            ->first();

        // Dados das Metas
        $goals = [
            'total' => $user->goals()->count(),
            'completed' => $user->goals()->whereNotNull('completed_at')->count(),
            'upcoming' => $user->goals()
                ->whereNull('completed_at')
                ->whereBetween('target_date', [$today, $today->copy()->addDays(3)])
                ->get()
        ];

        // Dados das Coleções
        $collections = [
            'total' => $user->collections()->count(),
            'pending_items' => $user->collections()
                ->withCount(['items' => function ($query) {
                    $query->where('done', false);
                }])
                ->get()
                ->sum('items_count')
        ];

        $todayCheckin = $user->checkins()
            ->where('date', $today)
            ->first();

        return view('dashboard', compact(
            'habits',
            'dailyLog',
            'goals',
            'collections',
            'todayCheckin'
        ));
    }
}
