<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SelfCareQuestion;
use App\Http\Requests\SelfCareQuestionStoreRequest;
use App\Http\Requests\SelfCareQuestionUpdateRequest;

class SelfCareQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = SelfCareQuestion::where('user_id', auth()->id())
            ->orWhere('is_default', true)
            ->get();

        return view('self-care.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('self-care.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SelfCareQuestionStoreRequest $request)
    {
        $validated = $request->validated();

        $question = auth()->user()->questions()->create($validated);

        return redirect()->route('self-care.questions.index')
            ->with('success', 'Pergunta criada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SelfCareQuestion $question)
    {
        if ($question->is_default || $question->user_id !== auth()->id()) {
            abort(403);
        }

        return view('self-care.questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SelfCareQuestionUpdateRequest $request, SelfCareQuestion $question)
    {
        $validated = $request->validated();

        $question->update($validated);

        return redirect()->route('self-care.questions.index')
            ->with('success', 'Pergunta atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SelfCareQuestion $question)
    {
        if ($question->is_default || $question->user_id !== auth()->id()) {
            abort(403);
        }

        $question->delete();

        return redirect()->route('self-care.questions.index')
            ->with('success', 'Pergunta excluída com sucesso.');
    }
}
