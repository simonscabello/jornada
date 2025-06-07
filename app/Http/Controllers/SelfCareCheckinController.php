<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SelfCareCheckin;
use App\Models\SelfCareQuestion;

class SelfCareCheckinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checkins = auth()->user()->checkins()
            ->with('answers.question')
            ->orderBy('date', 'desc')
            ->get();

        return view('self-care.checkins.index', compact('checkins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $today = now()->toDateString();
        $existingCheckin = auth()->user()->checkins()
            ->where('date', $today)
            ->first();

        if ($existingCheckin) {
            return redirect()->route('self-care.checkins.show', $existingCheckin)
                ->with('info', 'Você já fez o check-in de hoje.');
        }

        $questions = SelfCareQuestion::where('user_id', auth()->id())
            ->orWhere('is_default', true)
            ->get();

        return view('self-care.checkins.create', compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|boolean',
        ]);

        $checkin = auth()->user()->checkins()->create([
            'date' => now()->toDateString(),
        ]);

        foreach ($validated['answers'] as $questionId => $answer) {
            $checkin->answers()->create([
                'question_id' => $questionId,
                'answer' => $answer,
            ]);
        }

        return redirect()->route('self-care.checkins.show', $checkin)
            ->with('success', 'Check-in realizado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SelfCareCheckin $checkin)
    {
        if ($checkin->user_id !== auth()->id()) {
            abort(403);
        }

        $checkin->load('answers.question');

        return view('self-care.checkins.show', compact('checkin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
