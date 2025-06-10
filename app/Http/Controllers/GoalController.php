<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use App\Http\Requests\GoalStoreRequest;
use App\Http\Requests\GoalUpdateRequest;

class GoalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activeGoals = auth()->user()->goals()->active()->orderBy('target_date')->get();
        $completedGoals = auth()->user()->goals()->completed()->orderBy('completed_at', 'desc')->get();
        $overdueGoals = auth()->user()->goals()->overdue()->orderBy('target_date')->get();

        return view('goals.index', compact('activeGoals', 'completedGoals', 'overdueGoals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('goals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GoalStoreRequest $request)
    {
        $validated = $request->validated();

        $goal = auth()->user()->goals()->create($validated);

        return redirect()->route('goals.index')
            ->with('success', 'Meta criada com sucesso! 🎉');
    }

    /**
     * Display the specified resource.
     */
    public function show(Goal $goal)
    {
        $this->authorize('view', $goal);
        return view('goals.show', compact('goal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Goal $goal)
    {
        $this->authorize('update', $goal);
        return view('goals.edit', compact('goal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GoalUpdateRequest $request, Goal $goal)
    {
        $validated = $request->validated();

        $goal->update($validated);

        return redirect()->route('goals.index')
            ->with('success', 'Meta atualizada com sucesso! ✨');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Goal $goal)
    {
        $this->authorize('delete', $goal);

        $goal->delete();

        return redirect()->route('goals.index')
            ->with('success', 'Meta excluída com sucesso! 👋');
    }

    public function complete(Goal $goal)
    {
        $this->authorize('update', $goal);

        $goal->update([
            'is_completed' => true,
            'completed_at' => now(),
        ]);

        return redirect()->route('goals.index')
            ->with('success', 'Parabéns! Meta concluída com sucesso! 🎉');
    }
}
