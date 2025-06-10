<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\HabitLog;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Collection;
use App\Http\Requests\HabitStoreRequest;
use App\Http\Requests\HabitUpdateRequest;

class HabitController extends Controller
{
    public function index(): View
    {
        $habits = auth()->user()->habits()
            ->orderBy('name')
            ->get();

        $completedToday = $habits->mapWithKeys(function ($habit) {
            return [$habit->id => $habit->wasCompletedOn(now())];
        });

        return view('habits.index', [
            'habits' => $habits,
            'completedToday' => $completedToday
        ]);
    }

    public function create(): View
    {
        return view('habits.create');
    }

    public function store(HabitStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $habit = auth()->user()->habits()->create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()
            ->route('habits.show', $habit)
            ->with('success', 'Hábito criado com sucesso!');
    }

    public function show(Habit $habit): View
    {
        $this->authorize('view', $habit);

        return view('habits.show', [
            'habit' => $habit,
            'weekly_frequency' => $habit->weekly_frequency,
            'current_streak' => $habit->current_streak,
            'monthly_progress' => $habit->monthly_progress,
            'calendar' => $habit->monthly_calendar
        ]);
    }

    public function edit(Habit $habit): View
    {
        $this->authorize('update', $habit);
        return view('habits.edit', compact('habit'));
    }

    public function update(HabitUpdateRequest $request, Habit $habit): RedirectResponse
    {
        $validated = $request->validated();

        $habit->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()
            ->route('habits.show', $habit)
            ->with('success', 'Hábito atualizado com sucesso!');
    }

    public function destroy(Habit $habit): RedirectResponse
    {
        $this->authorize('delete', $habit);
        $habit->delete();

        return redirect()
            ->route('habits.index')
            ->with('success', 'Hábito excluído com sucesso!');
    }

    public function complete(Habit $habit): RedirectResponse
    {
        $this->authorize('view', $habit);

        if ($habit->wasCompletedOn(now())) {
            return redirect()
                ->route('habits.show', $habit)
                ->with('error', 'Este hábito já foi completado hoje!');
        }

        $habit->logs()->create([
            'completed_at' => now()->startOfDay()
        ]);

        return redirect()
            ->route('habits.show', $habit)
            ->with('success', 'Hábito completado com sucesso!');
    }
}
