<?php

namespace App\Http\Controllers;

use App\Services\HabitService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HabitController extends Controller
{
    public function __construct(
        protected HabitService $habitService
    ) {}

    public function index(): View
    {
        $habits = $this->habitService->getAllHabits();
        $completedToday = $habits->mapWithKeys(function ($habit) {
            return [$habit->id => $this->habitService->wasCompletedOn($habit->id, now())];
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

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $habit = $this->habitService->createHabit($validated);

        return redirect()
            ->route('habits.show', $habit)
            ->with('success', 'Hábito criado com sucesso!');
    }

    public function show(int $id): View
    {
        $habit = $this->habitService->getHabit($id);

        if (!$habit) {
            abort(404);
        }

        return view('habits.show', [
            'habit' => $habit,
            'weekly_frequency' => $this->habitService->getWeeklyFrequency($id),
            'current_streak' => $this->habitService->getCurrentStreak($id),
            'monthly_progress' => $this->habitService->getMonthlyProgress($id),
            'calendar' => $this->habitService->getMonthlyCalendar($id)
        ]);
    }

    public function edit(int $id): View
    {
        $habit = $this->habitService->getHabit($id);

        if (!$habit) {
            abort(404);
        }

        return view('habits.edit', compact('habit'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $updated = $this->habitService->updateHabit($id, $validated);

        if (!$updated) {
            abort(404);
        }

        return redirect()
            ->route('habits.show', $id)
            ->with('success', 'Hábito atualizado com sucesso!');
    }

    public function destroy(int $id): RedirectResponse
    {
        $deleted = $this->habitService->deleteHabit($id);

        if (!$deleted) {
            abort(404);
        }

        return redirect()
            ->route('habits.index')
            ->with('success', 'Hábito excluído com sucesso!');
    }

    public function complete(int $id): RedirectResponse
    {
        $habit = $this->habitService->getHabit($id);

        if (!$habit) {
            abort(404);
        }

        $log = $this->habitService->logCompletion($id);

        if (!$log) {
            return redirect()
                ->route('habits.show', $habit)
                ->with('error', 'Este hábito já foi completado hoje!');
        }

        return redirect()
            ->route('habits.show', $habit)
            ->with('success', 'Hábito completado com sucesso!');
    }
}
