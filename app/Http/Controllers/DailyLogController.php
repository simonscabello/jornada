<?php

namespace App\Http\Controllers;

use App\Models\DailyLog;
use Illuminate\Http\Request;

class DailyLogController extends Controller
{
    public function index()
    {
        $dailyLogs = auth()->user()->dailyLogs()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('daily-logs.index', compact('dailyLogs'));
    }

    public function create()
    {
        return view('daily-logs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'mood' => 'nullable|string|max:255',
        ]);

        $log = auth()->user()->dailyLogs()->create($validated);

        return redirect()->route('daily-logs.show', $log)
            ->with('success', 'Registro criado com sucesso!');
    }

    public function show(DailyLog $dailyLog)
    {
        $this->authorize('view', $dailyLog);
        return view('daily-logs.show', compact('dailyLog'));
    }

    public function edit(DailyLog $dailyLog)
    {
        $this->authorize('update', $dailyLog);
        return view('daily-logs.edit', compact('dailyLog'));
    }

    public function update(Request $request, DailyLog $dailyLog)
    {
        $this->authorize('update', $dailyLog);

        $validated = $request->validate([
            'content' => 'required|string',
            'mood' => 'nullable|string|max:255',
        ]);

        $dailyLog->update($validated);

        return redirect()->route('daily-logs.show', $dailyLog)
            ->with('success', 'Registro atualizado com sucesso!');
    }

    public function destroy(DailyLog $dailyLog)
    {
        $this->authorize('delete', $dailyLog);

        $dailyLog->delete();

        return redirect()->route('daily-logs.index')
            ->with('success', 'Registro excluído com sucesso!');
    }
}
